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
    function insertNewCustomer($renter_name,$name,$surname,$address,$road,$district,$subprovince,$province,$postal_code,$tel1,$tel2,$email)
    {
        $conn = CreateConnection();

        $sql = "INSERT INTO customer (id,renter_name, name, surname,address,road,district,subprovince,province,postal_code,tel1,tel2,email) 
        VALUES ('', '$renter_name', '$name','$surname','$address','$road','$district','$subprovince','$province','$postal_code','$tel1','$tel2','$email')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            // header("location:insert_form.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();
    }
    function getAllCustomer()
    {
        $conn = CreateConnection();

        $sql = "SELECT * FROM customer";
        $result = $conn->query($sql);
        $customers = array();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $customers_row = array("id"=>$row["id"],
                                        "renter_name"=>$row["renter_name"],
                                        "name"=>$row["name"],
                                        "surname"=>$row["surname"],
                                        "address"=>$row["address"],
                                        "road"=>$row["road"],
                                        "district"=>$row["district"],
                                        "subprovince"=>$row["subprovince"],
                                        "province"=>$row["province"],
                                        "postal_code"=>$row["postal_code"],
                                        "tel1"=>$row["tel1"],
                                        "tel2"=>$row["tel2"],
                                        "email"=>$row["email"],
                                        );
                array_push($customers,$customers_row);
                // echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["surname"];
            }
        }
        else{
            echo "0 results";
        }
        $conn->close();
        return $customers;
    }
    function getCustomerbyId($id)
    {
        $conn = CreateConnection();

        $sql = "SELECT * FROM customer where id = $id";
        $result = $conn->query($sql);
        $customers = array();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $customers_row = array("id"=>$row["id"],
                                        "renter_name"=>$row["renter_name"],
                                        "name"=>$row["name"],
                                        "surname"=>$row["surname"],
                                        "address"=>$row["address"],
                                        "road"=>$row["road"],
                                        "district"=>$row["district"],
                                        "subprovince"=>$row["subprovince"],
                                        "province"=>$row["province"],
                                        "postal_code"=>$row["postal_code"],
                                        "tel1"=>$row["tel1"],
                                        "tel2"=>$row["tel2"],
                                        "email"=>$row["email"],
                                        );
                array_push($customers,$customers_row);
                // echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["surname"];
            }
        }
        else{
            echo "0 results";
        }
        $conn->close();
        return $customers;
    }
    function updateCustomer($id,$renter_name,$name,$surname,$address,$road,$district,$subprovince,$province,$postal_code,$tel1,$tel2,$email)
    {
        $conn = CreateConnection();

        $sql = "UPDATE `customer` SET `renter_name`='$renter_name',`name`='$name',`surname`='$surname',`address`='$address',`road`='$road',`district`='$district',`subprovince`='$subprovince',`province`='$province',`postal_code`='$postal_code',`tel1`='$tel1',`tel2`='$tel2',`email`='$email' WHERE id='$id';";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            // header("location:insert_form.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();
    }
?>