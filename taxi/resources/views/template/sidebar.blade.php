<aside class="main-sidebar sidebar-dark-primary elevation-4 rounded-left">
    <a href="{{ asset('AdminLTE-3.1.0/index3.html') }}" class="brand-link">
        <img src="{{ asset('img/logo.png') }}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3 bg-white" style="opacity: .8">
        <span class="brand-text "><strong>{{ config('app.name') }}</strong>
         @if(Auth::guard('driver')->check())
                Driver
            @elseif(Auth::guard('customer')->check())
                customer
            @endif
        </span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="
                    @if(Auth::guard('driver')->check())
                        {{ asset(Auth::guard('driver')->user()->picture) }}
                     @elseif(Auth::guard('customer')->check())
                        {{ asset(Auth::guard('customer')->user()->picture) }}
                     @endif
                         "
                     class="img-circle  elevation-5 "
                     alt="User Image" width="20px">
            </div>
            <div class="info">
                <a href="
                    @if(Auth::guard('driver')->check())
                        {{url('driver/profile/'.Auth::guard('driver')->user()->id)}}
                    @elseif(Auth::guard('customer')->check())
                        {{url('customer/profile/'.Auth::guard('customer')->user()->id)}}
                    @endif"
                   class="d-block">
                    @if(Auth::guard('driver')->check())
                        {{Auth::guard('driver')->user()->name}}
                    @elseif(Auth::guard('customer')->check())
                        {{Auth::guard('customer')->user()->name}}
                    @endif
                </a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="
                        @if(auth('driver')->check())
                            {{url('driver/ride')}}
                        @elseif(auth('customer')->check())
                          {{url('customer/ride')}}
                        @endif"
                       class="nav-link">
                        <i class="nav-icon fas fa-car"></i>
                        <p>
                            Rides
                        </p>
                    </a>
                </li>
                @if(auth('customer')->check())
                    <li class="nav-item">
                        <a href="{{url('customer/ride/create')}}" class="nav-link">
                            <i class="nav-icon fas fa-car-side"></i>
                            <p>
                                Create Ride
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="
                        @if(auth('driver')->check())
                            {{url('driver/payment')}}
                        @elseif(auth('customer')->check())
                          {{url('customer/payment')}}
                        @endif"
                       class="nav-link">
                        <i class="nav-icon fas fa-money-bill"></i>
                        <p>
                            Payments
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="
                        @if(auth('driver')->check())
                            {{url('driver/ride/rating')}}
                        @elseif(auth('customer')->check())
                          {{url('customer/ride/rating')}}
                        @endif"
                       class="nav-link">
                        <i class="nav-icon fas fa-male"></i>
                        <p>
                            Ratings
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
