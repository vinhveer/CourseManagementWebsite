<?php
include("layout.php");
include_once ("../config/connect.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$role_id = $_GET['role_id']; $role_name = $_GET['role_name'];
if($role_id == 1){
    $role_fullName = "Học Sinh";
}else if($role_id == 2){
    $role_fullName = "Giáo Viên";
}else if($role_id == 3){
    $role_fullName = "Quản Trị Viên";
}
mysqli_close($dbconnect);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Registration Form</title>
</head>

<body>

    <div class="container mt-5">
        <!-- Header -->
        <div class="row mb-3">
            <div class="col-md-6">
                <h2>Tạo tài khoản mới (<?php echo $role_fullName?>)</h2>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary me-2">Tải lên từ Excel</button>
                    <a class="btn btn-primary" href="<?php echo $role_name;?>.php">Thoát</a>
                </div>
            </div>
        </div>

        <!-- Body - Registration Form -->
        <form action="pross/add.php?id=<?php echo $role_id; ?>" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate id="accountForm">
        <div class="row mb-3">
                <div class="col-md-6">
                    <label for="fullName" class="form-label">Họ và tên</label>
                    <input type="text" class="form-control" id="fullName" name="full_name" required placeholder="Nhập họ tên">
                    <div class="invalid-feedback">
                        Họ và tên không được trống.
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="idCard" class="form-label">Mã số căn cước công dân</label>
                    <input type="text" class="form-control" id="idCard" name="citizen_id" required placeholder="Nhập CCCD">
                    <div class="invalid-feedback">
                        Mã số căn cước công dân không được trống.
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="dob" class="form-label">Ngày sinh</label>
                    <input type="date" class="form-control" id="dob" name="date_of_birth" required>
                </div>
                <div class="col-md-4">
                    <label for="gender" class="form-label">Giới tính</label>
                    <select class="form-select" id="gender" name="gender" required>
                        <option value="" disabled selected>Chọn giới tính</option>
                        <option value="M">Nam</option>
                        <option value="F">Nữ</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="phoneNumber" class="form-label">Số điện thoại</label>
                    <input type="tel" class="form-control" id="phoneNumber" name="phone" required placeholder="Nhập Số điện thoại">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="Nhập email">
                </div>
                <div class="col-md-6">
                    <label for="address" class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" id="address" name="address" required placeholder="Nhập địa chỉ">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="portrait" class="form-label">Ảnh chân dung</label>
                    <input type="file" class="form-control" id="portrait" name="image" required>
                    <div class="invalid-feedback">
                        Vui lòng chọn ảnh chân dung.
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary" name="sbm">Tạo Tài Khoản</button>
                <a type="button" class="btn btn-secondary" href="<?php echo $role_name;?>.php">Thoát</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-rqI2waM7CtpVHmUnY9NXfQTKc3N8RBLtbl6TbY3b3NC6HjbF2wF81v11z5KnMK17" crossorigin="anonymous"></script>
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
