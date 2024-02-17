<?php
    require_once "../../config/connect.php";
    $id = $_GET['id'];
    $sql = "DELETE FROM course where course_id = $id";
    $query = mysqli_query($dbconnect,$sql);
    mysqli_close($dbconnect);
    header('location:../courses.php');
?>
