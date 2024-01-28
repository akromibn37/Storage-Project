<?php
    require_once("function/container_function.php");
    require_once("function/renter_function.php");
    if(!isset($_SESSION))
    {
        session_start();
    }
    if($_SESSION['username'] == "" or $_SESSION['password'] == "")
	{
		header("location:../index.html");
    }
    function comparetime($outdate)
    {
        $start  = date_create($outdate);
        $end 	= date_create(); // Current time and date
        $diff  	= date_diff( $start, $end );
        return $diff->days;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>RCKStorage Admin Zone</title>

        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="../css/admin.css">
        <!-- Scrollbar Custom CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
        <script src="../js/admin.js"></script>
    </head>
    <body>
        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div id="dismiss">
                    <i class="glyphicon glyphicon-arrow-left"></i>
                </div>

                <div class="sidebar-header">
                    <a href="admin.php"><h3>RCK Selfstorage</h3></a>
                </div>

                <ul class="list-unstyled components">
                    <p class="text-primary">Our Menu</p>
                    <!-- <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Home</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li><a href="#">Home 1</a></li>
                            <li><a href="#">Home 2</a></li>
                            <li><a href="#">Home 3</a></li>
                        </ul>
                    </li> -->
                    <li>
                        <a onclick="return getContent('container.php')">Container data</a>
                        <!-- <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Pages</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li><a href="#">Page 1</a></li>
                            <li><a href="#">Page 2</a></li>
                            <li><a href="#">Page 3</a></li>
                        </ul> -->
                    </li>
                    <li>
                        <a onclick="return getContent('customer.php')">Customer</a>
                    </li>
                    <li>
                        <a onclick="return getContent('contract.php')">Rent Contract</a>
                    </li>
                    <li>
                        <a onclick="return getContent('receipt.php')">Receipt</a>
                    </li>
                    <li>
                        <a onclick="return getContent('summary.php')">Summary</a>
                    </li>
                </ul>
                <ul class="list-unstyled components">
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
                </ul>
            </nav>

            <!-- Page Content Holder -->
            <div id="content">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                                <i class="glyphicon glyphicon-align-left"></i>
                                <span>Open Menu</span>
                            </button>
                        </div>
                    </div>
                </nav>
                <div id="page">
                    <h2 class="text-center">ตู้คอนเทนเนอร์และภาพรวมทั้งหมด</h2>
                    <?php
                        $container = getAllContainer();
                        if(count($container)>0)
                        {
                            echo "<table class='table table-bordered table-hover text-center'>";
                                echo "<tr class='text-center'>";
                                    echo "<th class='text-center'>Cont_id</th>";
                                    echo "<th class='text-center'>Status</th>";
                                    echo "<th class='text-center'>Indate</th>";
                                    echo "<th class='text-center'>Outdate</th>";
                                    echo "<th class='text-center'>Remaining time(days)</th>";
                                    echo "<th class='text-center'>Rent_Id</th>";
                                echo "</tr>";

                                for($i = 0;$i < count($container);$i++)
                                {
                                    $renter = getrenterByContId($container[$i]['id']);
                                    $k=-1;
                                    if(count($renter)>0)
                                    {
                                        for($j=0;$j < count($renter);$j++)
                                        {
                                            // echo time()-(60*60*24)."<br>";
                                            // echo strtotime($renter[$j]['outdate'])."<br>";
                                            if(time() < strtotime($renter[$j]['outdate']))
                                            {
                                                $k=$j;
                                                // echo $k;
                                                break;
                                            }
                                        }
                                    }
                                    if($k!=-1)
                                    {
                                        $remaintime = comparetime($renter[$k]['outdate']);
                                        echo "<tr>";
                                            echo "<td>".$container[$i]['id']."</td>";
                                            echo "<td class='bg-success'>Occupied</td>";
                                            echo "<td>".$renter[$k]['indate']."</td>";
                                            echo "<td>".$renter[$k]['outdate']."</td>";
                                            echo $remaintime<=14?"<td class='bg-warning'>":"<td>";
                                            echo $remaintime."</td>";
                                            echo "<td><button onclick=\"getContent('view/admin_contract_view.php?&id=".$renter[$k]['id']."')\">".$renter[$k]['id']." </button></td>";
                                        echo "</tr>";
                                    }
                                    else
                                    {
                                        echo "<tr>";
                                            echo "<td>".$container[$i]['id']."</td>";
                                            echo "<td class='bg-danger'>Idle</td>";
                                            echo "<td>-</td>";
                                            echo "<td>-</td>";
                                            echo "<td>-</td>";
                                            echo "<td>-</td>";
                                        echo "</tr>";
                                    }
                                }
                            echo "</table>";
                        }
                    ?>
                    <button onclick="getContent('form/customerdata_form.php')">เพิ่มลูกค้า</button>
                    <button onclick="getContent('form/rentdata_form.php')">เพิ่มผู้เช่า</button> <!-- rentdata.php-->
                    <button onclick="getContent('form/receipt_form.php')">เพิ่มใบเสร็จรับเงิน</button>
                </div>
            </div>
        </div>



        <div class="overlay"></div>


        <!-- jQuery CDN -->
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <!-- Bootstrap Js CDN -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- jQuery Custom Scroller CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

        <script type="text/javascript">
            const original = document.getElementById("page").innerHTML
            $(document).ready(function () {
                $("#sidebar").mCustomScrollbar({
                    theme: "minimal"
                });

                $('#dismiss, .overlay').on('click', function () {
                    $('#sidebar').removeClass('active');
                    $('.overlay').fadeOut();
                });

                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar').addClass('active');
                    $('.overlay').fadeIn();
                    $('.collapse.in').toggleClass('in');
                    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                });
            });
        </script>
    </body>
</html>
