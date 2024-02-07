<?php
include_once "../../config/connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_name = $_POST['course_name'];
    $course_code = $_POST['course_code'];
    $teacher_id = $_POST['teacher_id'];
    $des_course = $_POST['course_description'];
    $date_start = $_POST['date_start'];
    $date_end = $_POST['date_end'];
    $status = $_POST['status'];
    $sql = "INSERT INTO course (course_name,course_code,course_description,teacher_id,start_date,end_date,status) VALUES ('$course_name','$course_code','$des_course','$teacher_id','$date_start','$date_end','$status')";
    $query = mysqli_query($dbconnect, $sql);
    if (!$query) {
        echo "Lỗi khi chèn dữ liệu vào bảng course: " . mysqli_error($dbconnect);
    }
    mysqli_close($dbconnect);
    header('location:../courses.php');
}
?>
