<?php
    require_once("function/receipt_function.php");
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if($_SESSION['username'] == "" or $_SESSION['password'] == "")
	{
		header("location:../index.html");
	}
?>
<h2 class="text-center">ใบเสร็จรับเงินทั้งหมด</h2>
<?php
    require_once("function/receipt_function.php");
    $receipts = getAllreceipt();
    // print_r($receipts);
    if(count($receipts)>0)
    {
        echo "<table class='table table-bordered table-hover text-center'>";
            echo "<tr>";
                $keys = array_keys($receipts[0]);
                for($i=0;$i<count($keys);$i++)
                {
                    $key = $keys[$i];
                    // echo $key;
                    echo "<th class='text-center'>$key</th>";
                }
                echo "<th class='text-center'>". "แก้ไข" . "</th>";
                // echo "<th>". "ลบ" . "</th>";
            echo "</tr>";   
            for($i = 0;$i < count($receipts);$i++)
            {
                echo "<tr>";
                for($j=0;$j<count($keys);$j++)
                {
                    $key = $keys[$j];
                    if($j==1)
                    {
                        echo "<td><button onclick=\"getContent('view/admin_contract_view.php?&id=".$receipts[$i][$key]."')\">".$receipts[$i][$key]." </button></td>";
                    }
                    else if($j!=count($keys)-1)
                    {
                        echo "<td>".$receipts[$i][$key]."</td>";
                    }
                    else
                    {
                        echo "<td><a href='".$receipts[$i][$key]."'>ดูใบเสร็จ</a></td>";
                    }
                }
                $id = $receipts[$i]['id'];
                echo "<td>". "<a onclick = 'return getContent(\"form/receipt_form.php?action=edit&id=$id\")'>แก้ไข</a>" . "</td>";
                // echo "<td>". "<button onclick='confirm_delete(".$receipts[$i]['id'].")'>ลบ</button>" . "</td>";
                echo "</tr>";
            }                             
        echo "</table>";
    }

?>


