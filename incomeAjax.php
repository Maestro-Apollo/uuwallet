<?php
include('class/database.php');
class income extends database
{
    protected $link;
    public function incomeFunction()
    {
        if (isset($_POST['date'])) {
            $email = $_POST['email'];
            // $month = $_POST['month'];
            $type = $_POST['type'];
            $date = $_POST['date'];
            $amount = (int)$_POST['amount'];
            $month = date('F, Y', strtotime($date));
            $amount1 = 0;


            $sql = "SELECT * FROM `balance_tbl` where email = '$email' AND MONTH('$date') = MONTH(CURRENT_DATE())
            AND YEAR('$date') = YEAR(CURRENT_DATE())";
            $res = mysqli_query($this->link, $sql);
            if (mysqli_num_rows($res) > 0) {
                // Here all the data will go from expense.php file
                $sql = "INSERT INTO `income_tbl` (`income_id`, `income_date`, `income_type`, `income_amount`, `income_sign`, `email`, `income_created`) VALUES (NULL, '$date', '$type', '$amount', '+', '$email', CURRENT_TIMESTAMP)";
                $res = mysqli_query($this->link, $sql);
                if ($res) {
                    echo '<div class="alert alert-success">
                <strong>Income Added!</strong>';
                } else {
                    echo 'Not Added';
                }
            } else {
                $sql = "SELECT * FROM `balance_tbl` where email = '$email' AND MONTH('$date') = MONTH(balance_date) AND YEAR('$date') = YEAR(balance_date)
                ";
                $res = mysqli_query($this->link, $sql);

                if (mysqli_num_rows($res) > 0) {
                    $sql = "SELECT SUM(balance_expense) as totalEx, SUM(balance_income) as totalIn from balance_tbl where email = '$email' AND MONTH('$date') = MONTH(balance_date)
                        AND YEAR('$date') = YEAR(balance_date)";
                    $res = mysqli_query($this->link, $sql);
                    $total = mysqli_fetch_assoc($res);
                    $amount1 = $amount + $total['totalIn'];
                    if ($total['totalEx'] == 0 && $total['totalIn'] == 0) {
                        $remain = 0;
                    } else {
                        $remain =  $amount1 - $total['totalEx'];
                    }
                    $sql = "INSERT INTO `income_tbl` (`income_id`, `income_date`, `income_type`, `income_amount`, `income_sign`, `email`, `income_created`) VALUES (NULL, '$date', '$type', '$amount', '+', '$email', CURRENT_TIMESTAMP)";
                    $res = mysqli_query($this->link, $sql);
                    $sql = "UPDATE `balance_tbl` SET `balance_income`= '$amount1', `balance_month` = '$month', `balance_remain`= '$remain' WHERE email = '$email' AND MONTH('$date') = MONTH(balance_date)
                        AND YEAR('$date') = YEAR(balance_date)";
                    $res = mysqli_query($this->link, $sql);
                    if ($res) {
                        echo '<div class="alert alert-success">
         <strong>Income Month Updated!</strong>';
                    } else {
                        echo 'Not Added';
                    }
                } else {
                    $sql = "INSERT INTO `income_tbl` (`income_id`, `income_date`, `income_type`, `income_amount`, `income_sign`, `email`, `income_created`) VALUES (NULL, '$date', '$type', '$amount', '+', '$email', CURRENT_TIMESTAMP)";
                    $res = mysqli_query($this->link, $sql);
                    $sql = "INSERT INTO `balance_tbl` (`balance_id`, `balance_date`, `balance_month`, `balance_income`, `balance_expense`, `balance_remain`, `email`, `balance_created`) VALUES (NULL, '$date', '$month', '$amount', '', '', '$email', CURRENT_TIMESTAMP)";
                    $res = mysqli_query($this->link, $sql);
                    if ($res) {
                        echo '<div class="alert alert-success">
         <strong>Income Month Created and Added!</strong>';
                    } else {
                        echo 'Not Added';
                    }
                }
            }
        }
    }
}
$obj = new income;
$incomeObj = $obj->incomeFunction();