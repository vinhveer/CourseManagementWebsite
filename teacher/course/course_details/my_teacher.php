<?php
include_once('layout.php');
include_once('../../config/connect.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM user WHERE user_id = $user_id";
    $result = mysqli_query($dbconnect, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
    }
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
                <img src="<?php echo "../" . $row['image'] ?>" alt="Profile Image" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
            </div>
            <div class="col-md-10">
                <h2><?php echo $row['full_name'];?></h2>
                <h5>Giáo viên</h5> <br>
                <a class="btn btn-primary" type="button" href="../edit_teacher_profile.php">Thay đổi thông tin</a>
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

            <!-- Các khóa học đang tham gia -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Các khóa học đang tham gia</h4>
                        <hr class="info-divider">
                        <?php
                        $sql = "SELECT * FROM course WHERE teacher_id = $user_id";
                        $result = mysqli_query($dbconnect, $sql);
                        while ($row = mysqli_fetch_array($result)) {
                            echo $row['course_code'] . " - " . $row['course_name'];
                            echo "<br>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("../../footer.php"); ?>
</body>

</html>
