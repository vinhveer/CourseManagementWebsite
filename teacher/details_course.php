<?php
include_once('layout.php');
include_once('../config/connect.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$course_id = $_GET['course_id'];

$sql_course = "SELECT * FROM course WHERE course_id = $course_id";
$result_course = mysqli_query($dbconnect, $sql_course);
$row_course = mysqli_fetch_assoc($result_course);

$teacher_id = $row_course['teacher_id'];
$sql_user = "SELECT * FROM user WHERE user_id = $teacher_id";
$result_user = mysqli_query($dbconnect, $sql_user);
if ($result_user) {
    $row_user = mysqli_fetch_assoc($result_user);
}

$sql_count_member = "SELECT COUNT(*) AS member_count FROM course_member WHERE course_id = $course_id";
$result_count_member = mysqli_query($dbconnect, $sql_count_member);
$row_count_member = mysqli_fetch_assoc($result_count_member);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ khóa học</title>
</head>

<body>
    <div class="container mt-4">
        <h3><?php echo $row_course['course_code'] . " - " . $row_course['course_name']?></h3>
        <p><?php echo $row_course['course_description']?></p>
    </div>
    <!-- Body Section -->
    <div class="container mt-4">
        <div class="row">
            <!-- Thông tin cá nhân -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Thông tin khóa học</h5>
                        <hr class="info-divider">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>
                                        <b>Giáo viên giảng dạy</b>
                                        <br><?php echo $row_user['full_name'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Số lượng thành viên</b>
                                    <br><?php echo $row_count_member['member_count']?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Ngày bắt đầu</b>
                                    <br><?php echo date('d/m/Y', strtotime($row_course['start_date']))?></td>
                                </tr>
                                <tr>
                                    <td><b>Ngày kết thúc</b>
                                    <br><?php echo date('d/m/Y', strtotime($row_course['end_date']))?></td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("../footer.php"); ?>
</body>

</html>