<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Traits\imageUpload;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{

    protected User $userModel;

    use imageUpload;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function getUserDetails($request)
    {
        try {
            return $this->userModel->where("id", $request->id)->first();
        } catch (Exception $e) {
            throw new Exception("Failed to get user details: " . $e->getMessage());
        }
    }
    public function getUsers($filters)
    {
        try {
            if (isset($filters['requested']) && $filters['requested']) {
                $users = $this->userModel->where(function ($query) {
                    $query->where('status', User::STATUS_PENDING)
                        ->orWhere(function ($q) {
                            $q->where('status', User::STATUS_ACTIVE)
                                ->whereNull('email_verified_at');
                        });
                });
                if (isset($filters['status']) && $filters['status'] !== 'all') {
                    $users->where('status', $filters['status']);
                }

            } else {
                $users = $this->userModel->query();

                $users->where('status', '!=', User::STATUS_PENDING)
                    ->where(function ($q) {
                        $q->where('status', '!=', User::STATUS_ACTIVE)
                            ->orWhereNotNull('email_verified_at');
                    });

                if ($filters['status'] !== 'all' && !isset($filters['requested'])) {
                    $users->where('status', $filters['status']);
                }
            }

            if (isset($filters['is_verified']) && $filters['is_verified'] !== 'all') {
                if ($filters['is_verified'] === '1') {
                    $users->whereNotNull('email_verified_at');
                } elseif ($filters['is_verified'] === '0') {
                    $users->whereNull('email_verified_at');
                }
            }

            if ($filters['search'] && strlen($filters['search']) >= 3) {
                $users->where(function ($q) use ($filters) {
                    $q->whereRaw("concat(firstname, ' ', lastname) LIKE ?", ["%" . $filters['search'] . "%"])
                        ->orWhere('email', 'LIKE', "%" . $filters['search'] . "%");
                });
            }

            if ($filters['itemPerPage'] === 'All') {
                $total = $users->count();
                return $users->paginate($total);
            }

            return $users->paginate(
                $filters['itemPerPage'],
                ['*'],
                'page',
                $filters['page'] ?? 1
            )->withQueryString();
        } catch (Exception $e) {
            return back()->withErrors([
                'errors' => $e->getMessage(),
            ]);
        }
    }


    public function manageUser($request)
    {
        // dd($request->all());
        try {


            $filename = null;

            if ($request->hasFile('profile')) {
                $file = $request->file('profile');
                $filename = $this->uploadImage($file);
                $file->storeAs($this->userModel::FILE_PATH, $filename);
            }

            if (Auth::check()) {

                // UPDATE (Profile Edit)
                $user = $this->userModel->findOrFail(Auth::id());

                $user->update([
                    'firstname' => $request['firstname'],
                    'lastname' => $request['lastname'],
                    'email' => $request['email'],
                    'profile' => $filename ?? $user->profile,
                    'bio' => $request['bio'],
                ]);

            } else {
                $user = $this->userModel->where('email', $request['email'])->first();
                if ($user) {
                    return 409;
                }
                $user = $this->userModel->create([
                    'firstname' => $request['firstname'],
                    'lastname' => $request['lastname'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                    'profile' => $filename,
                    'bio' => $request['bio'] ?? null,
                ]);
            }
            if ($user->wasRecentlyCreated) {
                return $user;
            }

            return 200;

        } catch (Exception $e) {
            dd($e);
            throw new Exception("Failed to manage profile: " . $e->getMessage());
        }
    }

    public function changePassword($request)
    {
        try {
            $user = $this->userModel->where('id', Auth::id())->first();

            if (!Hash::check($request['currentpassword'], $user->password)) {
                return 1;
            }

            if ($request['newpassword'] !== $request['confirmpassword']) {
                return 2;
            }

            $user->password = bcrypt($request['newpassword']);
            $user->save();

            // return $user;
            return 0;
        } catch (Exception $e) {
            throw new Exception("Failed to change password: " . $e->getMessage());
        }
    }

    public function statusUser($request)
    {
        try {

            $user = $this->userModel->where('id', $request['id'])->first();
            $user->status = $request['status'];
            $user->save();
            return $user;

        } catch (Exception $e) {
            throw new Exception("Failed to change user status: " . $e->getMessage());
        }
    }
    public function userStatistics()
    {
        try {
            $user['total'] = $this->userModel->count();

            $user['active'] = $this->userModel->where('status', User::STATUS_ACTIVE)
                ->whereNotNull('email_verified_at')
                ->count();

            $user['inactive'] = $this->userModel->where('status', User::STATUS_INACTIVE)->count();

            $user['pending_strict'] = $this->userModel->where('status', User::STATUS_PENDING)->count();

            $user['approved_requests'] = $this->userModel->where('status', User::STATUS_ACTIVE)
                ->whereNull('email_verified_at')
                ->count();

            $user['verified_requests'] = $this->userModel->where('status', User::STATUS_PENDING)
                ->whereNotNull('email_verified_at')
                ->count();

            $user['pending'] = $user['pending_strict'] + $user['approved_requests'];

            return $user;
        } catch (Exception $e) {
            throw new Exception("Failed to get user statistics: " . $e->getMessage());
        }
    }
    public function deleteUser($request)
    {
    }
}
