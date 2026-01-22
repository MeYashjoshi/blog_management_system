@extends('dashboard.layout.main')

@section('title', 'My Profile')

@section('content')


                <div class="content-section">
                    <div class="profile-header">
                        <div class="profile-avatar-lg">
                        <img src="{{ asset('assets/img/author/top-author-1.png') }}" alt="User Avatar">
                        </div>
                        <div class="profile-header-info">
                            <h3>John Doe</h3>
                            <p>john.doe@example.com</p>
                            <span class="user-role">Admin</span>
                        </div>
                    </div>
                </div>

                <div class="content-section">
                    <h2 class="section-title">
                       Edit Profile
                    </h2>

                    <form>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="firstName">First Name</label>
                                <input type="text" id="firstName" name="firstName" placeholder="Enter your first name" value="John" />
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" id="lastName" name="lastName" placeholder="Enter your last name" value="Doe" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" placeholder="Enter your email" value="john.doe@example.com" />
                        </div>

                        <div class="form-group">
                            <label for="bio">Bio</label>
                            <textarea id="bio" name="bio" rows="4" placeholder="Tell us about yourself...">I am a real blogger</textarea>
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

                    <form>
                        <div class="form-group">
                            <label for="currentPassword">Current Password</label>
                            <input type="password" id="currentPassword" name="currentPassword" placeholder="Enter your current password" />
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="newPassword">New Password</label>
                                <input type="password" id="newPassword" name="newPassword" placeholder="Enter your new password" />
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword">Confirm Password</label>
                                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your new password" />
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
