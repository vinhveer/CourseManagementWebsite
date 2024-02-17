<?php
include_once('layout.php');
include_once('../../config/connect.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Initialize $result to avoid undefined variable warning
$result = null;

if (isset($_SESSION['course_id'])) {
    $course_id = $_SESSION['course_id'];
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['timkiem'])) {
        $tukhoa = $_POST['tukhoa'];
        $keyword = strtolower(trim($tukhoa));
        $keyword = str_replace(' ', '', $keyword);
        $sql = "SELECT * FROM user us
        INNER JOIN course_member cm ON us.user_id = cm.student_id
        WHERE course_id = $course_id AND
        (LOWER(REPLACE(REPLACE(REPLACE(REPLACE(full_name, ' ', ''), 'Đ', 'D'),'đ','d'), ' ', '')) LIKE '%$keyword%' OR full_name LIKE '%$tukhoa%')";
        $result = mysqli_query($dbconnect, $sql);
        if (!$result) {
            // Query execution failed
            die('Query failed: ' . mysqli_error($dbconnect));
        }
    } else {
        $sql = "SELECT * FROM user us
        INNER JOIN course_member cm ON us.user_id = cm.student_id
        WHERE course_id = $course_id";
        $result = mysqli_query($dbconnect, $sql);
        if (!$result) {
            // Query execution failed
            die('Query failed: ' . mysqli_error($dbconnect));
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Danh sách thành viên</title>
</head>

<body>
    <header class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <h3>Danh sách thành viên</h3>
            </div>
            <div class="col-md-6">
                <form class="d-flex" action="member.php" method="POST">
                    <div class="input-group">
                        <input type="search" class="form-control me-2" placeholder="Tìm kiếm" name="tukhoa" aria-label="Tìm kiếm">
                        <button class="btn btn-outline-primary" type="submit" name="timkiem" value="find">Tìm</button>
                    </div>
                </form>
                <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['timkiem'])) { ?>
                    <div class="row mt-3">
                        <div class="col">
                            <?php
                            $tukhoa = $_POST['tukhoa'];
                            echo "<p>Tìm kiếm với từ khóa: '<strong>$tukhoa</strong>'</p>";
                            ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </header>

    <div class="container mt-4">
        <div class="row">
            <div class="">
                <table class="table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Họ và tên</th>
                            <th>Ngày sinh</th>
                            <th>Giới tính</th>
                            <th>Email</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result && mysqli_num_rows($result) > 0) {

                            mysqli_data_seek($result, 0);
                            $index = 0;
                            while ($row = mysqli_fetch_array($result)) {
                                $student_id = $row['student_id'];
                        ?>
                                <tr>
                                    <td><?php $index++;
                                        echo $index; ?></td>
                                    <td><?php echo $row['full_name']; ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($row['date_of_birth'])); ?></td>
                                    <td><?php echo ($row['gender'] == "M" ? "Nam" : "Nữ"); ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <a role="button" class="btn btn-primary" href="my_student.php?user_id=<?php echo $student_id ?>">Xem chi tiết thông tin</a>
                                            <button type="button" class="btn btn-danger ml-auto" data-bs-toggle="modal" data-bs-target="#deleteMemberModal-<?php echo $student_id; ?>">Loại khỏi khóa học</button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal for each row -->
                                <div class="modal fade" id="deleteMemberModal-<?php echo $student_id; ?>" tabindex="-1" aria-labelledby="deleteMemberModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteMemberModalLabel">Xác nhận</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Bạn có chắc chắn muốn loại thành viên này?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                <form action="process.php" method="post">
                                                    <input type="hidden" name="delete_student_id" value="<?php echo $student_id; ?>">
                                                    <button type="submit" class="btn btn-danger" name="delete_member_course">Loại thành viên</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        <?php
                            }
                        } else {
                            echo '<tr><td colspan="7">No records found</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
