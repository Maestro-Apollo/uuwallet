<?php
session_start();
include('class/database.php');
class income extends database
{
    protected $link;
    public function incomeFunction()
    {
        if (isset($_POST['startDate'])) {
            // $start = $_POST['startDate'];
            $varStart = $_POST['startDate'];
            $varDateS = str_replace('/', '-', $varStart);
            $start = date('Y-m-d', strtotime($varDateS));
            $varEnd = $_POST['endDate'];
            $varDateE = str_replace('/', '-', $varEnd);
            $end = date('Y-m-d', strtotime($varDateE));
            // $end = $_POST['endDate'];
        }
        $email = $_SESSION['email'];
        $table = '';
        $table .= '<table id="example" class="table table-hover display" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th>Type of Transaction</th>
                        <th>Category of Transaction</th>
                        <th>Date</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>';
        if (isset($_POST['startDate'])) {
            $sql = "SELECT * FROM expense_tbl where email = '$email' AND expense_date  BETWEEN '$start' AND '$end'  UNION SELECT * FROM income_tbl where email = '$email' AND income_date  BETWEEN '$start' AND '$end' order by expense_date DESC";
        } else {
            $sql = "SELECT * FROM expense_tbl where email = '$email' UNION SELECT * FROM income_tbl where email = '$email' order by expense_date DESC";
        }

        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {

                if (strcmp($row['expense_sign'], '+') == 0) {
                    $table .= '<tr class="text-white bg-success font-weight-bold"><td>';
                    if (strcmp($row['expense_sign'], '+') == 0) {
                        $table .= 'Income';
                    } else {
                        $table .= 'Expense';
                    }
                    $table .= '</td>';
                    $table .= '<td>' . $row['expense_type'] . '</td>';
                    $table .= '<td>' . date('d/m/Y', strtotime(str_replace('-', '/', $row['expense_date'])))  . '</td>';
                    $table .= '<td>' . $row['expense_sign'] . ' £' . $row['expense_amount'] . '</td></tr>';
                } else {
                    $table .= '<tr class="text-white bg-danger font-weight-bold"><td>';
                    if (strcmp($row['expense_sign'], '+') == 0) {
                        $table .= 'Income';
                    } else {
                        $table .= 'Expense';
                    }
                    $table .= '</td>';
                    $table .= '<td>' . $row['expense_type'] . '</td>';
                    $table .= '<td>' . date('d/m/Y', strtotime(str_replace('-', '/', $row['expense_date'])))   . '</td>';
                    $table .= '<td>' . $row['expense_sign'] . ' £' . $row['expense_amount'] . '</td></tr>';
                }
            }
        } else {
            $table .= 'No result found';
        }
        $table .= '</tbody></table>';
        return $table;
    }
}
$obj = new income;
$incomeObj = $obj->incomeFunction();
echo $incomeObj;