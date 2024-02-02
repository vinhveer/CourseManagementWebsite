<?php
    session_start();
    if(isset($_SESSION['mySession'])){
        unset($_SESSION['mySession']);
    }
    setcookie("abc", "", time() -3600);
        header('location: login.php');
?>
