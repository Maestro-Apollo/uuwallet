<?php
session_start();
if (isset($_SESSION['email'])) {
} else {
    header('location:login.php');
}
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
        $month1 = 0;
        $dt = (int)date("m");
        $sql = "SELECT *  from expense_tbl where email = '$email' ";
        $res = mysqli_query($this->link, $sql);
        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                $date = $row['expense_date'];
                $ts1 = strtotime($date);
                $month1 = (int)date('m', $ts1);
                if ($dt == $month1) {
                    $sql2 = "SELECT expense_amount FROM expense_tbl where expense_date = '$date' AND email = '$email' ";
                    $res2 = mysqli_query($this->link, $sql2);
                    $dateAmount = mysqli_fetch_assoc($res2);
                    $total += $dateAmount['expense_amount'];
                }
            }
            return $total;
        } else {
            return '0';
        }
        # code...
    }
    public function expensePrevFunction()
    {
        $email = $_SESSION['email'];

        $total1 = 0;
        $month1 = 0;
        $sql = "SELECT *  from expense_tbl where email = '$email'";
        $res = mysqli_query($this->link, $sql);
        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                $date = $row['expense_date'];
                // echo $date . '<br>';
                $ts1 = strtotime($date);
                $dt = (int)date('m') - 1;
                // echo $dt . '<br>';
                $month1 = (int)date('m', $ts1);
                // echo $month1 . '<br>';

                if ($dt == $month1) {
                    $sql2 = "SELECT expense_amount FROM expense_tbl where expense_date = '$date' AND email = '$email' ";
                    $res2 = mysqli_query($this->link, $sql2);
                    $dateAmount = mysqli_fetch_assoc($res2);
                    $total1 += $dateAmount['expense_amount'];
                }
            }
            return $total1;
        } else {
            return '0';
        }
        # code...
    }
    public function expenseYearFunction()
    {
        $email = $_SESSION['email'];

        $total1 = 0;
        $year = 0;
        $sql = "SELECT *  from expense_tbl where email = '$email'";
        $res = mysqli_query($this->link, $sql);
        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                $date = $row['expense_date'];
                // echo $date . '<br>';
                $ts1 = strtotime($date);
                $dt = (int)date('Y');
                // echo $dt . '<br>';
                $year = (int)date('Y', $ts1);
                // echo $year . '<br>';

                if ($dt == $year) {
                    $sql2 = "SELECT expense_amount FROM expense_tbl where expense_date = '$date' AND email = '$email' ";
                    $res2 = mysqli_query($this->link, $sql2);
                    $dateAmount = mysqli_fetch_assoc($res2);
                    $total1 += $dateAmount['expense_amount'];
                }
            }
            return $total1;
        } else {
            return '0';
        }
        # code...
    }
    public function incomeFunction()
    {
        $email = $_SESSION['email'];

        $total = 0;
        $month1 = 0;
        $dt = (int)date("m");
        $sql = "SELECT *  from income_tbl where email = '$email'";
        $res = mysqli_query($this->link, $sql);
        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                $date = $row['income_date'];
                $ts1 = strtotime($date);
                $month1 = (int)date('m', $ts1);
                if ($dt == $month1) {
                    $sql2 = "SELECT income_amount FROM income_tbl where income_date = '$date' AND email = '$email' ";
                    $res2 = mysqli_query($this->link, $sql2);
                    $dateAmount = mysqli_fetch_assoc($res2);
                    $total += $dateAmount['income_amount'];
                }
            }
            return $total;
        } else {
            return '0';
        }
        # code...
    }
    public function incomePrevFunction()
    {
        $email = $_SESSION['email'];

        $total1 = 0;
        $month1 = 0;
        $sql = "SELECT *  from income_tbl where email = '$email'";
        $res = mysqli_query($this->link, $sql);
        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                $date = $row['income_date'];
                // echo $date . '<br>';
                $ts1 = strtotime($date);
                $dt = (int)date('m') - 1;
                // echo $dt . '<br>';
                $month1 = (int)date('m', $ts1);
                // echo $month1 . '<br>';

                if ($dt == $month1) {
                    $sql2 = "SELECT income_amount FROM income_tbl where income_date = '$date' AND email = '$email' ";
                    $res2 = mysqli_query($this->link, $sql2);
                    $dateAmount = mysqli_fetch_assoc($res2);
                    $total1 += $dateAmount['income_amount'];
                }
            }
            return $total1;
        } else {
            return '0';
        }
        # code...
    }
    public function incomeYearFunction()
    {
        $email = $_SESSION['email'];

        $total1 = 0;
        $year = 0;
        $sql = "SELECT *  from income_tbl where email = '$email'";
        $res = mysqli_query($this->link, $sql);
        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                $date = $row['income_date'];
                // echo $date . '<br>';
                $ts1 = strtotime($date);
                $dt = (int)date('Y');
                // echo $dt . '<br>';
                $year = (int)date('Y', $ts1);
                // echo $year . '<br>';

                if ($dt == $year) {
                    $sql2 = "SELECT income_amount FROM income_tbl where income_date = '$date' AND email = '$email' ";
                    $res2 = mysqli_query($this->link, $sql2);
                    $dateAmount = mysqli_fetch_assoc($res2);
                    $total1 += $dateAmount['income_amount'];
                }
            }
            return $total1;
        } else {
            return '0';
        }
        # code...
    }
    public function budgetFunction()
    {
        if (isset($_POST['confirm'])) {
            $email = $_SESSION['email'];
            $budget = $_POST['budget'];
            $monthYear = $_POST['monthYear'];

            $sqlFind = "SELECT * from budget_tbl where budget_month = '$monthYear' AND email = '$email' ";
            $resFind = mysqli_query($this->link, $sqlFind);
            if (mysqli_num_rows($resFind) > 0) {
                $msg = ' <div class="alert alert-warning alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Target Budget is already added</strong>
              </div>';
                return $msg;
            } else {
                $sql = "INSERT INTO `budget_tbl` (`budget_id`, `budget`, `budget_month`, `email`, `budget_created`) VALUES (NULL, '$budget', '$monthYear', '$email', CURRENT_TIMESTAMP)";
                $res = mysqli_query($this->link, $sql);
                if ($res) {
                    header('location:summary.php');
                    return $res;
                } else {
                    return 0;
                }
            }
        }
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
$objExpense = $obj->expenseFunction();
$objPrevExpense = $obj->expensePrevFunction();
$objAddBudget = $obj->budgetFunction();
$objBudget = $obj->showBudget();
if (is_object($objBudget) != 0) {
    $rowBudget = mysqli_fetch_assoc($objBudget);
    $progress = ($objExpense / $rowBudget['budget']) * 100;
}
$row = mysqli_fetch_assoc($objShow);






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
                    <h3 class="float-left d-block font-weight-bold" style="color: #05445E"><span
                            class="text-secondary font-weight-light">Welcome |</span>
                        <?php echo $row['fname'] ?>
                    </h3>

                    <div class="account bg-white mt-5 p-5 rounded">
                        <h4 class="font-weight-bold" style="color: #05445E">Summary For
                            <?php echo date('F 01, Y');  ?> -
                            <?php echo date('F t, Y'); ?>
                        </h4>
                        <?php echo $objAddBudget; ?>
                        <div class="row mt-4">

                            <div class="col-md-4">
                                <h5 class="font-weight-bold" style="color: #05445E">Total spent this month</h5>
                                <p class="font-weight-bold">£<?php echo $objExpense; ?></p>
                            </div>
                            <div class="col-md-4">
                                <h5 class="font-weight-bold" style="color: #05445E">Total spent last month</h5>
                                <p class="font-weight-bold">£<?php echo $objPrevExpense; ?></p>
                            </div>
                            <div class="col-md-4">
                                <h5 class="font-weight-bold" style="color: #05445E">Total spent this year</h5>
                                <p class="font-weight-bold">£<?php echo $obj->expenseYearFunction(); ?></p>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <h5 class="font-weight-bold" style="color: #05445E">Total income this month</h5>
                                <p class="font-weight-bold">£<?php echo $obj->incomeFunction(); ?></p>
                            </div>
                            <div class="col-md-4">
                                <h5 class="font-weight-bold" style="color: #05445E">Total income last month</h5>
                                <p class="font-weight-bold">£<?php echo $obj->incomePrevFunction(); ?></p>
                            </div>
                            <div class="col-md-4">
                                <h5 class="font-weight-bold" style="color: #05445E">Total income this year</h5>
                                <p class="font-weight-bold">£<?php echo $obj->incomeYearFunction(); ?></p>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <h5 class="font-weight-bold" style="color: #05445E">Budget set this month</h5>
                                <p class="font-weight-bold">
                                    £<?php if ($objBudget) {  ?><?php echo $rowBudget['budget']; ?></ <?php } ?></p>
                            </div>
                            <div class="col-md-4">
                                <h5 class="font-weight-bold" style="color: #05445E">Spent this month</h5>
                                <p class="font-weight-bold">£<?php echo $objExpense; ?></p>
                            </div>
                            <div class="col-md-4">
                                <h5 class="font-weight-bold" style="color: #05445E">Remaining budget for this month</h5>
                                <p class="font-weight-bold">
                                    £<?php if ($objBudget) {  ?><?php echo $rowBudget['budget'] - $objExpense; ?><?php } ?>
                                </p>
                            </div>
                        </div>
                        <div class="progress" style="height: 30px;">
                            <div class="progress-bar progress-bar-striped <?php if ($progress > 60 && $progress < 80) {
                                                                                echo 'bg-warning';
                                                                            } else if (80 < $progress) {
                                                                                echo 'bg-danger';
                                                                            } ?> progress-bar-animated"
                                role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                style="width: <?php if (isset($progress)) {
                                                                                                                                                                                                        echo $progress;
                                                                                                                                                                                                    }  ?>%">
                                <strong style="font-family: 'Lato', sans-serif;"><?php if (isset($progress)) {
                                                                                        echo $progress;
                                                                                    }  ?>%</strong>
                            </div>
                        </div>
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-md-6 offset-3 text-center">
                                    <input type="number" class="form-control mt-4 p-4 border-0 bg-light" name="budget"
                                        placeholder="Enter your budget" required>
                                    <input type="hidden" class="form-control mt-4 p-4 border-0 bg-light"
                                        value="<?php echo date('F, Y'); ?>" name="monthYear" required>
                                    <input type="submit" name="confirm" class="btn font-weight-bold log_btn btn-lg mt-4"
                                        value="Confirm">
                                </div>
                            </div>
                        </form>
                        <div class="row mt-5">
                            <div class="col-md-12">

                                <canvas id="myChart"></canvas>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <?php include('layout/script.php') ?>
    <script>
    $(document).ready(function() {
        $.ajax({
            type: "GET",
            url: "expensePie.php",
            dataType: 'json',
            success: function(data) {
                let type = [];
                let amount = [];
                let total = 0;
                console.log(data);

                $.each(data, function(i, item) {
                    total += parseInt(item.amount);
                });
                $.each(data, function(i, item) {
                    console.log(item);
                    type.push(item.expense_type);
                    amount.push((parseInt(item.amount) / total * 100).toFixed(2));
                });
                console.log(total);
                console.log(amount, type);
                var chartPie = {
                    labels: type,
                    datasets: [{
                        label: 'Expense Type',
                        data: amount,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        hoverBackgroundColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        hoverBorderColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderWidth: 2
                    }]
                };
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: chartPie,
                    options: {
                        title: {
                            display: true,
                            text: 'This month expense in Pie Chart(%)',
                            fontSize: 25
                        },
                        legend: {
                            display: true,
                            position: 'bottom',
                        }

                    }
                });
            }
        });
    })
    </script>

</body>

</html>