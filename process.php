<?php
session_start();
include_once('config/connect.php');
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sbm"])) {
    $name = $_SESSION['fullName'];
    $image = $_SESSION['portrait'];
    $birth = $_SESSION['dob'];
    $gender = $_SESSION['gender'];
    $address = $_SESSION['address'];
    $phone = $_SESSION['phoneNumber'];
    $email = $_SESSION['email'];
    $citizen_id = $_SESSION['idCard'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    unset($_SESSION['fullName']);
    unset($_SESSION['portrait']);
    unset($_SESSION['dob']);
    unset($_SESSION['gender']);
    unset($_SESSION['phoneNumber']);
    unset($_SESSION['email']);
    unset($_SESSION['address']);
    unset($_SESSION['idCard']);
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    $sql = "INSERT INTO user (full_name, date_of_birth,gender,address,phone,email,citizen_id,image) VALUES ('$name','$birth','$gender','$address','$phone','$email','$citizen_id','$image')";
    $query = mysqli_query($dbconnect, $sql);
    if (!$query) {
        echo "Lỗi khi chèn dữ liệu vào bảng user: " . mysqli_error($dbconnect);
    }
    $user_id = mysqli_insert_id($dbconnect);
    $sql_us = "INSERT INTO user_account(account_id, username, password, user_id) VALUES ('$user_id','$username','$password','$user_id')";
    $query_us = mysqli_query($dbconnect, $sql_us);
    if (!$query_us) {
        echo "Lỗi khi chèn dữ liệu vào bảng user_account: " . mysqli_error($dbconnect);
    }
    if ($_SESSION['role'] == "student") {
        $sql_role = "INSERT INTO user_role (user_id,role_id) VALUES ('$user_id','1')";
        $query_role = mysqli_query($dbconnect, $sql_role);
    }else if ($_SESSION['role'] == "teacher"){
        $sql_role = "INSERT INTO user_role (user_id,role_id) VALUES ('$user_id','2')";
        $query_role = mysqli_query($dbconnect, $sql_role);
    }else if ($_SESSION['role']=="both"){
        $sql_role_1 = "INSERT INTO user_role (user_id,role_id) VALUES ('$user_id','1')";
        $query_role = mysqli_query($dbconnect, $sql_role_1);
        $sql_role_2 = "INSERT INTO user_role (user_id,role_id) VALUES ('$user_id','2')";
        $query_role = mysqli_query($dbconnect, $sql_role_2);
    }else{
        echo "Lỗi role không tồn tại: " . mysqli_error($dbconnect);
    }


}
mysqli_close($dbconnect);
?>
