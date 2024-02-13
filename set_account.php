<?php
include_once('layout.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Thông tin tài khoản</title>
</head>

<body>
    <div class="container mt-5">
        <h3>Thông tin tài khoản</h3>
        <p>Hoàn thành các thông tin sau:</p>
        <hr class="my-4">

        <form id="accountInfoForm" action="process.php" method="post" class="needs-validation" novalidate enctype="multipart/form-data" >
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="username" class="form-label">Tên tài khoản</label>
                    <div class="input-group">
                        <span class="input-group-text">@</span>
                        <input type="text" class="form-control" id="username" name="username" pattern="[a-zA-Z0-9_]+" title="Tên tài khoản không hợp lệ. Chỉ chấp nhận chữ, số và gạch dưới." required>
                        <div class="invalid-feedback">
                            Tên tài khoản không hợp lệ. Chỉ chấp nhận chữ, số và gạch dưới.
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <div class="invalid-feedback">
                        Mật khẩu không được trống.
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="text-end">
                <button type="submit" class="btn btn-primary" name="sbm">Hoàn tất việc tạo tài khoản</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-rqI2waM7CtpVHmUnY9NXfQTKc3N8RBLtbl6TbY3b3NC6HjbF2wF81v11z5KnMK17" crossorigin="anonymous"></script>
    <script>
        // Enable Bootstrap form validation
        (function() {
            'use strict';

            var form = document.getElementById('accountInfoForm');

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
