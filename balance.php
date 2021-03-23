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
    public function balFunction()
    {
        $arr = array();
        $email = $_SESSION['email'];
        $sql = "SELECT balance_remain as remain, balance_month as bal_month from balance_tbl where balance_date > now() - INTERVAL 4 MONTH AND email = '$email' order by balance_date";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            foreach ($res as $row) {
                $arr[] = $row;
            }
            return $arr;
        } else {
            return false;
        }

        # code...
    }
}
$obj = new profile;
$objBal = $obj->balFunction();
echo json_encode($objBal);