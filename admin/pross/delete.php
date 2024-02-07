<?php
    require_once "../../config/connect.php";
    $id = $_GET['user_id'];
    $role_delete = $_GET['role_id'];
    $sql = "DELETE FROM user where user_id = $id";
    $query = mysqli_query($dbconnect,$sql);
    mysqli_close($dbconnect);
    if($role_delete == 1){
        header('location: ../student.php');
    }else if($role_delete == 2){
        header('location: ../teacher.php');
    }else if($role_delete == 3){
        header('location: ../admin.php');
    }else{
        echo "Vai trò không tồn tại!";
        exit;
    }
?>
