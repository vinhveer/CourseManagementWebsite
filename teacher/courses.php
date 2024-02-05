<?php
include('layout.php');
include_once('../config/connect.php');

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (isset($_SESSION['username'])) 
{
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM course WHERE teacher_id = $user_id";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Khóa học của tôi</title>
    <style>
    .custom-card {
        width: 100%;
        height: 0;
        padding-top: 50%;
        /* 4:5 aspect ratio (5/4 * 100) */
        position: relative;
    }

    .custom-card img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Đảm bảo ảnh không bị biến dạng */
    }
    </style>
</head>

<body>
        <header class="container mt-4">
            <div class="row">
                <div class="col-md-6">
                    <h2>Khóa học của tôi</h2>
                </div>
                <div class="col-md-6">
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Tìm kiếm" aria-label="Tìm kiếm">
                        <button class="btn btn-outline-primary" type="submit">Tìm</button>
                    </form>
                </div>
            </div>
        </header>

        <div class="container mt-5">
            <!-- Course Cards -->
            <div class="row">
                <?php
        // Đặt con trỏ kết quả về đầu để có thể duyệt lại từ đầu
        mysqli_data_seek($result, 0);

        while ($row = mysqli_fetch_array($result)) {
        ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="custom-card">
                            <img src="../assets/images/course1.jpg" class="card-img-top" alt="Course 1 Image">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['course_name'];?></h5>
                            <p class="card-text">
                                Mã khóa học: <?php echo $row['course_code'];?> <br>
                                Trạng thái: <?php echo ($row['status'] == "A") ? "Đã duyệt" : "Đang chờ duyệt";?>
                            </p>

                            <a class="btn btn-primary" href="course/index.php?id=<?php echo $row['course_id']; ?>">Truy
                                cập</a>
                        </div>
                    </div>
                </div>
                <?php
        }
        ?>
            </div>
        </div>
</body>
</html>