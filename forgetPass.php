<?php
session_start();
error_reporting(0);

include('class/database.php');
//showProfile() , expenseFunction(), showBudget() will be inside almost all php file. showProfile() will show profile info. expenseFunction() and showBudget() will help the bell notification
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
    public function forgetPass()
    {
        if (isset($_POST['submit'])) {
            $email = addslashes(trim($_POST['email']));
            $phone = addslashes(trim($_POST['phone']));
            $var = addslashes(trim($_POST['dob']));
            $varDate = str_replace('/', '-', $var);
            $dob = date('Y-m-d', strtotime($varDate));
            //This query will help to find the right user inside the database
            $sql = "SELECT * from user_info where email = '$email' AND phone = '$phone' AND DOB = '$dob' ";
            $res = mysqli_query($this->link, $sql);
            if (mysqli_num_rows($res) > 0) {
                $_SESSION['forget'] = $email;
                header('location:forgetReset.php');
                return $res;
            } else {
                return '<div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Wrong Information</strong>
              </div>';
            }
        }
        # code...
    }
}
$obj = new profile;
$objShow = $obj->showProfile();
$objBudget = $obj->showBudget();
$objExpense = $obj->expenseFunction();
$objForgetPass = $obj->forgetPass();
$row = mysqli_fetch_assoc($objShow);
//To find the percentage 
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
                            class="text-secondary font-weight-light">UUWallet</span>
                        <?php echo $row['fname'] ?>
                    </h3>

                    <div class="account bg-white mt-5 p-5 rounded">
                        <h4 class="font-weight-bold" style="color: #05445E">Enter your information to Reset Password
                        </h4>
                        <div id=""><?php echo $objForgetPass; ?></div>
                        <form action="" id="" method="post">
                            <div class="row mt-4">
                                <div class="col-md-7">


                                    <label class="font-weight-bold mt-4" for="email">Enter Email</label>
                                    <input type="email" name="email" id="email" class="bg-light form-control border-0"
                                        required>
                                    <label class="font-weight-bold mt-4" for="phone">Phone Number</label>
                                    <input type="text" name="phone" id="phone" class="bg-light form-control border-0"
                                        required>
                                    <label class="font-weight-bold mt-4" for="">Enter Date of Birth</label>
                                    <input type="text" name="dob" data-toggle="datepicker"
                                        class="bg-light form-control border-0" required>


                                </div>
                                <div class="col-md-5"></div>
                            </div>
                            <input class="btn font-weight-bold log_btn btn-lg mt-5" type="submit" name="submit"
                                value="Submit">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php include('layout/footer.php'); ?>

    <?php include('layout/script.php') ?>
    <script src="js/datepicker.js"></script>
    <script>
    $('[data-toggle="datepicker"]').datepicker({
        autoClose: true,
        viewStart: 2,
        format: 'dd/mm/yyyy',

    });
    </script>

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
    </script>
</body>

</html>