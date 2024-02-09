<?php
include_once('../../../config/connect.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_grade_column"])) {
    // Lấy thông tin từ form
    $columnId = $_POST["editColumnId"];
    $columnName = $_POST["editColumnName"];
    $proportion = $_POST["editProportion"];

    // Update the database
    $sql_update_column = "UPDATE grade_column SET grade_column_name = '$columnName', proportion = '$proportion' WHERE column_id = '$columnId'";

    if (mysqli_query($dbconnect, $sql_update_column)) {
        // You can handle success, redirect, or send a response as needed
        echo "Update successful";
    } else {
        // You can handle errors, redirect, or send a response as needed
        echo "Error updating column: " . mysqli_error($dbconnect);
    }
}
?>