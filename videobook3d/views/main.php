<?php
require 'videobook3d.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VideoBook3D</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/cardbox.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="assets/js/imdb_by_name.js"></script>
</head>

<body>
    <?php include LAYOUTS_FOLDER.'/header.php'; ?>

    <div id="home-content">
        <?php echo $content; ?>
    </div>

    <?php include LAYOUTS_FOLDER.'/footer.php'; ?>
</body>

</html>