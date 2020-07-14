<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : SITE_NAME ?></title>
    <link rel="stylesheet" href="<?= ROOT_URL ?>/css/style.css">

<!--    Bootstrap CSS -->
    <link rel="stylesheet" href="<?= ROOT_URL ?>/css/bootstrap.min.css">

<!--    Owl Carousel-->
    <link rel="stylesheet" href="<?= ROOT_URL ?>/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= ROOT_URL ?>/css/owl.theme.default.min.css">

</head>
<body>
    <?php require ROOT_APP .'/views/inc/navbar.php'; ?>
    <div class="container">