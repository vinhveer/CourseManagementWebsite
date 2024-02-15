<?php
include_once('../../config/connect.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$course_id = $_POST['course_id'];
$sql_course = "SELECT * FROM course Where course_id = $course_id";
$result_edit = mysqli_query($dbconnect,$sql_course);
$row_update = mysqli_fetch_array($result_edit);
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_schedule"])) {
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
    if(empty($fileName)){
        $fileName = $row_update['course_background'];
    }
    $sql_create_course = "UPDATE course SET course_background ='$fileName',course_name='$course_name',course_code='$course_code',course_description='$course_description',teacher_id='$teacher_id',start_date='$start_date',end_date='$end_date' where course_id = $course_id";
    $result_course = mysqli_query($dbconnect, $sql_create_course);
    if(!$result_course) {
        die("Something went wrong. Error: " . mysqli_error($dbconnect));
    }
    $dayOfWeeks = $_POST["dayOfWeek"];
    $startTimes = $_POST["startTime"];
    $endTimes = $_POST["endTime"];

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
            $sql_schedule = "UPDATE course_schedule SET day_of_week ='$dayOfWeek', start_time='$startTime', end_time= '$endTime' where course_id = $course_id";
            mysqli_query($dbconnect, $sql_schedule);
        }
            header("Location: ../success_course.php?course_id=$course_id&teacher_id=$teacher_id");
        exit();
    } else {
        echo "Không có dữ liệu được gửi từ form.";
    }
}

?>
