<?php 
include("layout.php");
include_once('../config/connect.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$sql_student_account = "SELECT * FROM user_account ua
INNER JOIN user us ON ua.user_id = us.user_id
INNER JOIN user_role ur ON us.user_id = ur.user_id
WHERE role_id = 3;";
$result_student_account = mysqli_query($dbconnect, $sql_student_account);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <title>Danh sách tài khoản - Quản trị hệ thống</title>
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <h3>Danh sách tài khoản (Quản trị hệ thống)</h3>
            </div>
            <div class="col-md-4">
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Tìm kiếm" aria-label="Tìm kiếm" />
                    <button class="btn btn-outline-primary" type="submit">Tìm</button>
                </form>
            </div>
            <div class="col-md-2 text-right">
              <a class="btn btn-primary" type="button" href=""> Tạo tài khoản mới </a>
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
                        while ($row_student_account = mysqli_fetch_array($result_student_account))
                        {
                        ?>
                        <tr>
                            <td><?php $i++; echo $i ?></td>
                            <td><?php echo $row_student_account['full_name'] ?></td>
                            <td><?php echo date('d/m/Y', strtotime($row_student_account['date_of_birth'])); ?></td>
                            <td><?php echo $row_student_account['username'] ?></td>
                            <td><?php echo $row_student_account['password'] ?></td>
                            <td>
                                <button class="btn btn-info btn-sm">Sửa</button>
                                <button class="btn btn-danger btn-sm">Xóa</button>
                                <button class="btn btn-info btn-sm">Thông tin</button>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
