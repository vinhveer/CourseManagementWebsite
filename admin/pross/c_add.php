<?php
include_once('../../config/connect.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_schedule"])) {
    $course_name = $_SESSION["course_name"];
    $course_code = $_SESSION["course_code"];
    $course_description = $_SESSION["course_description"];
    $start_date = $_SESSION["start_date"];
    $end_date = $_SESSION["end_date"];
    $teacher_id = $_SESSION['teacher_course'];
    $fileName = $_SESSION['course_image'];
    unset( $_SESSION["course_name"]);
    unset($_SESSION["course_code"]);
    unset($_SESSION["course_description"]);
    unset($_SESSION["start_date"]);
    unset($_SESSION["end_date"]);
    unset($_SESSION['teacher_course']);
    unset($_SESSION['course_image']);
    $sql_create_course = "INSERT INTO course (course_background, course_code, course_name,teacher_id ,course_description, start_date, end_date, status)
    VALUES ('$fileName', '$course_code', '$course_name', '$teacher_id', '$course_description', '$start_date', '$end_date', 'A')";
    if (mysqli_query($dbconnect, $sql_create_course)) {
        $sql_course_id = "SELECT course_id FROM course WHERE course_code = '$course_code'";
        $result_course_id = mysqli_query($dbconnect, $sql_course_id);
        $row_course_id = mysqli_fetch_assoc($result_course_id);
        $_SESSION['course_id_add'] = $row_course_id['course_id'];
    } else {
        die("Something went wrong. Error: " . mysqli_error($dbconnect));
    }
    // Lấy thông tin từ form
    $dayOfWeeks = $_POST["dayOfWeek"];
    $startTimes = $_POST["startTime"];
    $endTimes = $_POST["endTime"];

    // Kiểm tra xem có dữ liệu được gửi hay không
    if (!empty($dayOfWeeks) && !empty($startTimes) && !empty($endTimes)) {
        // Lặp qua từng hàng và hiển thị thông tin
        for ($i = 0; $i < count($dayOfWeeks); $i++) {
            switch ($dayOfWeeks[$i]) {
                case "monday":
                    $dayOfWeek = "2";
                    break;
                case "tuesday":
                    $dayOfWeek = "3";
                    break;
                case "wednesday":
                    $dayOfWeek = "4";
                    break;
                case "thursday":
                    $dayOfWeek = "5";
                    break;
                case "friday":
                    $dayOfWeek = "6";
                    break;
                case "saturday":
                    $dayOfWeek = "7";
                    break;
                case "sunday":
                    $dayOfWeek = "C";
                    break;
            }
            $startTime = $startTimes[$i];
            $endTime = $endTimes[$i];
            $course_id = $_SESSION['course_id_add'];
            $sql_schedule = "INSERT INTO course_schedule (course_id, day_of_week, start_time, end_time)
            VALUES ($course_id, '$dayOfWeek', '$startTime', '$endTime') ";
            mysqli_query($dbconnect, $sql_schedule);
        }
        header("Location: ../success_create_course.php?course_id='$course_id'&teacher_id='$teacher_id'");
        exit();
    } else {
        echo "Không có dữ liệu được gửi từ form.";
    }
}
?>
