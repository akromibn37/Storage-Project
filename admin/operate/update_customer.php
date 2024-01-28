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
<?php
    require_once("../function/customer_function.php");
    if(isset($_POST['btn'])){
        $id = $_POST['id'];
        $renter_name = trim($_POST['renter_name']);
        $contact_name = $_POST['contact_name'];
        $contact_surname = trim($_POST['contact_surname']);
        $address = trim($_POST['address']);
        $road = trim($_POST['road']);
        $district = $_POST['district'];
        $subprovince = trim($_POST['subprovince']);
        $province = trim($_POST['province']);
        $postalcode = trim($_POST['postal_code']);
        $tel1 = trim($_POST['tel1']);
        $tel2 = trim($_POST['tel2']);
        $email = trim($_POST['email']);
        // echo "name,con_code,date,price : ".$name.",".$con_code.",".$date.",".$price;
        updateCustomer($id,$renter_name,$contact_name,$contact_surname,$address,$road,$district,$subprovince,$province,$postalcode,$tel1,$tel2,$email);          
    }
    else{
        echo "please press save button";
    }
    echo "<br><a href='../admin.php'>Back to main page.</a>"
?>