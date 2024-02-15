<?php
    require_once "../../config/connect.php";
    $id = $_GET['id'];
    $sql = "UPDATE course SET status='A' where course_id = $id";
    $query = mysqli_query($dbconnect,$sql);
    mysqli_close($dbconnect);
    header('location:../courses.php');
?>
