<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if($_SESSION['username'] == "" or $_SESSION['password'] == "")
	{
		header("location:../../index.html");
	}
?>
<h2>ข้อมูลลูกค้า</h2>
<?php
    require_once("../function/customer_function.php");
    $id = $_GET['id'];
    $customers = getCustomerbyId($id);
    // print_r($customers);
    if(count($customers)>0)
    {
        $keys = array_keys($customers[0]);
        echo "<table class='table table-bordered table-hover'>";
            echo "<tr>";                
                echo "<th>". "Title" . "</th>";
                echo "<th>". "Detail" . "</th>";
                // echo "<th>". "แก้ไข" . "</th>";
            echo "</tr>";   
            
            for($j=0;$j<count($keys);$j++)
            {
                echo "<tr>";
                    $key = $keys[$j];
                    echo "<td>".$key."</td>";
                    echo "<td>".$customers[0][$key]."</td>";
                echo "</tr>";
            }
            // echo "<td>". "<button onclick='confirm_delete(".$customers[$i]['id'].")'>ลบ</button>" . "</td>";                                       
        echo "</table>";
    }

?>
<button onclick="getContent('customer.php')">back</a>