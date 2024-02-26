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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Trang chủ khóa học</title>
</head>

<body>
    <div class="container mt-4">
        <h3> <a href="courses.php"><i class="bi bi-arrow-left-circle"></i></a></h3>
        <div class="row">
            <div class="col-md-6 align-items-center">
                <div>
                    <h3><?php echo $row_layout['course_code'] . " - " . $row_layout['course_name'] ?></h3>
                    <p><?php echo $row_layout['course_description'] ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <button type="button" class="btn btn-danger float-end" data-bs-toggle="modal" data-bs-target="#deleteCourseModal">Xóa khóa học này</button>
                <a type="button" class="btn btn-primary float-end me-2" href="course_edit.php?id=<?php echo $course_id; ?>&teacher_id=<?php echo $teacher_id ?>">Thay đổi thuộc tính khóa học</a>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteCourseModal" tabindex="-1" aria-labelledby="deleteCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCourseModalLabel">Xác nhận xóa khóa học</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa khóa học này?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <form action="process.php?course_id=<?php echo $row_layout['course_id']; ?>" method="post">
                        <button type="submit" class="btn btn-danger" name="delete_course">Xóa</button>
                    </form>
                </div>
            </div>
        </div>
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
                                </tr>
                                <tr>
                                    <td><b>Số lượng thành viên</b>
                                        <br><?php echo $row_count_member['member_count'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Ngày bắt đầu</b></td>
                                    <td><?php echo date('d/m/Y', strtotime($row_layout['start_date'])) ?></td>
                                </tr>
                                <tr>
                                    <td><b>Ngày kết thúc</b></td>
                                    <td><?php echo date('d/m/Y', strtotime($row_layout['end_date'])) ?></td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Các khóa học đang tham gia -->
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5>Thời khóa biểu</h5>
                        <hr class="info-divider">

                        <table class="table table-bordered">
                            <thead class="table-light">
                                <th>Ngày trong tuần</th>
                                <th>Thời gian</th>
                            </thead>
                            <?php
                            $sql_schedule = "SELECT * FROM course_schedule WHERE course_id = $course_id";
                            $result_schedule = mysqli_query($dbconnect, $sql_schedule);

                            while ($row_schedule = mysqli_fetch_array($result_schedule)) {
                            ?>
                                <tr>
                                    <td><?php if ($row_schedule['day_of_week'] == 'C') {
                                            echo "Chủ Nhật";
                                        } else {
                                            echo "Thứ " . $row_schedule['day_of_week'];
                                        } ?></td>
                                    <td><?php echo $row_schedule['start_time'] . " - " . $row_schedule['end_time']; ?></td>
                                </tr>
                            <?php
                            }
                            ?>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        function Del(name) {
            return confirm("Bạn có chắc chắn muốn từ bỏ khóa học: " + name + " ?");
        }
    </script>
        <?php include("footer.php"); ?>
</body>

</html>
