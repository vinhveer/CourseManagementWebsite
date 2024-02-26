<?php
include("layout.php");
include_once("../config/connect.php");
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
if (isset($_GET['user_id']))
{
    $user_id = $_GET['user_id'];
    $sql = "SELECT * FROM user us
    INNER JOIN user_role ur ON us.user_id = ur.user_id
    INNER JOIN user_account ua ON ua.user_id = us.user_id
    INNER JOIN role r ON r.role_id = ur.role_id
    WHERE us.user_id=$user_id";
    $result = mysqli_query($dbconnect, $sql);
}
else
{
    $username_now = "User not logged in";
}
mysqli_close($dbconnect);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang thông tin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .profile-image {
            border-radius: 50%;
            width: 150px;
            height: 150px;
        }
        .info-divider {
            border: 0;
            height: 1px;
            background-color: #ccc; /* Màu của đường kẻ */
            margin: 10px 0; /* Khoảng cách trên và dưới đường kẻ */
        }
    </style>
</head>

<body>
    <?php
        // Đặt con trỏ kết quả về đầu để có thể duyệt lại từ đầu
        mysqli_data_seek($result, 0);
        $row = mysqli_fetch_assoc($result)
    ?>
    <header class="container mt-4">
        <div class="row">
            <div class="col-md-2">
                <img src="../assets/images/<?php echo $row['image'];?>" alt="Profile Image" class="profile-image">
            </div>
            <div class="col-md-10">
                <h2><?php echo $row['full_name'];?></h2>
                <h5><?php echo $role_fullName?></h5> <br>
                <a class="btn btn-primary rounded-end rounded-start" type="button" href="account_edit.php?user_id=<?php echo $row['user_id']; ?>&role_id=<?php echo $row['role_id'];?>&role_name=<?php echo $row['role_name'];?>">Thay đổi thông tin</a>
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary" href="<?php echo $role_name;?>.php">Thoát</a>
                </div>
            </div>

        </div>

    </header>

    <!-- Body Section -->
    <div class="container mt-4">
        <div class="row">
            <!-- Thông tin cá nhân -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Thông tin cá nhân</h4>
                        <hr class="info-divider">
                        <p>
                            <b>Ngày sinh</b>
                            <br> <?php echo date('d/m/Y', strtotime($row['date_of_birth'])); ?>
                        </p>
                        <p>
                            <b>Giới tính</b>
                            <br> <?php echo ($row['gender'] == "M" ? "Nam":"Nữ");?>
                        </p>
                        <p>
                            <b>Email</b>
                            <br> <?php echo $row['email'];?>
                        </p>
                        <p>
                            <b>Số điện thoại</b>
                            <br> <?php echo $row['phone'];?>
                        </p>
                        <p>
                            <b>Địa chỉ</b>
                            <br> <?php echo $row['address'];?>
                        </p>
                        <p>
                            <b>Mã số CCCD/CMND</b>
                            <br> <?php echo $row['citizen_id'];?>
                        </p>
                        <p>
                            <b>Tài khoản</b>
                            <br> <?php echo $row['username'];?>
                        </p>
                        <p>
                            <b>Mật khẩu</b>
                            <br> <?php echo $row['password'];?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <br>
                <a type="button" class="btn btn-secondary" href="<?php echo $role_name;?>.php">Thoát</a>
            </div>
        </div>
    </div>
    <?php include("../footer.php"); ?>
</body>

</html>
