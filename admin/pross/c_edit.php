<?php
include_once('../../config/connect.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$course_id = $_POST['course_id'];

$sql_course = "SELECT * FROM course WHERE course_id = $course_id";
$result_edit = mysqli_query($dbconnect, $sql_course);
$row_update = mysqli_fetch_array($result_edit);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_schedule"])) {
    $course_name = $_SESSION["course_name"];
    $course_code = $_SESSION["course_code"];
    $course_description = $_SESSION["course_description"];
    $start_date = $_SESSION["start_date"];
    $end_date = $_SESSION["end_date"];
    $teacher_id = $_SESSION['teacher_course'];
    $fileName = $_SESSION['course_image'];

    unset($_SESSION["course_name"]);
    unset($_SESSION["course_code"]);
    unset($_SESSION["course_description"]);
    unset($_SESSION["start_date"]);
    unset($_SESSION["end_date"]);
    unset($_SESSION['teacher_course']);
    unset($_SESSION['course_image']);

    if (empty($fileName)) {
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

    // Kiểm tra xem có dữ liệu được gửi từ biểu mẫu không
    if (!empty($dayOfWeeks) && !empty($startTimes) && !empty($endTimes)) {
        $scheduleIdsToKeep = array();
        for ($i = 0; $i < count($dayOfWeeks); $i++) {

            $dayOfWeek = $dayOfWeeks[$i];
            $startTime = $startTimes[$i];
            $endTime = $endTimes[$i];

            switch ($dayOfWeek) {
                case "monday":
                    $dayOfWeekValue = "2";
                    break;
                case "tuesday":
                    $dayOfWeekValue = "3";
                    break;
                case "wednesday":
                    $dayOfWeekValue = "4";
                    break;
                case "thursday":
                    $dayOfWeekValue = "5";
                    break;
                case "friday":
                    $dayOfWeekValue = "6";
                    break;
                case "saturday":
                    $dayOfWeekValue = "7";
                    break;
                case "sunday":
                    $dayOfWeekValue = "C";
                    break;
            }

            if(isset($_POST['schedule_id'][$i])) {
                $schedule_id = $_POST['schedule_id'][$i];
                $scheduleIdsToKeep[] = $schedule_id;
                // Nếu có, thực hiện cập nhật thông tin thời khóa biểu
                $sql_schedule = "UPDATE course_schedule SET day_of_week ='$dayOfWeekValue', start_time='$startTime', end_time= '$endTime' where course_schedule_id = $schedule_id";
                mysqli_query($dbconnect, $sql_schedule);
            } else {
                // Nếu không, thực hiện thêm mới thông tin thời khóa biểu
                $sql_schedule = "INSERT INTO course_schedule (course_id, day_of_week, start_time, end_time) VALUES ('$course_id', '$dayOfWeekValue', '$startTime', '$endTime')";
                mysqli_query($dbconnect, $sql_schedule);
                $scheduleIdsToKeep[] = mysqli_insert_id($dbconnect);
            }
        }

        $scheduleisset = implode(',', $scheduleIdsToKeep);
        $sql_delete_schedule = "DELETE FROM course_schedule WHERE course_id ='$course_id' AND course_schedule_id NOT IN ($scheduleisset)";
        mysqli_query($dbconnect, $sql_delete_schedule);

        header("Location: ../success_course.php?course_id=$course_id&teacher_id=$teacher_id");
        exit();
    } else {
        echo "Không có dữ liệu được gửi từ form.";
    }
}
?>
