<?php
session_start();
error_reporting(0);

if (isset($_SESSION['email'])) {
} else {
    header('location:login.php');
}
//showProfile() , expenseFunction(), showBudget() will be inside almost all php file. showProfile() will show profile info. expenseFunction() and showBudget() will help the bell notification
include('class/database.php');
class profile extends database
{
    protected $link;
    public function showProfile()
    {
        $email = $_SESSION['email'];
        $sql = "select * from user_tbl where email = '$email' ";
        $res = mysqli_query($this->link, $sql);

        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function expenseFunction()
    {
        $email = $_SESSION['email'];
        $total = 0;
        $sql = "SELECT expense_type, SUM(expense_amount) as amount FROM `expense_tbl` where email = '$email' AND MONTH(expense_date) = MONTH(CURRENT_DATE())
        AND YEAR(expense_date) = YEAR(CURRENT_DATE())";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $total += $row['amount'];
            }
        }
        return $total;

        # code...
    }
    public function showBudget()
    {
        $email = $_SESSION['email'];
        $monthYear = date('F, Y');

        $sqlFind = "SELECT * from budget_tbl where budget_month = '$monthYear' AND email = '$email' ";
        $resFind = mysqli_query($this->link, $sqlFind);
        if (mysqli_num_rows($resFind) > 0) {
            return $resFind;
        } else {
            return 0;
        }
        # code...
    }
}
$obj = new profile;
$objShow = $obj->showProfile();
$objBudget = $obj->showBudget();
$objExpense = $obj->expenseFunction();
$row = mysqli_fetch_assoc($objShow);
//Get the progress %
if (is_object($objBudget) != 0) {
    $rowBudget = mysqli_fetch_assoc($objBudget);
    $progress = round(($objExpense / $rowBudget['budget']) * 100, 2);
}
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
                            <div class="col-md-6">
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
                            <div class="col-md-6">
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
                            <div class="col-md-6 mt-4">
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
                            <div class="col-md-6 mt-4">
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
                            <div class="col-md-6 mt-4">
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
                            <div class="col-md-6 mt-4">
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