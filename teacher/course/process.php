<?php
include_once('../../config/connect.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['delete_course'])) {
    // Lấy course_id từ SESSION
    $course_id = $_SESSION['course_id'];

    // Thực hiện thao tác xóa khóa học từ cơ sở dữ liệu
    $sql_delete_course = "DELETE FROM course WHERE course_id = $course_id";
    $result_delete_course = mysqli_query($dbconnect, $sql_delete_course);

    if ($result_delete_course) {
        // Xóa thành công, có thể thực hiện các bước khác nếu cần thiết
        header("location: ../courses.php");
    } else {
        // Xóa thất bại, xử lý lỗi hoặc thông báo cho người dùng
        echo "Không thể xóa khóa học. Lỗi: " . mysqli_error($dbconnect);
    }
}

if (isset($_POST['edit_course'])) {
    // Lấy dữ liệu từ form
    $course_name = mysqli_real_escape_string($dbconnect, $_POST['course_name']);
    $course_code = mysqli_real_escape_string($dbconnect, $_POST['course_code']);
    $course_description = mysqli_real_escape_string($dbconnect, $_POST['course_description']);
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $course_id = $_SESSION['course_id'];

    // Cập nhật thông tin khóa học trong cơ sở dữ liệu
    $update_course_query = "UPDATE course SET 
                            course_name = '$course_name',
                            course_code = '$course_code',
                            course_description = '$course_description',
                            start_date = '$start_date',
                            end_date = '$end_date'
                            WHERE course_id = $course_id";

    mysqli_query($dbconnect, $update_course_query);

    header("Location: index.php");
    exit();
}
?>
