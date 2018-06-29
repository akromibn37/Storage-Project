<?php
    require_once("admin/function/admin_function.php");
    session_start();
    $check = checkUserpass($_POST['username'],md5($_POST['password']));
    // print_r($check);
    if(count($check)==0)
    {
        header("location:index.html");
        // echo $check;
    }
    else
    {
        $_SESSION['username'] = $check[0]['username'];
        $_SESSION['password'] = $check[0]['password'];
        echo 'session username = '.$_SESSION['username']."<br>";
        echo 'session password = '.$_SESSION['password']."<br>";
        session_write_close();
        header("location:admin/admin.php");
    }
?>