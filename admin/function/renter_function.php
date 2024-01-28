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
    function insertNewrenter($cust_id,$cont_id,$indate,$outdate,$file)
    {
        $conn = CreateConnection();

        $sql = "INSERT INTO `rentdata`(`id`, `cust_id`, `cont_id`, `indate`, `outdate`, `document`) 
        VALUES ('', '$cust_id', '$cont_id','$indate','$outdate','$file')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            // header("location:insert_form.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();
    }
    function getAllrenter()
    {
        $conn = CreateConnection();

        $sql = "SELECT * FROM rentdata";
        $result = $conn->query($sql);
        $renters = array();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $renters_row = array("id"=>$row["id"],
                                        "cust_id"=>$row["cust_id"],
                                        "cont_id"=>$row["cont_id"],
                                        "indate"=>$row["indate"],
                                        "outdate"=>$row["outdate"],
                                        "document"=>$row["document"],
                                        );
                array_push($renters,$renters_row);
                // echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["surname"];
            }
        }
        else{
            echo "0 results";
        }
        $conn->close();
        return $renters;
    }
    function getrenterByContId($id)
    {
        $conn = CreateConnection();

        $sql = "SELECT * FROM rentdata WHERE cont_id=$id";
        $result = $conn->query($sql);
        $renters = array();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $renters_row = array("id"=>$row["id"],
                                        "cust_id"=>$row["cust_id"],
                                        "cont_id"=>$row["cont_id"],
                                        "indate"=>$row["indate"],
                                        "outdate"=>$row["outdate"],
                                        "document"=>$row["document"],
                                        );
                array_push($renters,$renters_row);
                // echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["surname"];
            }
        }
        else{
            // echo "0 results";
        }
        $conn->close();
        return $renters;
    }
    function getrenterById($id)
    {
        $conn = CreateConnection();

        $sql = "SELECT * FROM rentdata WHERE id=$id";
        $result = $conn->query($sql);
        $renters = array();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $renters_row = array("id"=>$row["id"],
                                        "cust_id"=>$row["cust_id"],
                                        "cont_id"=>$row["cont_id"],
                                        "indate"=>$row["indate"],
                                        "outdate"=>$row["outdate"],
                                        "document"=>$row["document"],
                                        );
                array_push($renters,$renters_row);
                // echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["surname"];
            }
        }
        else{
            // echo "0 results";
        }
        $conn->close();
        return $renters;
    }
    function updateRenter($id,$cust_id,$cont_id,$indate,$outdate,$document)
    {
        $conn = CreateConnection();

        $sql = "UPDATE `rentdata` SET `cust_id`='$cust_id',`cont_id`='$cont_id',`indate`='$indate',`outdate`='$outdate',`document`='$document' WHERE `id`=$id";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            // header("location:insert_form.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();
    }
?>