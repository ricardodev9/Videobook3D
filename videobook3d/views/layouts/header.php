<link rel="stylesheet" href="assets/css/navbar.css">
<?php
 $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/videobook3d";
?>
<nav class="navbar">
    <div class="navbar-container container">
        <input type="checkbox" name="" id="">
        <div class="hamburger-lines">
            <span class="line line1"></span>
            <span class="line line2"></span>
            <span class="line line3"></span>
        </div>
        <ul class="menu-items">
            <li><a href="<?=$baseUrl?>/index.php">Home</a></li>
            <li><a href="<?=$baseUrl?>/index.php?view=users">Users</a></li>
            <li><a href="<?=$baseUrl?>/index.php?view=aboutus">About VideoBook3D</a></li>
            <li><a href="<?=$baseUrl?>/index.php?view=myvideobooks">Mis videobooks</a></li>
            <?php
            echo isset($_SESSION['user_email'])
                ? '<li><a href="inc/login.php?action=logout">Logout</a></li>'
                : '<li><a href="'.__DIR__.'/login.php">Login</a></li>';
            ?>
        </ul>
        <h1 class="logo"><a href="<?=$baseUrl?>/index.php">VideoBook3D</a></h1>
    </div>
</nav>