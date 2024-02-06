<?php 
include("layout.php");
include_once('../config/connect.php');

$sql_course_n = "SELECT * FROM course
INNER JOIN user ON course.teacher_id = user.user_id
WHERE status = 'N'";
$result_course_n = mysqli_query($dbconnect, $sql_course_n);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Khóa học chưa duyệt</title>
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
            <div class="col-md-5">
                <h3>Khóa học chưa duyệt</h3>
            </div>
            <div class="col-md-5">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Tìm kiếm...">
                    <button class="btn btn-secondary rounded-end" type="button">Tìm kiếm</button>
                </div>
            </div>
            <div class="col-md-2 text-right">
                <button class="btn btn-primary rounded-end rounded-start" type="button">Thêm khóa học mới</button>
            </div>
        </div>
    </header>

    <div class="container mt-5">
        <div class="row">
        <?php 
        while ($row_course_n = mysqli_fetch_array($result_course_n))
        {
        ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="custom-card">
                        <img src="../assets/images/course1.jpg" class="card-img-top" alt="Course 1 Image">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row_course_n['course_name']?></h5>
                        <p class="card-text">
                            Mã khóa học: <?php echo $row_course_n['course_code'];?> <br>
                            Trạng thái: <?php echo ($row_course_n['status'] == "A") ? "Đã duyệt" : "Đang chờ duyệt";?>
                        </p>
                        <a class="btn btn-primary" href="course/index.php?id=<?php echo $row['course_id']; ?>">Duyệt</a>
                        <a class="btn btn-primary" href="course/index.php?id=<?php echo $row['course_id']; ?>">Không duyệt</a>
                        <a class="btn btn-primary" href="course/index.php?id=<?php echo $row['course_id']; ?>">Chi tiết</a>
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
