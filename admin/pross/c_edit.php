<?php
include_once "../../config/connect.php";
$id = $_GET['id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_name = $_POST['course_name'];
    $course_code = $_POST['course_code'];
    $teacher_id = $_POST['teacher_id'];
    $des_course = $_POST['course_description'];
    $date_start = $_POST['date_start'];
    $date_end = $_POST['date_end'];
    $status = $_POST['status'];
    $sql = "UPDATE course SET course_name='$course_name',course_code='$course_code',course_description='$des_course',teacher_id='$teacher_id',start_date='$date_start',end_date='$date_end' where course_id = $id";
    $query = mysqli_query($dbconnect, $sql);
    if (!$query) {
        echo "Lỗi khi chèn dữ liệu vào bảng course: " . mysqli_error($dbconnect);
    }
    mysqli_close($dbconnect);
    header('location:../courses.php');
}
?>
