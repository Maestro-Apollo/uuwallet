<?php
session_start();
error_reporting(0);


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
                        <p class="text-justify font-weight-bold">Our goal is to help student to maintain their monthly
                            budget. Sometimes they don't set a target about spending money. So they end up spending a
                            lot money without their
                            knowledge. So our system will help them maintain their expense and income in interesting
                            way.
                        </p>
                        <p class="text-justify font-weight-bold">
                            In our system students first have to open an account. After creating an account in our
                            system they can share their monthly expense and income. Student can set their target budget
                            for the month. When the target budget is set, students can see the progress how much they
                            spend in this month and how much they can spend in the remaining days. In expense page
                            student can select
                            their expense options and input their expense amount. Date is by default will be set as
                            current month. But if students want they can also enter pervious months expense also. Same
                            functionality is available inside income page. <br> <br>
                            After sharing all the transitions student can now see their expenses in pie chart. In pie
                            chart they can see the percentage of expenses. Where they put their money most. Same
                            thing goes for income. They can see income in doughnut chart. There is also bar chart where
                            student can see the previous 4 months remaining balance. Difference between how much they
                            earn in a month and the total cost will consider as remaining balance. Which we believe will
                            help them become more aware and parsimonious in their everyday life.
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php include('layout/footer.php'); ?>

    <?php include('layout/script.php') ?>

</body>

</html>