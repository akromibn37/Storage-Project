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
    function checkUserpass($username,$password)
    {
        $conn = CreateConnection();

        $sql = "SELECT * FROM user where username = '$username' and password = '$password';";
        echo $sql;
        $result = $conn->query($sql);
        $userpass = array();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $userpass_row = array("id"=>$row["id"],
                                        "username"=>$row["username"],
                                        "password"=>$row["password"],
                                        );
                array_push($userpass,$userpass_row);
                // echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["surname"];
            }
        }
        else{
            // echo "0 results";
        }
        $conn->close();
        return $userpass;
    }
?>