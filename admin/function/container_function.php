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
    function insertNewContainer($name,$con_code,$price,$date)
    {
        $conn = CreateConnection();

        $sql = "INSERT INTO container (id,cont_code, indate, price) VALUES ('$name', '$con_code', '$date','$price')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            // header("location:insert_form.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();
    }
    function getAllContainer()
    {
        $conn = CreateConnection();

        $sql = "SELECT * FROM container";
        $result = $conn->query($sql);
        $containers = array();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $containers_row = array("id"=>$row["id"],
                                        "cont_code"=>$row["cont_code"],
                                        "indate"=>$row["indate"],
                                        "price"=>$row["price"],
                                        );
                array_push($containers,$containers_row);
                // echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["surname"];
            }
        }
        else{
            // echo "0 results";
        }
        $conn->close();
        return $containers;
    }
    function getContainerById($id)
    {
        $conn = CreateConnection();

        $sql = "SELECT * FROM container where id = $id";
        $result = $conn->query($sql);
        $containers = array();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $containers_row = array("id"=>$row["id"],
                                        "cont_code"=>$row["cont_code"],
                                        "indate"=>$row["indate"],
                                        "price"=>$row["price"],
                                        );
                array_push($containers,$containers_row);
                // echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["surname"];
            }
        }
        else{
            // echo "0 results";
        }
        $conn->close();
        return $containers;
    }
    function updateContainer($id,$cont_code,$indate,$price)
    {
        $conn = CreateConnection();

        $sql = "UPDATE container SET `cont_code`='$cont_code',price='$price',indate='$indate' WHERE id='$id';";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            // header("location:insert_form.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();
    }

?>