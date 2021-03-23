<?php
session_start();
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
    </style>

</head>

<body class="bg-light">
    <?php include('layout/navbar.php'); ?>


    <section>
        <div class="container">
            <div class="row">

                <div class="col-md-12">


                    <div class="account bg-white mt-5 p-5 rounded">
                        <h2 class="font-weight-bold text-center"
                            style="color: #05445E; font-family: 'Lato', sans-serif;">Who we are :</h2>
                        <p class="text-justify font-weight-bold">Lorem ipsum, dolor sit amet consectetur adipisicing
                            elit. Similique fugit sint facere
                            corrupti labore quasi dolores sed reprehenderit aut itaque quod vel, voluptatum eligendi
                            mollitia quo eos maxime deleniti nihil exercitationem necessitatibus quam autem possimus
                            porro! Ipsum libero numquam sapiente? Nisi, voluptates. Excepturi voluptas quaerat nemo ea,
                            dolore reprehenderit nam facilis. Explicabo voluptatem totam eveniet cupiditate corrupti
                            eaque quia iusto facilis nam laboriosam qui nobis quas fuga facere unde, ut maxime officia
                            reiciendis esse consequatur distinctio? Ex quo, quaerat laudantium atque voluptatibus iste
                            sed nesciunt. Temporibus repellendus, odit non hic reiciendis eveniet in consequatur? Nihil
                            repellat sequi ipsam molestias necessitatibus!</p>
                        <h2 class="font-weight-bold mt-4 text-center"
                            style="color: #05445E; font-family: 'Lato', sans-serif;">FAQ :</h2>
                        <div class="row">
                            <div class="col-md-6 offset-3">
                                <div class="card mx-auto">
                                    <h5 class="card-header font-weight-bold">Who is the application aimed at?</h5>
                                    <div class="card-body">

                                        <p class="card-text font-weight-bold">The application mainly aimed at a student
                                            base to help
                                            manage their
                                            finances...</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php include('layout/footer.php'); ?>

    <?php include('layout/script.php') ?>

</body>

</html>