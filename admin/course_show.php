<?php
include_once('layout.php');
include_once('../config/connect.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$teacher_id = $_GET['teacher_id'];
$sql_user = "SELECT * FROM user WHERE user_id = $teacher_id";
$result_user = mysqli_query($dbconnect, $sql_user);
if ($result_user) {
    $row_user = mysqli_fetch_assoc($result_user);
}
$course_id = $_GET['id'];
$sql_count_member = "SELECT COUNT(*) AS member_count FROM course_member WHERE course_id = $course_id";
$result_count_member = mysqli_query($dbconnect, $sql_count_member);
$row_count_member = mysqli_fetch_assoc($result_count_member);

$sql_layout = "SELECT * FROM course WHERE course_id = $course_id";
    $result_layout = mysqli_query($dbconnect, $sql_layout);
    if ($result_layout) {
        $row_layout = mysqli_fetch_assoc($result_layout);
    } else {
        echo "Error retrieving course information: " . mysqli_error($dbconnect);
        exit();
    }
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
        <h3><?php echo $row_layout['course_code'] . " - " . $row_layout['course_name']?></h3>
        <p><?php echo $row_layout['course_description']?></p>
    </div>
    <!-- Body Section -->
    <div class="container mt-4">
        <div class="row">
            <!-- Thông tin cá nhân -->
            <div class="col-md-6">

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
                                    <td><a type="button" class="btn btn-primary" href="course_my_teacher.php?user_id=<?php echo $teacher_id?>&course_id=<?php echo $course_id; ?>">Xem chi tiết thông tin</td>
                                </tr>
                                <tr>
                                    <td><b>Số lượng thành viên</b>
                                    <br><?php echo $row_count_member['member_count']?>
                                    </td>
                                    <td><a type="button" class="btn btn-primary" href="course_member.php?course_id=<?php echo $course_id; ?>&user_id=<?php echo $teacher_id?>">Xem danh sách thành viên</td>
                                </tr>
                                <tr>
                                    <td><b>Ngày bắt đầu</b></td>
                                    <td><?php echo date('d/m/Y', strtotime($row_layout['start_date']))?></td>
                                </tr>
                                <tr>
                                    <td><b>Ngày kết thúc</b></td>
                                    <td><?php echo date('d/m/Y', strtotime($row_layout['end_date']))?></td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <br><a class="btn btn-primary" type="button" href="course_edit.php?id=<?php echo $course_id ?>">Thay đổi thông tin</a>
                <a type="button" class="btn btn-secondary" href="courses.php">Thoát</a>
            </div>
            <!-- Các khóa học đang tham gia -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5>Thông báo</h5>
                        <hr class="info-divider">
                        <h6>Thông báo mới</h6>
                        <p>Không có thông báo!</p>
                        <h6>Tin nhắn mới</h6>
                        <p>Không có tin nhắn chưa đọc!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
