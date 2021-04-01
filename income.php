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
$row = mysqli_fetch_assoc($objShow);
$objBudget = $obj->showBudget();
$objExpense = $obj->expenseFunction();
if (is_object($objBudget) != 0) {
    $rowBudget = mysqli_fetch_assoc($objBudget);
    $progress = round(($objExpense / $rowBudget['budget']) * 100, 2);
}

// $d1 = new DateTime("2018-01-10");
// $d2 = new DateTime("2019-05-18");
// $interval = $d1->diff($d2);

// $diffInDays    = $interval->d; //21
// $diffInMonths  = $interval->m; //4
// $diffInYears   = $interval->y; //1

// echo $diffInMonths


// $date1 = '2000-01-25';
// $date2 = '2010-02-20';

// $ts1 = strtotime($date1);
// $ts2 = strtotime($date2);

// $year1 = date('Y', $ts1);
// $year2 = date('Y', $ts2);

// $month1 = date('m', $ts1);
// $month2 = date('m', $ts2);

// $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
// echo $diff;

// $dt = (int)date("m");
// echo var_dump($dt);


// $dt = DateTime::createFromFormat('d/m/Y', '23/03/2021');
// echo $dt->getTimestamp(); 



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('layout/style.php'); ?>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

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
                        <h4 class="font-weight-bold" style="color: #05445E">Enter Income Amount Here</h4>
                        <div id="output"></div>
                        <form action="" id="myForm">
                            <div class="row mt-4">
                                <div class="col-md-7">


                                    <label class="font-weight-bold mt-4" for="">Enter Date</label>
                                    <input type="text" id="datepicker" name="date"
                                        class="bg-light form-control border-0" required>
                                    <label class="font-weight-bold mt-4" for="confirm_pass">Select Income Type</label>
                                    <select name="type" class="bg-light form-control border-0" id="" required>
                                        <option value="" disabled selected>Choose an option</option>
                                        <option value="Student Loan">Student Loan</option>
                                        <option value="Buisary/Grant">Buisary/Grant</option>
                                        <option value="Job">Job</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <label class="font-weight-bold mt-4" for="">Enter Amount</label>
                                    <input type="number" name="amount" min="1" class="bg-light form-control border-0"
                                        required>
                                    <input type="hidden" value="<?php echo date("m"); ?>" name="month"
                                        class="bg-light form-control border-0" required>
                                    <input type="hidden" value="<?php echo $_SESSION['email']; ?>" name="email"
                                        class="bg-light form-control border-0" required>
                                </div>
                                <div class="col-md-5"></div>
                            </div>
                            <input class="btn font-weight-bold log_btn btn-lg mt-5" type="submit" name="upload"
                                value="Add">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php include('layout/footer.php'); ?>

    <?php include('layout/script.php') ?>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
    $(document).ready(function() {
        $('#myForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "incomeAjax.php",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#output').fadeIn().html(response);
                    setTimeout(() => {
                        $('#output').fadeOut('slow');
                    }, 2000);
                }
            });
        });
    })

    $(function() {
        $("#datepicker").datepicker({
            changeMonth: false,
            changeYear: false,
            dateFormat: 'dd/mm/yy',
            duration: 'fast'
        }).focus(function() {
            $(".ui-datepicker-next").remove();
        });
    });
    </script>
</body>

</html>