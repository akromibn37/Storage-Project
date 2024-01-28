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

    function getContainersum()
    {
        $conn = CreateConnection();

        $sql = "SELECT r.cont_id as cont_id,count(r.id) as count_contract,sum(re.amount) as amount,c.price as price,(sum(re.amount)/c.price) as return_ratio from rentdata r
                join receipt re on r.id = re.rent_id
                join container c on r.cont_id = c.id
                group by r.cont_id
                order by cont_id;";
        // echo $sql;
        $result = $conn->query($sql);
        $summary = array();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $summary_row = array("cont_id"=>$row["cont_id"],
                                        "count_contract"=>$row["count_contract"],
                                        "amount"=>$row["amount"],
                                        "price"=>$row["price"],
                                        "return_ratio"=>$row["return_ratio"],
                                        );
                array_push($summary,$summary_row);
                // echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["surname"];
            }
        }
        else{
            echo "0 results";
        }
        $conn->close();
        return $summary;
    }
    function getCustomersum()
    {
        $conn = CreateConnection();

        $sql = "SELECT r.cust_id as cust_id,c.renter_name as renter_name,r.cont_id as cont_id,count(distinct(r.id)) as count_contract,sum(re.amount) as amount from rentdata r
                join receipt re on r.id = re.rent_id
                join customer c on r.cust_id = c.id
                group by r.cust_id
                order by amount desc;";
        $result = $conn->query($sql);
        $summary = array();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $summary_row = array("cust_id"=>$row["cust_id"],
                                        "renter_name"=>$row["renter_name"],
                                        "cont_id"=>$row["cont_id"],
                                        "count_contract"=>$row["count_contract"],
                                        "amount"=>$row["amount"],
                                        );
                array_push($summary,$summary_row);
                // echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["surname"];
            }
        }
        else{
            echo "0 results";
        }
        $conn->close();
        return $summary;
    }
    function getMonthsum()
    {
        $conn = CreateConnection();

        $sql = "SELECT month(re.date) as month,year(re.date) as year,count(distinct(re.rent_id)) as contract_count,sum(re.amount) as amount FROM receipt re
                group by month,year order by year,month;";
        $result = $conn->query($sql);
        $summary = array();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $summary_row = array("month"=>$row["month"],
                                        "year"=>$row["year"],
                                        "contract_count"=>$row["contract_count"],
                                        "amount"=>$row["amount"],
                                        );
                array_push($summary,$summary_row);
                // echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["surname"];
            }
        }
        else{
            echo "0 results";
        }
        $conn->close();
        return $summary;
    }

?>
