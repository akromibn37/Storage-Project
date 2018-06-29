<?php
    require_once("../function/renter_function.php");    
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
        $renters = getrenterById($id);
        if(count($renters)>0)
        {
            $id = $renters[0]["id"];
            $cust_id = $renters[0]["cust_id"];
            $cont_id = $renters[0]["cont_id"];
            $indate = $renters[0]["indate"];
            $outdate = $renters[0]["outdate"];
            $document = $renters[0]["document"];
        }
    }
?>
<h2 class="text-center">ข้อมูลผู้เช่า</h2>
<?php
    if($isEdit=="false")
    {
        echo "<form action='operate/add_renter.php' enctype='multipart/form-data' method='POST'>";
    }
    else
    {
        echo "<form action='operate/update_renter.php' enctype='multipart/form-data' method='POST'>";
        echo "<input type='hidden' name='id' value='$id;' >";
    }
?>
    หมายเลขตู้ที่เช่า : <input type="number" name="container_number" value="<?php echo ($isEdit=="false")?'':$cont_id;?>"><br>
    รหัสลูกค้า : <input type="number" name="cust_id" value="<?php echo ($isEdit=="false")?'':$cust_id;?>"><br>
    วันที่เข้า : <input type="date" name="indate" value="<?php echo ($isEdit=="false")?'':$indate;?>"><br>
    วันที่ออก : <input type="date" name="outdate" value="<?php echo ($isEdit=="false")?'':$outdate;?>"><br>
    ไฟล์สัญญาใหม่ : <input name="file" id="file" type="file" accept=”application/pdf” value="<?php echo ($isEdit=="false")?'':$document;?>"><br>
<?php
    if($isEdit=="true")
    {
        echo "ไฟล์สัญญาเก่า : <input name='OldFile' type='text' accept='application/pdf' value=\"".$document."\" readonly><br>";
    }
?>
    <input type="submit" value="save" name="btn">
</form>
<button onclick="loadoldContent()">Back to Main page</button>

