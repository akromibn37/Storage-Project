<?php
     require_once("../function/container_function.php");    
     if(!isset($_SESSION)) 
     { 
         session_start(); 
     } 
    if($_SESSION['username'] == "" or $_SESSION['password'] == "")
	{
		header("location:../../index.html");
    }
    $isEdit = "false";
    // echo $isEdit;
    if(isset($_GET['action']) and $_GET['action']='edit')
    {
        // echo "comein";
        $isEdit = "true";
        // echo $isEdit;
        $id = $_GET['id'];
        $containers = getContainerById($id);
        if(count($containers)>0)
        {
            $id = $containers[0]["id"];
            $cont_code = $containers[0]["cont_code"];
            $indate = $containers[0]["indate"];
            $price = $containers[0]["price"];
        }
    }
?>
<h2 class="text-center">ข้อมูลตู้คอนเทนเนอร์</h2>
<?php
    if($isEdit=="false")
    {
        echo "<form action='operate/add_container.php' method='POST'>";
    }
    else
    {
        echo "<form action='operate/update_container.php' method='POST'>";
    }
?>

    หมายเลขตู้ : <input type="number" name="container_number" value="<?php $r=" readonly"; echo ($isEdit=="false")?'\"':$id."\" ".$r;?>><br>
    รหัสตู้คอนเทนเนอร์ : <input type="text" name="container_code" value="<?php echo ($isEdit=="false")?'':$cont_code;?>"><br>
    วันเข้า : <input type="date" name="indate" value="<?php echo ($isEdit=="false")?'':$indate;?>"><br>
    ราคา : <input type="number" name="price" value="<?php echo ($isEdit=="false")?'':$price;?>"><br>
    <input type="submit" value="save" name="btn">
</form>
<button onclick="loadoldContent()">Back to Main page</button>
