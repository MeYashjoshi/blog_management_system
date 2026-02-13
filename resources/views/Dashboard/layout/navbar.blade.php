 <nav class="navbar-dashboard">
                <div class="navbar-left">

                     @if(View::hasSection('title'))
                       <h1 class="page-title">@yield('title')</h1>
                    @else
                       <h1 class="page-title"></h1>
                    @endif
                </div>

                <div class="navbar-right">

                    <a href="{{ url('/') }}" target="_blank" class="btn btn-primary-dashboard">
                        <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> View Site
                    </a>

                    <div class="user-profile">
                         <img src="{{ asset(Auth::user()->profile_url) }}" alt="Profile" class="profile-img dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="width:40px; height:40px; border-radius:50%; cursor:pointer;">
                        <div class="profile-name">

                            <p>{{Auth::user()->full_name}}</p>
                            <span>{{ucfirst(Auth::user()->getRoleNames()->first())}}</span>
                        </div>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                      <li><a class="dropdown-item" href="/profile">Profile</a></li>
                                      <li>
                                      <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                                <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                      </li>
                        </ul>
                    </div>
                </div>
            </nav>
