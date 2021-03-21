<?php
session_start();
include('class/database.php');
class income extends database
{
    protected $link;
    public function incomeFunction()
    {
        $arr = array();
        $email = $_SESSION['email'];

        // $month1 = 0;
        // $dt = (int)date("m");
        // $sql = "SELECT *  from expense_tbl where email = '$email' ";
        // $res = mysqli_query($this->link, $sql);
        // if ($res) {
        //     while ($row = mysqli_fetch_assoc($res)) {
        //         $date = $row['expense_date'];
        //         $ts1 = strtotime($date);
        //         $month1 = (int)date('m', $ts1);
        //         if ($dt == $month1) {
        //         }
        //     }
        // }

        $sql = "SELECT income_type, SUM(income_amount) as amount FROM `income_tbl` where email = '$email' AND MONTH(income_date) = MONTH(CURRENT_DATE())
        AND YEAR(income_date) = YEAR(CURRENT_DATE()) GROUP BY income_type";
        $res = mysqli_query($this->link, $sql);
        if ($res) {
            foreach ($res as $row) {
                $arr[] = $row;
            }
            return $arr;
        } else {
            return false;
        }
    }
}
$obj = new income;
$incomeObj = $obj->incomeFunction();
echo json_encode($incomeObj);