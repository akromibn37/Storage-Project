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
    function CreateConnection()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "warehouse";

        // Create connection
        $conn = new mysqli($servername, $username, $password,$dbname);
        mysqli_set_charset($conn, "utf8");
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        return $conn;
    }
?>