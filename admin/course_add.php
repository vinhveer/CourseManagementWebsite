<?php
include("layout.php");
include_once("../config/connect.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$sql_course = "SELECT * FROM user us
    INNER JOIN user_role ur ON us.user_id = ur.user_id
    where ur.role_id=2";
$query = mysqLi_query($dbconnect, $sql_course);

mysqli_close($dbconnect);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Registration Form</title>
</head>

<body>

    <div class="container mt-5">
        <!-- Header -->
        <div class="row mb-3">
            <div class="col-md-6">
                <h2>Tạo Khóa Học Mới </h2>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary" href="courses.php">Thoát</a>
                </div>
            </div>
        </div>

        <!-- Body - Registration Form -->
        <form action="./pross/c_add.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate id="accountForm">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="fullName" class="form-label">Tên khóa học</label>
                    <input type="text" class="form-control" id="" name="course_name" required placeholder="Nhập tên khóa học">
                    <div class="invalid-feedback">
                        Tên khóa học không được trống.
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="idCard" class="form-label">Mã khóa học</label>
                    <input type="text" class="form-control" id="" name="course_code" required placeholder="Nhập mã khóa học">
                    <div class="invalid-feedback">
                        Mã khóa học không được trống.
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Ngày bắt đầu</label>
                    <input type="date" class="form-control" name="date_start" id="" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Ngày kết thúc</label>
                    <input type="date" class="form-control" name="date_end" id="" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Giáo viên giảng dạy</label>
                    <select class="form-select" name="teacher_id" id="" required>
                        <option value="" disabled selected>Chọn giáo viên</option>
                        <?php
                        while ($row = mysqli_fetch_assoc($query)) { ?>
                            <option value="<?php echo $row['user_id']; ?>"><?php echo $row['user_id']; ?>-<?php echo $row['full_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Trạng thái</label>
                    <select class="form-select" name="status" id="" required>
                        <option value="" disabled selected>Chọn trạng thái</option>
                        <option value="N">Chờ duyệt</option>
                        <option value="A">Đã duyệt</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label class="form-label">Mô tả khóa học</label>
                    <input type="text" class="form-control" name="course_description" id="" required placeholder="Thông tin khóa học" value="No description">
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary" name="sbm">Tạo khóa học</button>
                <a type="button" class="btn btn-secondary" href="courses.php">Thoát</a>
            </div>
        </form>
    </div>
    <script>
        // Enable Bootstrap form validation
        (function() {
            'use strict';

            var form = document.getElementById('accountForm');

            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false);
        })();
    </script>

</body>

</html>
