<?php
    require_once("function/summary_function.php");
    if(!isset($_SESSION))
    {
        session_start();
    }
    if($_SESSION['username'] == "" or $_SESSION['password'] == "")
	{
		header("location:../index.html");
	}
?>
<h2 class="text-center">สรุปรายงานทั้งหมด</h2>
<ul class="list-unstyled components">
    <p class="text-primary">Summary Menu</p>
    <li>
        <a onclick='return getContent("summary.php?action=edit&id=1")'>Sum of Container</a>
    </li>
    <li>
        <a onclick='return getContent("summary.php?action=edit&id=2")'>Sum of Customer</a>
    </li>
    <li>
        <a onclick='return getContent("summary.php?action=edit&id=3")'>Sum of Month</a>
    </li>
    <!-- <li>
        <a onclick="return getContent('receipt.php')">Receipt</a>
    </li>
    <li>
        <a onclick="return getContent('summary.php')">Summary</a>
    </li> -->
</ul>

<?php
    require_once("function/summary_function.php");

    if(isset($_GET["action"]) and $_GET["action"]='edit')
    {
        $selector = $_GET["id"];
        // echo "selector = ".$selector;
        if($selector==1)
        {
            $summary = getContainersum();
        }
        else if($selector==2)
        {
            $summary = getCustomersum();
        }
        else if($selector==3)
        {
            $summary = getMonthsum();
        }
    }
    else
    {
        $summary = getContainersum();
    }

    if(count($summary)>0)
    {
        echo "<table class='table table-bordered table-hover text-center'>";
            echo "<tr>";
                $keys = array_keys($summary[0]);
                for($i=0;$i<count($keys);$i++)
                {
                    $key = $keys[$i];

                    echo "<th class='text-center'>$key</th>";
                }
            echo "</tr>";
            for($i = 0;$i < count($summary);$i++)
            {
                echo "<tr>";
                for($j=0;$j<count($keys);$j++)
                {
                    $key = $keys[$j];
                    echo "<td>".$summary[$i][$key]."</td>";
                }
                $id = $summary[$i]['id'];
                echo "</tr>";
            }

        echo "</table>";
    }

?>
