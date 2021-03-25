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
if (is_object($objBudget) != 0) {
    $rowBudget = mysqli_fetch_assoc($objBudget);
    $progress = round(($objExpense / $rowBudget['budget']) * 100, 2);
}

// $dt = date("m");
// echo $dt


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
                        <h4 class="font-weight-bold" style="color: #05445E">Enter Expense Amount Here</h4>
                        <div id="output"></div>
                        <form action="" id="myForm">
                            <div class="row mt-4">
                                <div class="col-md-7">


                                    <label class="font-weight-bold mt-4" for="">Enter Date</label>
                                    <input type="text" id="datepicker" name="date"
                                        class="bg-light form-control border-0" required>
                                    <label class="font-weight-bold mt-4" for="confirm_pass">Select Expense Type</label>
                                    <select name="type" class="bg-light form-control border-0" id="" required>
                                        <option value="" disabled selected>Choose an option</option>
                                        <option value="Food">Food</option>
                                        <option value="Entertainment">Entertainment</option>
                                        <option value="Travel">Travel</option>
                                        <option value="Phone Bill">Phone Bill</option>
                                        <option value="Internet Bill">Internet Bill</option>
                                        <option value="Media Services">Media Services</option>
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
                url: "expenseAjax.php",
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
            dateFormat: 'yy-mm-dd',
            duration: 'fast'
        }).focus(function() {
            $(".ui-datepicker-prev, .ui-datepicker-next").remove();
        });
    });
    </script>
</body>

</html>