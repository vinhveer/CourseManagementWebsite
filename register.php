<?php
include_once('layout.php');
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['fullName'] = $_POST['fullName'];
    $_SESSION['idCard'] = $_POST['idCard'];
    $_SESSION['dob'] = $_POST['dob'];
    $_SESSION['gender'] = $_POST['gender'];
    $_SESSION['phoneNumber'] = $_POST['phoneNumber'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['address'] = $_POST['address'];
    $_SESSION['portrait'] = $_FILES['portrait']['name'];
    $image = $_SESSION['portrait'];
    $image_tmp = $_FILES['portrait']['tmp_name'];
    if (move_uploaded_file($image_tmp,'assets/images/'.$image)) {
        echo 'Upload thành công';
    } else {
        echo 'Lỗi khi upload: ' . error_get_last()['message'];
        exit;
    }
    header("location: choose_role.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Tạo tài khoản mới</title>
</head>

<body>
    <div class="container mt-5">
        <h3>Tạo tài khoản mới</h3>
        <p>Hoàn thành các nội dung dưới đây</p>

        <form id="accountForm" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="fullName" class="form-label">Họ và tên</label>
                    <input type="text" class="form-control" id="fullName" name="fullName" required>
                    <div class="invalid-feedback">
                        Họ và tên không được trống.
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="idCard" class="form-label">Mã số căn cước công dân</label>
                    <input type="text" class="form-control" id="idCard" name="idCard" required>
                    <div class="invalid-feedback">
                        Mã số căn cước công dân không được trống.
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="dob" class="form-label">Ngày sinh</label>
                    <input type="date" class="form-control" id="dob" name="dob" required>
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
                    <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="col-md-6">
                    <label for="address" class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="portrait" class="form-label">Ảnh chân dung</label>
                    <input type="file" class="form-control" id="portrait" name="portrait" required>
                    <div class="invalid-feedback">
                        Vui lòng chọn ảnh chân dung.
                    </div>
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary" name="sbm">Tạo tài khoản mới</button>
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
