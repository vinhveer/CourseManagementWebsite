<?php
include("layout.php");
include_once('../config/connect.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['timkiem'])) {
    $tukhoa = $_POST['tukhoa'];
    $keyword = strtolower(trim($tukhoa));
    $keyword = str_replace(' ', '', $keyword);
    $sql_student_account =
        "SELECT * FROM user_account ua
        INNER JOIN user us ON ua.user_id = us.user_id
        INNER JOIN user_role ur ON us.user_id = ur.user_id
        WHERE ur.role_id = 1 AND
        (LOWER(REPLACE(REPLACE(REPLACE(REPLACE(us.full_name, ' ', ''), 'Đ', 'D'),'đ','d'), ' ', '')) LIKE '%$keyword%' OR us.full_name LIKE '%$tukhoa%')";
    $result_student_account = mysqli_query($dbconnect, $sql_student_account);
} else {
    $sql_student_account = "SELECT * FROM user_account ua
    INNER JOIN user us ON ua.user_id = us.user_id
    INNER JOIN user_role ur ON us.user_id = ur.user_id
    WHERE ur.role_id = 1";
    $result_student_account = mysqli_query($dbconnect, $sql_student_account);
}
mysqli_close($dbconnect);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <title>Danh sách tài khoản - Học sinh</title>
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <h3>Danh sách tài khoản (Học sinh)</h3>
            </div>
            <div class="col-md-4">
                <form class="d-flex" action="student.php" method="POST">
                    <input class="form-control me-2" type="search" placeholder="Tìm kiếm" aria-label="Tìm kiếm" name="tukhoa" value="">
                    <button class="btn btn-outline-primary" type="submit" name="timkiem" value="find">Tìm</button>
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
            <div class="col-md-2 text-right">
                <a class="btn btn-primary" type="button" href="account_add.php?role_id=1&role_name=student"> Tạo tài khoản mới </a>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Họ và tên</th>
                            <th>Ngày sinh</th>
                            <th>Tên đăng nhập</th>
                            <th>Mật khẩu</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        while ($row_student_account = mysqli_fetch_array($result_student_account)) {
                        ?>
                            <tr>
                                <td><?php $i++;
                                    echo $i ?></td>
                                <td><?php echo $row_student_account['full_name'] ?></td>
                                <td><?php echo date('d/m/Y', strtotime($row_student_account['date_of_birth'])); ?></td>
                                <td><?php echo $row_student_account['username'] ?></td>
                                <td><?php echo $row_student_account['password'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-danger float-end me-2" data-postid="<?php echo $row_student_account['user_id']; ?>" data-bs-toggle="modal" data-bs-target="#deleteCourseModal">Xóa</button>
                                    <a class="btn btn-info float-end me-2" href="account_edit.php?user_id=<?php echo $row_student_account['user_id']; ?>&role_id=1&role_name=student">Sửa</a>
                                    <a class="btn btn-info float-end me-2" href="account_view.php?user_id=<?php echo $row_student_account['user_id']; ?>&role_id=1&role_name=student">Thông tin</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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
                    <form id="deletePostForm" action="" method="post">
                        <button type="submit" class="btn btn-danger" name="delete_student">Xóa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn.btn-danger.float-end.me-2');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.getAttribute('data-postid');
                    const form = document.querySelector('#deletePostForm');
                    form.action = `process.php?user_id=${userId}`;
                });
            });
        });
    </script>
        <?php include("../footer.php"); ?>
</body>

</html>
