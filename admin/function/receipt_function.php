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
    require_once("dbfunction.php");
    function insertNewreceipt($rent_id,$type,$amount,$date,$file)
    {
        $conn = CreateConnection();

        $sql = "INSERT INTO `receipt`(`id`, `rent_id`, `type`, `amount`, `date`, `document`) 
        VALUES ('', '$rent_id', '$type','$amount','$date','$file')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            // header("location:insert_form.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();
    }
    function getAllreceipt()
    {
        $conn = CreateConnection();

        $sql = "SELECT * FROM receipt";
        $result = $conn->query($sql);
        $receipts = array();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $receipts_row = array("id"=>$row["id"],
                                        "rent_id"=>$row["rent_id"],
                                        "type"=>$row["type"],
                                        "amount"=>$row["amount"],
                                        "date"=>$row["date"],
                                        "document"=>$row["document"],
                                        );
                array_push($receipts,$receipts_row);
                // echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["surname"];
            }
        }
        else{
            // echo "0 results";
        }
        $conn->close();
        return $receipts;
    }
    function getreceiptById($id)
    {
        $conn = CreateConnection();

        $sql = "SELECT * FROM receipt WHERE id=$id";
        $result = $conn->query($sql);
        $receipts = array();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $receipts_row = array("id"=>$row["id"],
                                        "rent_id"=>$row["rent_id"],
                                        "type"=>$row["type"],
                                        "amount"=>$row["amount"],
                                        "date"=>$row["date"],
                                        "document"=>$row["document"],
                                        );
                array_push($receipts,$receipts_row);
                // echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["surname"];
            }
        }
        else{
            // echo "0 results";
        }
        $conn->close();
        return $receipts;
    }
    function updateReceipt($id,$rent_id,$type,$amount,$date,$document)
    {
        $conn = CreateConnection();

        $sql = "UPDATE `receipt` SET `rent_id`='$rent_id',`type`='$type',`amount`='$amount',`date`='$date',`document`='$document' WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            // header("location:insert_form.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();
    }
?>