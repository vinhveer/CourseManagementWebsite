<?php
include_once('../config/connect.php');

session_start();

if (isset($_SESSION['full_name']))
{
    $username_now = $_SESSION['full_name'];
}
else
{
    $username_now = "User not logged in";
}

$teacher_id = $_SESSION['user_id'];
$sql_profile = "SELECT image FROM user WHERE user_id = $teacher_id";
$result_profile = mysqli_query($dbconnect, $sql_profile);
$row_profile = mysqli_fetch_assoc($result_profile);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 70px;
        }
    </style>
</head>

<body class="with-navbar">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">LMS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="courses.php">Khóa học của tôi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="othercourses.php">Các khóa học khác</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="schedule.php">Lịch giảng dạy</a>
                    </li>
                    <li class="nav-item dropdown">
                        <?php if (isset($username_now)) : ?>
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="text-white">
                                    <?php echo $username_now; ?>
                                </span>
                                <img src="<?php echo "../" . $row_profile['image']?>" alt="Avatar" class="img-fluid rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="my.php">Trang cá nhân</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php">Đăng xuất</a>
                            </div>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JavaScript dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
