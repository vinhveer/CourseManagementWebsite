<?php
include_once('../config/connect.php');

session_start();

if (isset($_SESSION['full_name'])) {
    $sql_user = "SELECT * FROM user us
    INNER JOIN user_role ur ON us.user_id = ur.user_id WHERE us.full_name = ?";
    $stmt_user = mysqli_prepare($dbconnect, $sql_user);
    mysqli_stmt_bind_param($stmt_user, "s", $_SESSION['full_name']);
    mysqli_stmt_execute($stmt_user);
    $result_user = mysqli_stmt_get_result($stmt_user);
    $row_la = mysqli_fetch_array($result_user);
    if ($row_la['role_id'] == 3) {
        $username_now = $_SESSION['full_name'];
    } else {
        $username_now = "Quản trị viên";
    }
} else {
    $username_now = "User not logged in";
}
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">LMS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="courses.php">Khóa học</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="teacher.php">Giáo viên</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="student.php">Học sinh</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php">Quản trị hệ thống</a>
                    </li>
                    <li class="nav-item dropdown">
                        <?php if (isset($username_now)) : ?>
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span>
                                    <?php echo $username_now; ?>
                                </span>
                                <img src="../assets/images/<?php echo $row_la['image']; ?>" alt="Avatar" class="rounded-circle" width="30" height="30">
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php if ($username_now !="Quản trị viên" && $username_now != "User not logged in") : ?>
                                <a class="dropdown-item" href="my.php">Trang cá nhân</a>
                            <?php endif; ?>
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
