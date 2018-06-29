<?php
    require_once("function/renter_function.php");
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if($_SESSION['username'] == "" or $_SESSION['password'] == "")
	{
		header("location:../index.html");
	}
?>
<h2 class="text-center">สัญญาเช่าทั้งหมด</h2>
<?php
    require_once("function/renter_function.php");
    $renters = getAllrenter();
    // print_r($renters);
    if(count($renters)>0)
    {
        echo "<table class='table table-bordered table-hover text-center'>";
            echo "<tr>";
                $keys = array_keys($renters[0]);
                for($i=0;$i<count($keys);$i++)
                {
                    $key = $keys[$i];
                    // echo $key;
                    echo "<th class='text-center'>$key</th>";
                }
                echo "<th class='text-center'>". "แก้ไข" . "</th>";
                // echo "<th>". "ลบ" . "</th>";
            echo "</tr>";   
            for($i = 0;$i < count($renters);$i++)
            {
                echo "<tr>";
                for($j=0;$j<count($keys);$j++)
                {
                    $key = $keys[$j];
                    if($key=='cust_id')
                    {
                        echo "<td>". "<button onclick = \"getContent('view/customerdata_view.php?&id=".$renters[$i][$key]."')\">".$renters[$i][$key]."</button>" . "</td>";
                    }
                    else if($j!=count($keys)-1)
                    {
                        echo "<td>".$renters[$i][$key]."</td>";
                    }
                    else
                    {
                        echo "<td><a href='".$renters[$i][$key]."'>ดูสัญญา</a></td>";
                    }
                }
                $id = $renters[$i]['id'];
                echo "<td>". "<a onclick = 'return getContent(\"form/rentdata_form.php?action=edit&id=$id\")'>แก้ไข</a>" . "</td>";
                // echo "<td>". "<button onclick='confirm_delete(".$renters[$i]['id'].")'>ลบ</button>" . "</td>";
                echo "</tr>";
            }                             
        echo "</table>";
    }

?>


