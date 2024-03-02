<?php
include_once('layout.php');
include_once('../config/connect.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id']))
{
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM user WHERE user_id = $user_id";
    $result = mysqli_query($dbconnect, $sql);
}
else
{
    $username_now = "User not logged in";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang cá nhân</title>
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
                <h5>Quản trị viên</h5> <br>
                <a class="btn btn-primary rounded-end rounded-start" type="button" href="account_edit.php?user_id=<?php echo $user_id;?>&role_id=3&role_name=admin">Thay đổi thông tin</a>
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
                            <b>Mã số CCCD/CMND</b>
                            <br> <?php echo $row['citizen_id'];?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("../footer.php"); ?>
</body>

</html>
