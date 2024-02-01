<?php
    //cau hinh ket noi
    $db_localhost="localhost";
    $db_user="root";
    $db_pass="";
    $db_data="course_management";
    $cookie_name = '';
    $cookie_time = (3600 * 24 * 30); // 30 days
    $dbconnect=mysqli_connect($db_localhost,$db_user,$db_pass,$db_data) or die('ket noi khong thanh cong');
    mysqli_query($dbconnect,"set names 'utf8'");
?>
