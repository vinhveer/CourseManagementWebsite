<?php
//cau hinh ket noi
$db_localhost = "localhost";
$db_user = "root";
$db_pass = "@Cancot123";
$db_data = "course_management";
$cookie_name = 'abc';
$cookie_time = (3600 * 24 * 30); // 30 days
$dbconnect = mysqli_connect($db_localhost, $db_user, $db_pass, $db_data);
if ($dbconnect) {
    mysqli_query($dbconnect, "SET NAMES 'utf8'");
} else {
    echo "Kết nối thất bại";
}
