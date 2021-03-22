<?php
include('class/database.php');
class income extends database
{
    protected $link;
    public function incomeFunction()
    {
        $arr = array();
        $sql = "SELECT * FROM expense_tbl UNION SELECT * FROM income_tbl";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_array($res)) {
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