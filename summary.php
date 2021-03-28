<?php
session_start();
error_reporting(0);

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
    public function expensePrevFunction()
    {

        //         SELECT * FROM table
        // WHERE YEAR(date_created) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
        // AND MONTH(date_created) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)

        $email = $_SESSION['email'];



        $email = $_SESSION['email'];
        $total = 0;
        //This query will find expense from previous month
        $sql = "SELECT expense_type, SUM(expense_amount) as amount FROM `expense_tbl` where email = '$email' AND MONTH(expense_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
        AND YEAR(expense_date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $total += $row['amount'];
            }
        }
        return $total;
        # code...
    }
    public function expenseYearFunction()
    {
        $email = $_SESSION['email'];
        $total = 0;
        //Expense to find recent year
        $sql = "SELECT expense_type, SUM(expense_amount) as amount FROM `expense_tbl` where email = '$email' AND  YEAR(expense_date) = YEAR(CURRENT_DATE())";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $total += $row['amount'];
            }
        }
        return $total;
        # code...
    }
    public function incomeFunction()
    {
        $email = $_SESSION['email'];
        $total = 0;
        $sql = "SELECT income_type, SUM(income_amount) as amount FROM `income_tbl` where email = '$email' AND MONTH(income_date) = MONTH(CURRENT_DATE())
        AND YEAR(income_date) = YEAR(CURRENT_DATE())";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $total += $row['amount'];
            }
        }
        return $total;

        # code...
    }
    public function incomePrevFunction()
    {
        $email = $_SESSION['email'];
        $total = 0;
        $sql = "SELECT income_type, SUM(income_amount) as amount FROM `income_tbl` where email = '$email' AND MONTH(income_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
        AND YEAR(income_date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $total += $row['amount'];
            }
        }
        return $total;
        # code...
    }
    public function incomeYearFunction()
    {
        $email = $_SESSION['email'];
        $total = 0;
        $sql = "SELECT income_type, SUM(income_amount) as amount FROM `income_tbl` where email = '$email' AND  YEAR(income_date) = YEAR(CURRENT_DATE())";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $total += $row['amount'];
            }
        }
        return $total;
        # code...
    }
    public function budgetFunction()
    {
        if (isset($_POST['confirm'])) {
            $email = $_SESSION['email'];
            $budget = $_POST['budget'];
            $monthYear = $_POST['monthYear'];
            //This query will check if the user already set the budget
            $sqlFind = "SELECT * from budget_tbl where budget_month = '$monthYear' AND email = '$email' ";
            $resFind = mysqli_query($this->link, $sqlFind);
            if (mysqli_num_rows($resFind) > 0) {
                //If the budget is set. User can update it anytime
                $sql = "UPDATE `budget_tbl` SET `budget`='$budget' WHERE `budget_month`= '$monthYear' AND `email`='$email'";
                $res = mysqli_query($this->link, $sql);
                if ($res) {
                    $msg = ' <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Target Budget is updated</strong>
                  </div>';
                    return $msg;
                }
            } else {
                //If not user's budget will be inserted
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
        $monthYear = date('F, Y'); //This month and year in PHP

        $sqlFind = "SELECT * from budget_tbl where budget_month = '$monthYear' AND email = '$email' ";
        $resFind = mysqli_query($this->link, $sqlFind);
        if (mysqli_num_rows($resFind) > 0) {
            return $resFind;
        } else {
            return false;
        }
        # code...
    }
    public function balanceFunction($income, $expense)
    {
        $date = date('Y-m-d');
        $email = $_SESSION['email'];
        $incomeBal = $income;
        $expenseBal = $expense;
        //Income -  Expense we can find the remaining budget
        $remain = (int)$incomeBal - (int)$expenseBal;
        $setBal = 0;
        $month = date('F, Y');

        //This query will find the budget that is belong that user
        $sql = "SELECT * FROM `balance_tbl` where email = '$email' AND MONTH(balance_date) = MONTH(CURRENT_DATE())
        AND YEAR(balance_date) = YEAR(CURRENT_DATE())";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            //If the balance is already there it will update
            $sql = "UPDATE `balance_tbl` SET `balance_income`= '$incomeBal',`balance_expense`= '$expenseBal', `balance_month` = '$month', `balance_remain`= '$remain' WHERE email = '$email' AND MONTH(balance_date) = MONTH(CURRENT_DATE())
            AND YEAR(balance_date) = YEAR(CURRENT_DATE())";
            $res = mysqli_query($this->link, $sql);
            $setBal = $remain;
        } else {
            $sql = "INSERT INTO `balance_tbl` (`balance_id`, `balance_date`, `balance_month`, `balance_income`, `balance_expense`, `balance_remain`, `email`, `balance_created`) VALUES (NULL, '$date', '$month', '$incomeBal', '$expenseBal', '$remain + $setBal', '$email', CURRENT_TIMESTAMP)";
            $res = mysqli_query($this->link, $sql);
        }
        // echo $setBal;
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
    $progress = round(((int)$objExpense / (int)$rowBudget['budget']) * 100, 2);
}
$row = mysqli_fetch_assoc($objShow);
$objIncome = $obj->incomeFunction();
$obj->balanceFunction($objIncome, $objExpense);
// echo date('F, Y', strtotime('2021-02-20'));
// echo date('Y-m-d');
// $date = DateTime::createFromFormat('d/m/Y', "24/04/2012");
// echo $date->format('Y-m-d');
// echo basename($_SERVER["SCRIPT_FILENAME"], '.php');


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
                                    £<?php if ($objBudget) {  ?><?php echo $rowBudget['budget']; ?></ <?php } else {
                                                                                                        echo '0';
                                                                                                    } ?></p>
                            </div>
                            <div class="col-md-4">
                                <h5 class="font-weight-bold" style="color: #05445E">Spent this month</h5>
                                <p class="font-weight-bold">£<?php echo $objExpense; ?></p>
                            </div>
                            <div class="col-md-4">
                                <h5 class="font-weight-bold" style="color: #05445E">Remaining budget for this month</h5>
                                <p class="font-weight-bold">
                                    £<?php if ($objBudget) {  ?><?php echo $rowBudget['budget'] - $objExpense; ?><?php } else {
                                                                                                                    echo '0';
                                                                                                                } ?>
                                </p>
                            </div>
                        </div>
                        <div class="progress" style="height: 30px;">
                            <div class="progress-bar progress-bar-striped <?php if ($progress >= 60 && $progress <= 80) {
                                                                                echo 'bg-warning';
                                                                            } else if (80 < $progress) {
                                                                                echo 'bg-danger';
                                                                            } else {
                                                                                echo 'bg-primary';
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
                            <div class="col-md-12 mt-4">
                                <canvas id="myChart1"></canvas>
                            </div>
                            <div class="col-md-12 mt-4">
                                <canvas id="myBar"></canvas>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php include('layout/footer.php'); ?>
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
                        hoverBorderWidth: 10,

                        borderColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        hoverBorderColor: [
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
                        borderWidth: 2,
                        hoverOffset: 4,
                        offset: 6
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
                        },
                        animation: {
                            animateScale: true
                        },
                        tooltips: {
                            callbacks: {
                                label: function(tooltipItems, data) {
                                    return data.labels[tooltipItems.index] +
                                        " : " +
                                        data.datasets[tooltipItems.datasetIndex].data[
                                            tooltipItems.index] +
                                        '%';
                                }
                            }
                        },
                        plugins: {
                            datalabels: {
                                color: '#fff',
                                padding: 6,
                                anchor: 'end',
                                fillColor: '#000',
                                align: 'start',
                                offset: -10,
                                borderWidth: 2,
                                borderColor: '#fff',
                                borderRadius: 25,
                                backgroundColor: (context) => {
                                    return context.dataset.backgroundColor;
                                },
                                font: {
                                    weight: 'bold',

                                    size: '12'
                                },
                                formatter: (value) => {
                                    return value + '%';
                                },

                            }
                        }

                    }
                });
            }
        });
        $.ajax({
            type: "GET",
            url: "incomeDoughnut.php",
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
                    type.push(item.income_type);
                    amount.push((parseInt(item.amount) / total * 100).toFixed(2));
                });
                console.log(total);
                console.log(amount, type);
                var chartPie = {
                    labels: type,
                    datasets: [{
                        label: 'Income Type',
                        data: amount,
                        hoverBorderWidth: 10,

                        borderColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        hoverBorderColor: [
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
                        borderWidth: 2,
                        hoverOffset: 4,
                        offset: 6
                    }]
                };
                var ctx = document.getElementById('myChart1').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: chartPie,
                    options: {
                        title: {
                            display: true,
                            text: 'This month income in Doughnut Chart(%)',
                            fontSize: 25
                        },
                        legend: {
                            display: true,
                            position: 'bottom',
                        },
                        animation: {
                            animateScale: true
                        },
                        tooltips: {
                            callbacks: {
                                label: function(tooltipItems, data) {
                                    return data.labels[tooltipItems.index] +
                                        " : " +
                                        data.datasets[tooltipItems.datasetIndex].data[
                                            tooltipItems.index] +
                                        '%';
                                }
                            }
                        },
                        plugins: {

                            datalabels: {
                                color: '#fff',
                                padding: 6,
                                anchor: 'end',
                                fillColor: '#000',
                                align: 'start',
                                offset: -10,
                                borderWidth: 2,
                                borderColor: '#fff',
                                borderRadius: 25,
                                backgroundColor: (context) => {
                                    return context.dataset.backgroundColor;
                                },
                                font: {
                                    weight: 'bold',

                                    size: '12'
                                },
                                formatter: (value) => {
                                    return value + '%';
                                },

                            }
                        }

                    }
                });
            }
        });
        $.ajax({
            type: "GET",
            url: "balance.php",
            dataType: 'json',
            success: function(data) {
                let type = [];
                let amount = [];
                let total = 0;
                console.log(data);


                $.each(data, function(i, item) {
                    console.log(item);
                    type.push(item.bal_month);
                    amount.push(item.remain);
                });
                console.log(total);
                console.log(amount, type);
                var chartPie = {
                    labels: type,
                    datasets: [{
                        label: 'Previous Months Balance',
                        data: amount,
                        hoverBorderWidth: 10,

                        borderColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        hoverBorderColor: [
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
                        borderWidth: 2,
                        hoverOffset: 4,
                        offset: 6

                    }]
                };

                var ctx = document.getElementById('myBar').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: chartPie,
                    options: {
                        title: {
                            display: true,
                            text: 'Previous Months Balance',
                            fontSize: 25
                        },
                        legend: {
                            display: false,
                            position: 'bottom',
                        },
                        animation: {
                            animateScale: true
                        },
                        tooltips: {
                            callbacks: {
                                label: function(tooltipItems, data) {
                                    return "Available Balance" +
                                        " : " +
                                        '£' +
                                        data.datasets[tooltipItems.datasetIndex].data[
                                            tooltipItems.index];
                                }
                            }
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                        plugins: {
                            datalabels: {
                                color: '#fff',
                                padding: 6,
                                anchor: 'end',
                                fillColor: '#000',
                                align: 'start',
                                offset: -10,
                                borderWidth: 2,
                                borderColor: '#fff',
                                borderRadius: 25,
                                backgroundColor: (context) => {
                                    return context.dataset.backgroundColor;
                                },
                                font: {
                                    weight: 'bold',

                                    size: '12'
                                },
                                formatter: (value) => {
                                    return '£' + value;
                                },

                            }
                        }




                    }
                });
            }
        });
    })
    </script>

</body>

</html>