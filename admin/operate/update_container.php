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
    require_once("../function/container_function.php");
    if(isset($_POST['btn'])){
        $name = $_POST['container_number'];
        $con_code = trim($_POST['container_code']);
        $date = trim($_POST['indate']);
        $price = trim($_POST['price']);
        // echo "name,con_code,date,price : ".$name.",".$con_code.",".$date.",".$price;
        updateContainer($name,$con_code,$date,$price);          
    }
    else{
        echo "please press search button";
    }
    echo "<br><a href='../admin.php'>Back to main page.</a>"
?>