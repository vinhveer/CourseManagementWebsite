<?php
include("layout.php");
include_once('../config/connect.php');
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['timkiem'])) {
    $tukhoa = $_POST['tukhoa'];
    $keyword = strtolower(trim($tukhoa));
    $keyword = str_replace(' ', '', $keyword);
    $sql_course_n = "SELECT * FROM course c
    INNER JOIN user us ON c.teacher_id = us.user_id
    WHERE c.status = 'N' AND
    (LOWER(REPLACE(REPLACE(REPLACE(REPLACE(c.course_name, ' ', ''), 'Đ', 'D'),'đ','d'), ' ', '')) LIKE '%$keyword%' OR c.course_name LIKE '%$tukhoa%')";
    $result_course_n = mysqli_query($dbconnect, $sql_course_n);
} else {
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
                <form action="courses.php" method="POST">
                    <div class="input-group">
                        <input type="search" class="form-control" placeholder="Tìm kiếm..." name="tukhoa">
                        <button class="btn btn-secondary rounded-end" type="submit" name="timkiem" value="find">Tìm kiếm</button>
                    </div>
                </form>
                <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['timkiem'])) { ?>
                    <div class="row mt-3">
                        <div class="col">
                            <?php
                            $tukhoa = $_POST['tukhoa'];
                            echo "<p>Tìm kiếm với từ khóa: '<strong>$tukhoa</strong>'</p>";
                            ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="col-md-2 text-right">
                <a class="btn btn-primary rounded-end rounded-start" type="button" href="course_add.php">Thêm khóa học mới</a>
            </div>
        </div>
    </header>

    <div class="container mt-5">
        <div class="row">
            <?php
            while ($row_course_n = mysqli_fetch_array($result_course_n)) {
            ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="custom-card">
                            <img src="../assets/file/course_background/<?php echo $row_course_n['course_background'] ?>" class="card-img-top" alt="Course 1 Image">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row_course_n['course_name'] ?></h5>
                            <p class="card-text">
                                Mã khóa học: <?php echo $row_course_n['course_code']; ?> <br>
                                Trạng thái: <?php echo ($row_course_n['status'] == "A") ? "Đã duyệt" : "Đang chờ duyệt"; ?>
                            </p>
                            <button type="button" class="btn btn-info btn-sm" data-postid="<?php echo $row_course_n['course_id']; ?>" data-bs-toggle="modal" data-bs-target="#approveCourseModal">Duyệt</button>
                            <button type="button" class="btn btn-danger btn-sm" data-postid="<?php echo $row_course_n['course_id']; ?>" data-bs-toggle="modal" data-bs-target="#deleteCourseModal">Không duyệt</button>
                            <a class="btn btn-info btn-sm" href="course_show.php?id=<?php echo $row_course_n['course_id']; ?>&teacher_id=<?php echo $row_course_n['teacher_id']; ?>">Chi tiết</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="modal fade" id="approveCourseModal" tabindex="-1" aria-labelledby="approveCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveCourseModalLabel">Xác nhận duyệt khóa học</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn duyệt khóa học này?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <form id="approvePostForm" action="" method="post">
                        <button type="submit" class="btn btn-danger" name="approve_course">Xác nhận</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteCourseModal" tabindex="-1" aria-labelledby="deleteCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCourseModalLabel">Xác nhận xóa khóa học</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa khóa học này?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <form id="deletePostForm" action="" method="post">
                        <button type="submit" class="btn btn-danger" name="delete_course">Xóa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const approveButtons = document.querySelectorAll('.btn.btn-info.btn-sm');
            approveButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const courseId = this.getAttribute('data-postid');
                    const form = document.querySelector('#approvePostForm');
                    form.action = `process.php?course_id=${courseId}&action=approve`;
                });
            });
            const deleteButtons = document.querySelectorAll('.btn.btn-danger.btn-sm');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const courseId = this.getAttribute('data-postid');
                    const form = document.querySelector('#deletePostForm');
                    form.action = `process.php?course_id=${courseId}&action=delete`;
                });
            });
        });
    </script>
        <?php include("../footer.php"); ?>
</body>

</html>
