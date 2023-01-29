<!DOCTYPE html>
<html lang="EN">

<head>

    <?php
        require_once("./includes/head.php");
    ?>

    <title>LIFE - Living It Fully Everyday</title>

    <link rel="stylesheet" type="text/css" href="./plugins/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="./plugins/slick/slick-theme.css">

</head>

<body>

    <?php require_once("./includes/header.php"); ?>

    <noscript>Please enable JavaScript for this page to function properly.</noscript>

    <div class="carousel-panel">
        <div><img class="carousel-image" src="./assets/images/pexels-max-nikhil-thimmayya-802417-carousel-resize.jpg" alt="Carousel Yoga Image"></div>
        <div><img class="carousel-image" src="./assets/images/pexels-prasanth-inturi-1051838-carousel-resize.jpg" alt="Carousel Meditation Image"></div>
        <div><img class="carousel-image" src="./assets/images/pexels-jonathan-borba-3076509-carousel-resize.jpg" alt="Carousel Stretching Image"></div>
        <div><img class="carousel-image" src="./assets/images/pexels-mali-maeder-1278952-carousel-resize.jpg" alt="Carousel Healthy Habits Image"></div>
    </div>

    <main class="homepage">
        <div class="home-intro">
            <div class="home-intro-text">
                <h1>Living It Fully Everyday</h1>
                <h2>Helping the community live a healthier lifestyle</h2>
            </div>
        </div>

        <?php
            if (!isLoggedIn()) {
                require_once("./includes/home-info-panel.php");
            } else {
                require_once("./includes/services-panel.php");
            }
        ?>

    </main>

    <?php require_once("./includes/footer.php"); ?>

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="./plugins/slick/slick.min.js"></script>
    <script type="text/javascript" src="./js/carousel.js"></script>
</body>

</html>