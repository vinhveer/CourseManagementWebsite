<?php
include("layout.php");
include_once('../config/connect.php');
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['timkiem'])) {
    $tukhoa = $_GET['tukhoa'];
    $keyword = strtolower(trim($tukhoa));
    $keyword = str_replace(' ', '', $keyword);
    $sql_course_n = "SELECT * FROM course c
    INNER JOIN user us ON c.teacher_id = us.user_id
    WHERE c.status = 'N' AND
    (LOWER(REPLACE(REPLACE(REPLACE(REPLACE(c.course_name, ' ', ''), 'Đ', 'D'),'đ','d'), ' ', '')) LIKE '%$keyword%' OR c.course_name LIKE '%$tukhoa%')";
    $result_course_n = mysqli_query($dbconnect, $sql_course_n);
}else{
    $sql_course_n = "SELECT * FROM course
    INNER JOIN user ON course.teacher_id = user.user_id
    WHERE status = 'N'";
    $result_course_n = mysqli_query($dbconnect, $sql_course_n);
}
mysqli_close($dbconnect);
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
                <h3>Khóa học (Chưa duyệt)</h3>
            </div>
            <div class="col-md-5">
               <form action="courses.php" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Tìm kiếm..." name="tukhoa">
                        <button class="btn btn-secondary rounded-end" type="submit" name="timkiem" value="find">Tìm kiếm</button>
                    </div>
               </form>
            </div>
            <div class="col-md-2 text-right">
                <a class="btn btn-primary rounded-end rounded-start" type="button" href="course_add.php">Thêm khóa học mới</a>
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
                        <a class="btn btn-info btn-sm" onclick="return Apo('<?php echo $row_course_n['course_name']; ?>')" href="pross/c_approve.php?id=<?php echo $row_course_n['course_id'];?>">Duyệt</a>
                        <a class="btn btn-danger btn-sm" onclick="return Del('<?php echo $row_course_n['course_name']; ?>')" href="pross/c_not_approve.php?id=<?php echo $row_course_n['course_id'];?>">Không duyệt</a>
                        <a class="btn btn-info btn-sm" href="course_show.php?id=<?php echo $row_course_n['course_id']; ?>&teacher_id=<?php echo $row_course_n['teacher_id']; ?>">Chi tiết</a>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        </div>
    </div>
    <script>
    function Del(name){
        return confirm("Bạn có chắc chắn muốn từ bỏ khóa học: " + name +  " ?");
    }
    </script>
    <script>
    function Apo(name){
        return confirm("Bạn có chắc chắn muốn duyệt khóa học: " + name +  " ?");
    }
    </script>
</body>

</html>
