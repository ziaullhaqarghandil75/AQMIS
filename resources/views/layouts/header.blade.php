<div class="navbar navbar-expand-md navbar-light">
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center ml-auto mr-md-4">
            <!-- Timer Section -->
            <div class="timer">
                <span id="seconds">00</span> :
                <span id="minutes">00</span> :
                <span id="hours">00</span>
            </div>

            <!-- Online/Offline Status -->
            {!! auth()->user()->isOnline()
                ? "<span class='badge bg-success ml-md-3'>Online</span>"
                : "<span class='badge bg-danger ml-md-3'>Offline</span>" !!}
        </div>
    </div>

    <!-- Mobile Menu Toggles -->
    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile"
            aria-label="Toggle navigation">
            <i class="icon-tree5"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button" aria-label="Toggle sidebar">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>

    <!-- Navbar Content -->
    <div class="collapse navbar-collapse" id="navbar-mobile">
        <!-- Sidebar Toggle -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>
        </ul>
        <!-- User Menu -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle"
                    data-toggle="dropdown">
                    <img src="{{ asset(auth()->user()->img ?? 'images/user.png') }}" class="rounded-circle mr-2"
                        height="34" width="34" alt="User Image">
                    <span>{{ auth()->user()->name }} {{ auth()->user()->last_name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('user.profile') }}" class="dropdown-item">
                        <i class="icon-user-plus"></i> تنظیمات
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <button type="button" class="dropdown-item"
                        onclick="document.getElementById('logout-form').submit();">
                        <i class="icon-switch2"></i> خروج
                    </button>
                </div>
            </li>
        </ul>
    </div>
</div>
