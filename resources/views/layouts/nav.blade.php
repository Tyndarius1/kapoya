<header>
    <nav class="nav-container">

        <div class="mlg-logo">
            <img src="{{ asset('img/mlg.png') }}" alt="">
            <a href="">MLG College of Learning</a>
        </div>

        <div class="nav-menu">
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="{{ URL('home') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('student') }}">Students</a>
                </li>

                <li class="nav-item">
                    <a href="/employee">Employee</a>
                </li>

                <hr class="nav-divider">

                <li class="nav-item-dropdown">
                    <a href="#" class="nav-link" onclick="toggleDropdown(event)">
                        <h5>Welcome,</h5> {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu">
                        <!-- Logout Form -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                        <a href="#" class="dropdown-item" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                    </div>
                </li>
            </ul>
        </div>

    </nav>
    </header>
