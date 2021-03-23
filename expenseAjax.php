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

            $sql = "INSERT INTO `expense_tbl` (`expense_id`, `expense_date`, `expense_type`, `expense_amount`, `expense_sign`, `email`, `expense_created`) VALUES (NULL, '$date', '$type', '$amount', '-', '$email', CURRENT_TIMESTAMP)";
            $res = mysqli_query($this->link, $sql);
            if ($res) {
                echo '<div class="alert alert-success">
                <strong>Expense Added!</strong>';
            } else {
                echo 'Not Added';
            }
        }
    }
}
$obj = new income;
$incomeObj = $obj->incomeFunction();