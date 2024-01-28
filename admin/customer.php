<?php
    require_once("function/customer_function.php");
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if($_SESSION['username'] == "" or $_SESSION['password'] == "")
	{
		header("location:../index.html");
	}
?>
<h2 class="text-center">รายชื่อลูกค้าทั้งหมด</h2>
<?php    
    $customers = getAllCustomer();
    // print_r($customers);
    if(count($customers)>0)
    {
        echo "<table class='table table-bordered table-hover text-center'>";
            echo "<tr class='text-center'>";
                $keys = array_keys($customers[0]);
                for($i=0;$i<4;$i++)
                {
                    $key = $keys[$i];
                    // echo $key;
                    echo "<th class='text-center'>$key</th>";
                }
                echo "<th class='text-center'>". "โทร" . "</th>";
                echo "<th class='text-center'>". "ข้อมูลเพิ่มเติม" . "</th>";
                echo "<th class='text-center'>". "แก้ไข" . "</th>";
            echo "</tr>";   
            for($i = 0;$i < count($customers);$i++)
            {
                echo "<tr>";
                for($j=0;$j<4;$j++)
                {
                    $key = $keys[$j];
                    echo "<td>".$customers[$i][$key]."</td>";
                }
                echo "<td>".$customers[$i][$keys[10]]."</td>";
                $id = $customers[$i]['id'];
                echo "<td>". "<button onclick = \"getContent('view/customerdata_view.php?&id=$id')\">Click</button>" . "</td>";
                echo "<td>". "<a onclick = 'return getContent(\"form/customerdata_form.php?&action=edit&id=".$id."\")'>แก้ไข</a>" . "</td>";
                // echo "<td>". "<button onclick='confirm_delete(".$customers[$i]['id'].")'>ลบ</button>" . "</td>";
                echo "</tr>";
            }                             
        echo "</table>";
    }

?>
<!-- <button onclick="getContent('addcustomer.php')">เพิ่มตู้</button> -->