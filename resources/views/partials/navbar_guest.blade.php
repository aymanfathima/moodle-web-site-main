<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">Contact Us</a>
                </li>
                @if (AppHelper::isLogged())
                    @if (AppHelper::isAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin_dashboard') }}">Dashboard</a>
                        </li>
                    @elseif (AppHelper::isTeacher())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('teacher_dashboard') }}">Dashboard</a>
                        </li>
                    @elseif (AppHelper::isStudent())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('student_dashboard') }}">Dashboard</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                    </li>

                @endif
            </ul>
        </div>
    </div>
</nav>
