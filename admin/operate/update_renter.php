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
    require_once("../function/renter_function.php");
    if(isset($_POST['btn'])){
        $id = $_POST['id'];
        $cust_id = $_POST['cust_id'];
        $container_number = $_POST['container_number'];
        $indate = trim($_POST['indate']);
        $outdate = trim($_POST['outdate']);

        // $pdf = $_FILES['pdf']['name'];
        $path = "../contract/".$_FILES['file']['name'];
        if(!($_FILES['file']['size']==0))
        {
            echo $_POST["OldFile"];
            if(@unlink("../".$_POST["OldFile"]))
            {
                if(copy($_FILES["file"]["tmp_name"],"../../contract/".$_FILES["file"]["name"]))
                {
                    updateRenter($id,$cust_id,$container_number,$indate,$outdate,$path); 
                }  
            } 
        }   
        else
        {
            updateRenter($id,$cust_id,$container_number,$indate,$outdate,$_POST["OldFile"]);
        }         
    }
    else{
        echo "please press search button";
    }
    echo "<br><a href='../admin.php'>Back to main page.</a>"
?>
