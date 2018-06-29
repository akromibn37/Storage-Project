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
<h2>ข้อมูลสัญญา</h2>
<?php
    require_once("../function/renter_function.php");
    require_once("../function/customer_function.php");
    $id = $_GET['id'];
    $renter = getrenterById($id);
    $rentername = getCustomerbyId($renter[0]['cust_id']);
    // print_r($renter);
    if(count($renter)>0)
    {
        $keys = array_keys($renter[0]);
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
                    if($key=='cust_id')
                    {
                            echo "<td>cust_id</td>";
                            echo "<td>".$rentername[0]['id']."</td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td>rentername</td>";
                            echo "<td>".$rentername[0]['renter_name']."</td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td>tel</td>";
                            echo "<td>".$rentername[0]['tel1']."</td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td>email</td>";
                            echo "<td>".$rentername[0]['email']."</td>";
                    }
                    else if($key=='document')
                    {
                        echo "<td>".$key."</td>";
                        echo "<td><a href='".$renter[0][$key]."'>ดูสัญญา</a></td>";
                    }
                    else
                    {
                        echo "<td>".$key."</td>";
                        echo "<td>".$renter[0][$key]."</td>";
                    }
                echo "</tr>";
            }
            // echo "<td>". "<button onclick='confirm_delete(".$renter[$i]['id'].")'>ลบ</button>" . "</td>";                                       
        echo "</table>";
    }

?>
<button onclick="loadoldContent()">back</a>