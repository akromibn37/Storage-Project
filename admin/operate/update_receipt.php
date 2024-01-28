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
    require_once("../function/receipt_function.php");
    if(isset($_POST['btn'])){
        $id = $_POST['id'];
        $rent_id = $_POST['rent_id'];
        $receipt_type = $_POST['receipt_type'];
        $amount = trim($_POST['amount']);
        $date = trim($_POST['income_date']);
        // $pdf = $_FILES['pdf']['name'];
        $path = "../receipt/".$_FILES['file']['name'];
        if(!($_FILES['file']['size']==0))
        {
            echo $_POST["OldFile"];
            if(@unlink("../".$_POST["OldFile"]))
            {
                if(copy($_FILES["file"]["tmp_name"],"../../receipt/".$_FILES["file"]["name"]))
                {
                    updateReceipt($id,$rent_id,$receipt_type,$amount,$date,$path); 
                }  
            } 
        }   
        else
        {
            updateReceipt($id,$rent_id,$receipt_type,$amount,$date,$_POST["OldFile"]);
        }                    
    }
    else{
        echo "please press search button";
    }
    echo "<br><a href='../admin.php'>Back to main page.</a>"
?>