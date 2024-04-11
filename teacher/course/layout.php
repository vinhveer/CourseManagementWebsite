<?php
include_once('../../config/connect.php');

session_start();

if (isset($_GET['id'])) {
    $_SESSION['course_id'] = $_GET['id'];
}

if (isset($_SESSION['user_id'])) {
    $username_now = $_SESSION['full_name'];
    $teacher_id = $_SESSION['user_id'];
    $sql_profile = "SELECT image FROM user WHERE user_id = $teacher_id";
    $result_profile = mysqli_query($dbconnect, $sql_profile);
    $row_profile = mysqli_fetch_assoc($result_profile);
} else {
    $username_now = "User not logged in";
}
if (isset($_SESSION['course_id'])) {
    $course_id = $_SESSION['course_id'];
    $sql_layout = "SELECT * FROM course WHERE course_id = $course_id";
    $result_layout = mysqli_query($dbconnect, $sql_layout);

    if ($result_layout) {
        $row_layout = mysqli_fetch_assoc($result_layout);
    } else {
        echo "Error retrieving course information: " . mysqli_error($dbconnect);
        exit();
    }
} else {
    $course_id = $_GET['id'];
    $_SESSION['course_id'] = $course_id;
    $sql_layout = "SELECT * FROM course WHERE course_id = $course_id";
    $result_layout = mysqli_query($dbconnect, $sql_layout);

    if ($result_layout) {
        $row_layout = mysqli_fetch_assoc($result_layout);
    } else {
        echo "Error retrieving course information: " . mysqli_error($dbconnect);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            padding-top: 60px;
        }
        .navbar {
            padding: 5px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><?php echo $row_layout['course_code'] . " - " . $row_layout['course_name'] ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="post/post.php">Bài đăng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="content.php">Nội dung</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="exam.php">Bài tập và kiểm tra</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./grade/grade_column.php">Điểm số</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <?php if (isset($username_now)) : ?>
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span>
                                    <?php echo $username_now; ?>
                                </span>
                                <img src="<?php echo "../../" . $row_profile['image'] ?>" alt="Avatar" class="img-fluid rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
                            </a>
                        <?php endif; ?>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../my.php">Trang cá nhân</a>
                            <a class="dropdown-item" href="../index.php">Trang chủ</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../../logout.php">Đăng xuất</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Bootstrap JavaScript dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>