<?php
    require_once("../function/customer_function.php");    
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
        $customers = getCustomerbyId($id);
        if(count($customers)>0)
        {
            $renter_name = $customers[0]["renter_name"];
            $contact_name = $customers[0]["name"];
            $contact_surname = $customers[0]["surname"];
            $address = $customers[0]["address"];
            $road = $customers[0]["road"];
            $district = $customers[0]["district"];
            $subprovince = $customers[0]["subprovince"];
            $province = $customers[0]["province"];
            $postalcode = $customers[0]["postal_code"];
            $tel1 = $customers[0]["tel1"];
            $tel2 = $customers[0]["tel2"];
            $email = $customers[0]["email"];
        }
    }
?>
<h2 class="text-center">ข้อมูลผู้เช่า</h2>
<?php
    if($isEdit=="false")
    {
        echo "<form action='operate/add_customer.php' method='POST'>";
    }
    else
    {
        echo "<form action='operate/update_customer.php' method='POST'>";
    }
?>
<?php
    if($isEdit=="true")
    {
        echo "<input type='hidden' name='id' value='$id;' >";
    }
?>
    ชื่อผู้เช่า : <input type="text" name="renter_name" value="<?php echo ($isEdit=="false")?'':$renter_name;?>"><br>
    ชื่อ(ผู้ติดต่อ) : <input type="text" name="contact_name" value="<?php echo ($isEdit=="false")?'':$contact_name;?>"><br>
    สกุล(ผู้ติดต่อ) : <input type="text" name="contact_surname" value="<?php echo ($isEdit=="false")?'':$contact_surname;?>"><br>
    ที่อยู่ : <input type="text" name="address" value="<?php echo ($isEdit=="false")?'':$address;?>"><br>
    ถนน : <input type="text" name="road" value="<?php echo ($isEdit=="false")?'':$road;?>"><br>
    ตำบล : <input type="text" name="district" value="<?php echo ($isEdit=="false")?'':$district;?>"><br>
    อำเภอ : <input type="text" name="subprovince" value="<?php echo ($isEdit=="false")?'':$subprovince;?>"><br>
    จังหวัด : <input type="text" name="province" value="<?php echo ($isEdit=="false")?'':$province;?>"><br>
    รหัสไปรษณีย์ : <input type="text" name="postal_code" value="<?php echo ($isEdit=="false")?'':$postalcode;?>"><br>
    โทร1 : <input type="text" name="tel1" value="<?php echo ($isEdit=="false")?'':$tel1;?>"><br>
    โทร2 : <input type="text" name="tel2" value="<?php echo ($isEdit=="false")?'':$tel2;?>"><br>
    อีเมล : <input type="text" name="email" value="<?php echo ($isEdit=="false")?'':$email;?>"><br>
    <input type="submit" value="save" name="btn">
</form>
<button onclick="loadoldContent()">Back to Main page</button>