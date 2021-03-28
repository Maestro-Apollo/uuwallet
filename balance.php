<?php
// This isset session check will be on almost every php file to return the user to login if not logged in
session_start();
if (isset($_SESSION['email'])) {
} else {
    header('location:login.php');
}
//Database file in included
include('class/database.php');
class profile extends database
{
    protected $link;
    public function balFunction()
    {
        $arr = array();
        $email = $_SESSION['email'];
        //This sql query will help you find last 3 month and current month balance inside balance_tbl
        $sql = "SELECT balance_remain as remain, balance_month as bal_month from balance_tbl where balance_date > now() - INTERVAL 4 MONTH AND email = '$email' order by balance_date";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            foreach ($res as $row) {
                //All data inside the arr[]
                $arr[] = $row;
            }
            return $arr;
        } else {
            return false;
        }

        # code...
    }
}
//Object and Class process is used in all php files
$obj = new profile; //Object is called here
$objBal = $obj->balFunction(); //Inside profile class balFunction() is called

echo json_encode($objBal);//fetch all the data as json format using json_encode