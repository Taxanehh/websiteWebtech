<div class="nav">
    <div class="nav-inner">
        <div class="nav-left">
            <a href="/reservations">Reservations</a>
            <a href="/menu">Menus</a>
            <a href="/about">About</a>
        </div>
        <a href="/"><img class="logo" src="/assets/images/logo/logo.png"></a>
        <div class="nav-right">
            <a href="/contact">Contact</a>
            <?php
            if (isset($_SESSION['user'])) {
                echo "<a href='/dashboard'>Dashboard</a>";
                echo '<a href="/logout">Logout</a>';
            } else {
                echo '<a href="/register">Register</a>';
                echo '<a href="/login">Login</a>';
            }
            ?>
        </div>

        <!-- Mobile menu -->
        <div class="hamburger-menu">
            <!-- Heroicons bars-3 -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
            </svg>
        </div>
        <div class="mobile-menu">
            <a href="/reservations">Reservations</a>
            <!-- TODO: Dropdown menu -->
            <a href="#">Menus</a>
            <a href="/about">About</a>
            <a href="/contact">Contact</a>
            <?php
            if (isset($_SESSION['user'])) {
                echo "<a href='/dashboard'>Dashboard</a>";
                echo '<a href="/logout">Logout</a>';
            } else {
                echo '<a href="/register">Register</a>';
                echo '<a href="/login">Login</a>';
            }
            ?>
        </div>
    </div>
</div>
