<?php
    $start  = date_create('2018-05-1');
    $end 	= date_create(); // Current time and date
    $diff  	= date_diff( $start, $end );

    echo "The difference is ". $diff->days;

?>