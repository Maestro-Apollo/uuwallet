<?php
session_start();
error_reporting(0);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('layout/style.php'); ?>


    <style>
    .navbar-brand {
        width: 7%;
    }

    .bg_color {
        background-color: #fff !important;
    }

    body {
        font-family: 'Raleway', sans-serif;
    }

    .carousel-caption {
        top: 50%;
        transform: translateY(-50%);
        bottom: initial;
        -webkit-transform-style: preserve-3d;
        -moz-transform-style: preserve-3d;
        transform-style: preserve-3d;
    }

    .carousel .carousel-item {
        height: 80vh;
    }

    .carousel-item img {
        position: absolute;
        top: 0;
        left: 0;
        min-height: 80vh;
        object-fit: cover;

    }

    section {
        padding: 60px 0;
    }

    .carousel-item:after {
        content: "";
        display: block;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
    }
    </style>


</head>

<body class="bg-light">
    <?php include('layout/navbar.php'); ?>

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="images/graphs-5932187_1920.jpg" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                    <h2 class="font-weight-bold text-center" style=" font-family: 'Lato', sans-serif;">
                        Save Money And Money Will Save You </h2>

                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/freelancer-763730_1920.jpg" alt="Second slide">
                <div class="carousel-caption d-none d-md-block">
                    <h2 class="font-weight-bold text-center" style=" font-family: 'Lato', sans-serif;">
                        Must Learn To Save First And Spend Afterwards! </h2>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/analysis-1841158_1920.jpg" alt="Third slide">
                <div class="carousel-caption d-none d-md-block">
                    <h2 class="font-weight-bold text-center" style=" font-family: 'Lato', sans-serif;">
                        Set Goals. Stay Focused. Make Money.</h2>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


    <div class="bg-white">
        <section>
            <div class="container">
                <h2 class="font-weight-bold text-center" style="color: #05445E; font-family: 'Lato', sans-serif;">Our
                    Services
                    :</h2>
                <div class="row text-center mt-5">
                    <div class="col-md-4">
                        <img src="images/income.png" class="w-50" alt="">
                        <h5 class="font-weight-bold text-center"
                            style="color: #05445E; font-family: 'Lato', sans-serif;">Student's Income</h5>
                    </div>
                    <div class="col-md-4">
                        <img src="images/buy.png" class="w-50" alt="">
                        <h5 class="font-weight-bold text-center"
                            style="color: #05445E; font-family: 'Lato', sans-serif;">Student's Expense</h5>
                    </div>
                    <div class="col-md-4">
                        <img src="images/budget.png" class="w-50" alt="">
                        <h5 class="font-weight-bold text-center"
                            style="color: #05445E; font-family: 'Lato', sans-serif;">Student's Budget</h5>
                    </div>
                </div>

            </div>
        </section>

    </div>







    <?php include('layout/footer.php'); ?>

    <?php include('layout/script.php') ?>


</body>

</html>