<?php
include("layout.php");
include_once('../config/connect.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$role_id = $_GET['id'];
if ($role_id == 1) {
    $role_fullName = "Học Sinh";
} else if ($role_id == 2) {
    $role_fullName = "Giáo Viên";
} else if ($role_id == 3) {
    $role_fullName = "Quản Trị Hệ Thống";
}
if (isset($_GET['timkiem'])) {
    $tukhoa = $_GET['tukhoa'];
}
    $sql_account = "SELECT * FROM user_account ua
    INNER JOIN user us ON ua.user_id = us.user_id
    INNER JOIN user_role ur ON us.user_id = ur.user_id
    WHERE ur.role_id = $role_id AND BINARY us.full_name LIKE '%".$tukhoa."%' ";
    $result_account = mysqli_query($dbconnect, $sql_account);
    $row = mysqli_fetch_array($result_account);
mysqli_close($dbconnect);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <title>Danh sách tài khoản - <?php echo $role_fullName; ?></title>
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <h3>Danh sách tài khoản (<?php echo $role_fullName ?>)</h3>
            </div>
            <div class="col-md-4">
            <form class="d-flex" action="acc_find.php" method="GET">
                <input class="form-control me-2" type="search" placeholder="Tìm kiếm" aria-label="Tìm kiếm" name="tukhoa"value="">
                <input type="hidden" name="id" value="<?php echo $role_id;?>">
                <input type="hidden" name="role_name" value="<?php echo $_GET['role_name']; ?>">
            <button class="btn btn-outline-primary" type="submit" name="timkiem">Tìm</button>
            </form>
            </div>
            <div class="col-md-2 text-right">
                <a class="btn btn-primary" type="button" href="<?php echo $_GET['role_name']; ?>.php"> Thoát </a>
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
                        // Đặt con trỏ kết quả về đầu để có thể duyệt lại từ đầu
                        mysqli_data_seek($result_account, 0);
                        while ($row = mysqli_fetch_array($result_account)) {
                        ?>
                            <tr>
                                <td><?php $i++;
                                    echo $i ?></td>
                                <td><?php echo $row['full_name'] ?></td>
                                <td><?php echo date('d/m/Y', strtotime($row['date_of_birth'])); ?></td>
                                <td><?php echo $row['username'] ?></td>
                                <td><?php echo $row['password'] ?></td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="acc_edit.php?user_id=<?php echo $row['user_id']; ?>&role_id=<?php echo $role_id;?>&role_name=<?php echo $_GET['role_name']; ?>">Sửa</a>
                                    <a class="btn btn-danger btn-sm" onclick="return Del('<?php echo $row['full_name']; ?>')" href="pross/delete.php?user_id=<?php echo $row['user_id']; ?>&role_id=<?php echo $role_id;?>">Xóa</a>
                                    <a class="btn btn-info btn-sm" href="acc_view.php?user_id=<?php echo $row['user_id']; ?>&role_id=<?php echo $role_id;?>&role_name=<?php echo $_GET['role_name']; ?>">Thông tin</a>
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
    <script>
        function Del(name) {
            return confirm("Bạn có chắc chắn muốn xóa tài khoản: " + name + " ?");
        }
    </script>
</body>

</html>
