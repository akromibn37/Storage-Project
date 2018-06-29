<?php
    require_once("../function/receipt_function.php");
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
        $receipts = getreceiptById($id);
        if(count($receipts)>0)
        {
            $id = $receipts[0]["id"];
            $rent_id = $receipts[0]["rent_id"];
            $type = $receipts[0]["type"];
            $amount = $receipts[0]["amount"];
            $date = $receipts[0]["date"];
            $document = $receipts[0]["document"];
        }
    }
?>
<h2 class="text-center">ข้อมูลผู้เช่า</h2>
<?php
    if($isEdit=="false")
    {
        echo "<form action='operate/add_receipt.php' enctype='multipart/form-data' method='POST'>";
    }
    else
    {
        echo "<form action='operate/update_receipt.php' enctype='multipart/form-data' method='POST'>";
        echo "<input type='hidden' name='id' value='$id;' >";
    }
?>
    เลขที่สัญญา : <input type="number" name="rent_id" value="<?php echo ($isEdit=="false")?'':$rent_id;?>"><br><br>
    ประเภทของใบเสร็จ : <select name="receipt_type">
                        <option value=<?php echo ($isEdit=="true" and $type=="rentfee")?'rentfee'.' selected':'rentfee';?>>ค่าเช่า</option>
                        <option value=<?php echo ($isEdit=="true" and $type=="assurefee")?'assurefee'.' selected':'assurefee';?>>เงินประกัน</option>
                        <option value=<?php echo ($isEdit=="true" and $type=="all")?'all'.' selected':'all';?>>รวมทั้งสอง</option>
                    </select><br><br>
    จำนวนเงิน : <input type="number" name="amount" value="<?php echo ($isEdit=="false")?'':$amount;?>"><br>
    วันที่รับเงิน : <input type="date" name="income_date" value="<?php echo ($isEdit=="false")?'':$date;?>"><br>
    ไฟล์สัญญา : <input name="file" id="file" type="file" accept=”application/pdf”><br>
<?php
    if($isEdit=="true")
    {
        echo "ไฟล์สัญญาเก่า : <input name='OldFile' type='text' accept='application/pdf' value=\"".$document."\" readonly><br>";
    }
?>
    <input type="submit" value="save" name="btn">
</form>
<button onclick="loadoldContent()">Back to Main page</button>