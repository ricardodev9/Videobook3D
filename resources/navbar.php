<link rel="stylesheet" href="assets/css/navbar.css">
<nav class="navbar">
    <div class="navbar-container container">
        <input type="checkbox" name="" id="">
        <div class="hamburger-lines">
            <span class="line line1"></span>
            <span class="line line2"></span>
            <span class="line line3"></span>
        </div>
        <ul class="menu-items">
            <li><a href="<?=__DIR__.'/index.php'?>">Home</a></li>
            <li><a href="<?=__DIR__.'/index.php?view=users'?>">Users</a></li>
            <li><a href="https://www.linkedin.com/in/ricardo-apaza-cueva-43b0572a1/" target="_blank">About me</a></li>
            <li><a href="mailto:ricardoapazacueva2000@gmail.com">Contact</a></li>
            <?php
            echo isset($_SESSION['user_email'])
                ? '<li><a href="inc/login.php?action=logout">Logout</a></li>'
                : '<li><a href="'.__DIR__.'/login.php">Login</a></li>';
            ?>
        </ul>
        <h1 class="logo">VideoBook3D</h1>
    </div>
</nav>