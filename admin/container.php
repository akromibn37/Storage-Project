<?php
    require_once("function/container_function.php");
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if($_SESSION['username'] == "" or $_SESSION['password'] == "")
	{
		header("location:../index.html");
	}
?>
<h2 class='text-center'>ตู้คอนเทนเนอร์ทั้งหมด</h2>
<?php
    $containers = getAllContainer();
    // print_r($containers);
    if(count($containers)>0)
    {
        echo "<table class='table table-bordered table-hover text-center'>";
            echo "<tr>";
                $keys = array_keys($containers[0]);
                for($i=0;$i<count($keys);$i++)
                {
                    $key = $keys[$i];
                    // echo $key;
                    echo "<th class='text-center'>$key</th>";
                }
                echo "<th class='text-center'>". "แก้ไข" . "</th>";
                // echo "<th>". "ลบ" . "</th>";
            echo "</tr>";   
            for($i = 0;$i < count($containers);$i++)
            {
                echo "<tr>";
                for($j=0;$j<count($keys);$j++)
                {
                    $key = $keys[$j];
                    echo "<td>".$containers[$i][$key]."</td>";
                }
                $id = $containers[$i]['id'];
                echo "<td>". "<a onclick = 'return getContent(\"form/addcontainer_form.php?&action=edit&id=".$id."\")'>แก้ไข</a>" . "</td>";
                // echo "<td>". "<button onclick='confirm_delete(".$containers[$i]['id'].")'>ลบ</button>" . "</td>";
                echo "</tr>";
            }                             
        echo "</table>";
    }

?>
<button onclick="getContent('form/addcontainer_form.php')">เพิ่มตู้</button>

