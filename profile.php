<?php
session_start();
error_reporting(0);
include('class/database.php');

if (isset($_SESSION['email'])) {
} else {
    header('location:login.php');
}
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

    public function showProfileInfo()
    {
        $email = $_SESSION['email'];
        $sql = "select * from user_info where email = '$email' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function insertProfileInfo()
    {
        if (isset($_POST['upload'])) {
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $city = $_POST['city'];
            $country = $_POST['country'];
            $img = time() . '_' . $_FILES['image']['name'];
            $target = 'user_img/' . $img;

            if ($_FILES['image']['name'] == '') {
                $sql = "UPDATE `user_info` SET `phone`= '$phone',`country`='$country',`city`='$city', `updated` = CURRENT_TIMESTAMP WHERE email = '$email'";
            } else {
                $sql = "UPDATE `user_info` SET `phone`= '$phone',`country`='$country',`city`='$city', `image` = '$img', `updated` = CURRENT_TIMESTAMP WHERE email = '$email'";
            }


            $res = mysqli_query($this->link, $sql);
            if ($res) {
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
                header('location:profile.php');
                return $res;
            } else {
                echo "Not added";
                return false;
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
$objShowInfo = $obj->showProfileInfo();
$objInsertInfo = $obj->insertProfileInfo();
$row = mysqli_fetch_assoc($objShow);
$rowInfo = mysqli_fetch_assoc($objShowInfo);
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
    .profileImage {
        height: 200px;
        width: 200px;
        object-fit: cover;
        border-radius: 50%;
        margin: 10px auto;
        cursor: pointer;

    }



    .upload_btn {
        background-color: #EEA11D;
        color: #05445E;
        transition: 0.7s;
    }

    .upload_btn:hover {
        background-color: #05445E;
        color: #EEA11D;
    }

    .navbar-brand {
        width: 7%;
    }

    .bg_color {
        background-color: #fff !important;
    }

    .gap {
        margin-bottom: 95px;
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
                        <div id="output"></div>

                        <h3 class="font-weight-bold mb-5" style="color: #05445E">Account Details</h3>
                        <form action="" id="myForm" enctype="multipart/form-data">
                            <div class="row mt-4">
                                <div class="col-md-5 text-center">

                                    <img class="profileImage" onclick="triggerClick()" id="profileDisplay"
                                        src="user_img/<?php echo $rowInfo['image']; ?>" alt="">
                                    <input type="file" accept="image/*" name="image" id="profileImage"
                                        onchange="displayImage(this)" style="display: none;">
                                    <p class="lead gap">Tap to upload image</p>
                                    <input class="btn font-weight-bold log_btn btn-lg mt-5" type="submit"
                                        value="Confirm Changes">
                                </div>
                                <div class="col-md-7">
                                    <label for="fullname" class="font-weight-bold">Full Name</label>
                                    <input type="text" id="fullname" name="fullname"
                                        value="<?php echo $row['fname']; ?> <?php echo $row['lname']; ?>"
                                        class="form-control border-0 bg-light" readonly>
                                    <label for="email" class="font-weight-bold mt-4">Email</label>
                                    <input type="email" id="email" value="<?php echo $row['email']; ?>" name="email"
                                        class="form-control border-0 bg-light" readonly>
                                    <label for="phone" class="font-weight-bold mt-4">Phone Number</label>
                                    <input type="text" id="phone" value="<?php echo $rowInfo['phone']; ?>" name="phone"
                                        class="form-control border-0 bg-light">
                                    <label for="country" class="font-weight-bold mt-4">Country</label>
                                    <input type="text" id="country" value="<?php echo $rowInfo['country']; ?>"
                                        name="country" class="form-control border-0 bg-light">
                                    <label for="city" class="font-weight-bold mt-4">City</label>
                                    <input type="text" id="city" value="<?php echo $rowInfo['city']; ?>" name="city"
                                        class="form-control border-0 bg-light">




                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <?php include('layout/footer.php'); ?>

    <?php include('layout/script.php') ?>
    <script>
    $(document).ready(function() {
        $('#myForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "update.php",
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