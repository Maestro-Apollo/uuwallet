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
    public function passwordFunction()
    {
        if (isset($_POST['upload'])) {
            $pass = $_POST['confirm_password'];
            $email = $_SESSION['email'];
            $password = password_hash($pass, PASSWORD_DEFAULT);

            $sql = "UPDATE `user_tbl` SET `password`= '$password' WHERE email = '$email' ";
            $res = mysqli_query($this->link, $sql);
            if ($res) {
                $msg = "Updated";
                return $msg;
            } else {
                $msg = "not update";
                return $msg;
            }
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
$objPass = $obj->passwordFunction();
$row = mysqli_fetch_assoc($objShow);
$objBudget = $obj->showBudget();
$objExpense = $obj->expenseFunction();
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
                    <h3 class="float-left d-block font-weight-bold" style="color: #05445E"><span
                            class="text-secondary font-weight-light">Welcome |</span>
                        <?php echo $row['fname'] ?>
                    </h3>

                    <div class="account bg-white mt-5 p-5 rounded">
                        <h4 class="font-weight-bold" style="color: #05445E">Change Password</h4>
                        <form action="" method="post" data-parsley-validate>
                            <div class="row mt-4">
                                <div class="col-md-7">
                                    <?php if ($objPass) { ?>
                                    <?php if (strcmp($objPass, 'Updated') == 0) { ?>
                                    <div class="alert alert-success alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Password Changed!</strong>
                                    </div>
                                    <?php } ?>
                                    <?php if (strcmp($objPass, 'Updated') == 1) { ?>
                                    <div class="alert alert-warning alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Invalid Information!</strong>
                                    </div>
                                    <?php } ?>

                                    <?php } ?>
                                    <label class="font-weight-bold mt-4" for="new_pass">New Password</label>
                                    <input data-parsley-minlength="6" type="password" id="new_pass" name="new_password"
                                        class="bg-light form-control border-0" required>
                                    <label class="font-weight-bold mt-4" for="confirm_pass">Confirm New Password</label>
                                    <input type="password" id="confirm_pass" name="confirm_password"
                                        data-parsley-equalto="#new_pass" class="bg-light form-control border-0"
                                        required>
                                </div>
                                <div class="col-md-5"></div>
                            </div>
                            <button class="btn font-weight-bold log_btn btn-lg mt-5" type="submit"
                                name="upload">Confirm</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php include('layout/footer.php'); ?>

    <?php include('layout/script.php') ?>
</body>

</html>