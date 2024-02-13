<?php
include_once('../../../config/connect.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_grade_column"])) {
    // Sanitize and validate input
    $columnId = mysqli_real_escape_string($dbconnect, $_POST["editColumnId"]);
    $columnName = mysqli_real_escape_string($dbconnect, $_POST["editColumnName"]);
    $proportion = mysqli_real_escape_string($dbconnect, $_POST["editProportion"]);

    // Update the database using prepared statement
    $sql_update_column = "UPDATE grade_column SET grade_column_name = ?, proportion = ? WHERE column_id = ?";
    $stmt = mysqli_prepare($dbconnect, $sql_update_column);

    mysqli_stmt_bind_param($stmt, "ssi", $columnName, $proportion, $columnId);

    if (mysqli_stmt_execute($stmt)) {
        // Success: Redirect to grade_column.php
        mysqli_stmt_close($stmt);
        header("Location: grade_column.php");
        exit();
    } else {
        // Error: Output the error message
        echo "Error updating column: " . mysqli_stmt_error($stmt);
    }

    // Close the statement outside the if-else block
    mysqli_stmt_close($stmt);
}

if (isset($_POST['submit_grade_member'])) {
    // Make sure the necessary data is provided in the POST request
    if (isset($_POST['member_id']) && isset($_POST['score'])) {
        // Sanitize and validate data to prevent SQL injection
        $member_ids = array_map('intval', $_POST['member_id']);
        $scores = array_map('floatval', $_POST['score']);
        $column_id = $_SESSION['column_id'];

        // Loop through the arrays and update the scores in the database
        for ($i = 0; $i < count($member_ids); $i++) {
            $member_id = $member_ids[$i];
            $score = $scores[$i];

            // Update the score in the database (Assuming your database table structure)
            $update_query = "UPDATE grade SET score = $score WHERE member_id = $member_id AND column_id = $column_id";
            mysqli_query($dbconnect, $update_query);
        }

        // You might want to redirect the user after the update
        header("Location: insert_grade_column.php");
        exit();
    } else {
        echo "Không có giá trị";
    }
}

if (isset($_POST['delete_grade_column'])) {
    if (isset($_POST['column_id'])) {
        $column_id = $_POST['column_id'];

        // Assuming you have a valid delete query
        $delete_query = "DELETE FROM grade_column WHERE column_id = $column_id";

        mysqli_query($dbconnect, $delete_query);

        // Redirect the user after the deletion
        header("Location: grade_column.php");
        exit();
    } else {
        echo "Không có giá trị";
    }
}

if (isset($_POST['create_grade_column'])) {
    $column_name = $_POST['columnName'];
    $course_id = $_SESSION['course_id'];
    $proportion = $_POST['proportion'];

    $sql_create = "INSERT INTO grade_column (course_id, grade_column_name, proportion) VALUES ($course_id, '$column_name', $proportion)";
    mysqli_query($dbconnect, $sql_create);
    $last_column_id = $dbconnect->insert_id;

    $sql_member_create = "SELECT * FROM course_member WHERE course_id = $course_id";
    $result_member_create = mysqli_query($dbconnect, $sql_member_create);
    while ($row_member_create = mysqli_fetch_array($result_member_create)) {
        $member_id = $row_member_create['member_id'];
        $sql_add_score = "INSERT INTO grade (column_id, member_id) VALUES ($last_column_id, $member_id)";
        mysqli_query($dbconnect, $sql_add_score);
    }

    header("Location: grade_column.php");
    exit();
}