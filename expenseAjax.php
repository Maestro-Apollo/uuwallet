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


            $sql = "SELECT * FROM `balance_tbl` where email = '$email' AND MONTH('$date') = MONTH(CURRENT_DATE())
            AND YEAR('$date') = YEAR(CURRENT_DATE())";
            $res = mysqli_query($this->link, $sql);
            if (mysqli_num_rows($res) > 0) {
                // Here all the data will go from expense.php file
                $sql = "INSERT INTO `expense_tbl` (`expense_id`, `expense_date`, `expense_type`, `expense_amount`, `expense_sign`, `email`, `expense_created`) VALUES (NULL, '$date', '$type', '$amount', '-', '$email', CURRENT_TIMESTAMP)";
                $res = mysqli_query($this->link, $sql);
                if ($res) {
                    echo '<div class="alert alert-success">
             <strong>Expense Added!</strong>';
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
                    $amountEx = 0;
                    $amountEx = $amount + $total['totalEx'];

                    $remain = $total['totalIn'] - $amountEx;

                    $sql = "INSERT INTO `expense_tbl` (`expense_id`, `expense_date`, `expense_type`, `expense_amount`, `expense_sign`, `email`, `expense_created`) VALUES (NULL, '$date', '$type', '$amount', '-', '$email', CURRENT_TIMESTAMP)";
                    $res = mysqli_query($this->link, $sql);
                    $sql = "UPDATE `balance_tbl` SET `balance_expense`= '$amountEx', `balance_month` = '$month', `balance_remain`= '$remain' WHERE email = '$email' AND MONTH('$date') = MONTH(balance_date)
                        AND YEAR('$date') = YEAR(balance_date)";
                    $res = mysqli_query($this->link, $sql);
                    if ($res) {
                        echo '<div class="alert alert-success">
         <strong>Expense Month Updated!</strong>';
                    } else {
                        echo 'Not Added';
                    }
                } else {

                    $sql = "INSERT INTO `expense_tbl` (`expense_id`, `expense_date`, `expense_type`, `expense_amount`, `expense_sign`, `email`, `expense_created`) VALUES (NULL, '$date', '$type', '$amount', '-', '$email', CURRENT_TIMESTAMP)";
                    $res = mysqli_query($this->link, $sql);

                    $sql = "INSERT INTO `balance_tbl` (`balance_id`, `balance_date`, `balance_month`, `balance_income`, `balance_expense`, `balance_remain`, `email`, `balance_created`) VALUES (NULL, '$date', '$month', '', '$amount', '', '$email', CURRENT_TIMESTAMP)";
                    $res = mysqli_query($this->link, $sql);

                    if ($res) {
                        echo '<div class="alert alert-success">
         <strong>Expense Month Created and Added!</strong>';
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