@extends('dashboard.layout.main')

@section('title', 'My Profile')

@section('content')



                <div class="content-section">
                    <div class="profile-header">
                        <div class="profile-avatar-lg">
                        <img src="{{ $user->getProfileUrlAttribute() }}" class="img-fluid rounded-circle" alt="User Avatar">
                        </div>
                        <div class="profile-header-info">
                            <h3>{{ $user->getFullNameAttribute() }}</h3>
                            <p>{{ $user->email }}</p>

                            <span class="user-role">{{ Auth::user()->roles()->first()->name }}</span>
                        </div>
                    </div>
                </div>

                <div class="content-section">
                    <h2 class="section-title">
                       Edit Profile
                    </h2>

                    @error('success')
                        <div class="alert alert-warning" role="alert">
                        {{ $message }}
                        </div>
                    @enderror

                    <form action="{{ route('manageUser') }}" method="POST" enctype="multipart/form-data">

                        @csrf


                        <div class="form-row">
                            <div class="form-group">
                                <label for="firstName">First Name</label>
                                <input type="text" id="firstName" name="firstname" placeholder="Enter your first name" value="{{ $user->firstname }}" />
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" id="lastName" name="lastname" placeholder="Enter your last name" value="{{ $user->lastname }}" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" placeholder="Enter your email" value="{{ $user->email }}" />
                        </div>

                        <div class="form-group">
                            <label for="bio">Bio</label>
                            <textarea id="bio" name="bio" rows="4" placeholder="Tell us about yourself...">{{ $user->bio }}</textarea>
                        </div>
                        {{ $user->profile }}
                        <div class="form-group">
                            <label for="profile">Profile Picture</label>
                            <input type="file" id="profile" name="profile" accept="image/*" />
                        </div>

                        <div class="button-group">
                            <button type="submit" class="btn-primary-dashboard">
                                <i class="fa-solid fa-check"></i> Save Changes
                            </button>
                            <button type="button" class="btn-secondary-dashboard">
                                <i class="fa-solid fa-times"></i> Cancel
                            </button>
                        </div>
                    </form>
                </div>

                <div class="content-section">
                    <h2 class="section-title">
                         Change Password
                    </h2>


                    @session('password_success')
                        <div class="alert alert-success" role="alert">
                            {{ session('password_success') }}
                        </div>
                    @endsession

                    @error('password_error')
                        <div class="alert alert-danger" role="alert">
                        {{ $message }}
                        </div>
                    @enderror


                    <form action="{{ route('changePassword') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="currentPassword">Current Password</label>
                            <input type="password" id="currentpassword" name="currentpassword" placeholder="Enter your current password" value="" />
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="newPassword">New Password</label>
                                <input type="password" id="newpassword" name="newpassword" placeholder="Enter your new password" value=""/>
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword">Confirm Password</label>
                                <input type="password" id="confirmpassword" name="confirmpassword" placeholder="Confirm your new password" value=""/>
                            </div>
                        </div>

                        <div class="button-group">
                            <button type="submit" class="btn-primary-dashboard">
                                <i class="fa-solid fa-check"></i> Update Password
                            </button>
                            <button type="button" class="btn-secondary-dashboard">
                                <i class="fa-solid fa-times"></i> Cancel
                            </button>
                        </div>
                    </form>
                </div>




@endsection
