<?php
include("layout.php");
include_once('../../config/connect.php');
$sql_course = "SELECT * FROM course WHERE course_id = $course_id";
$result = mysqli_query($dbconnect, $sql_course);
$row_course = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thay đổi ảnh bìa khóa học</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <header class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h3>Thay đổi ảnh bìa khóa học</h3>
            </div>
        </div>
    </header>

    <div class="container mt-5">
        <form id="changeCoverForm" action="process.php" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Tên Khóa học</label>
                <div class="col-sm-10">
                    <span class="form-control"><?php echo $row_course['course_name']?></span>
                    <input type="hidden" id="course_name" name="course_name" value="<?php echo $row_course['course_name']?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="new_cover" class="col-sm-2 col-form-label">Chọn ảnh bìa mới:</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="new_cover" name="new_cover" accept="image/*" required>
                    <div class="invalid-feedback" id="image-error">
                        Vui lòng chọn một tập tin ảnh (jpg, jpeg, png, gif) và kích thước tối đa 20MB.
                    </div>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-12 text-end">
                    <button type="submit" class="btn btn-primary" name="change_cover" id="submitBtn">Lưu</button>
                    <a type="button" class="btn btn-secondary" href="edit_course.php">Thoát</a>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-rqI2waM7CtpVHmUnY9NXfQTKc3N8RBLtbl6TbY3b3NC6HjbF2wF81v11z5KnMK17" crossorigin="anonymous"></script>

    <script>
        document.getElementById('changeCoverForm').addEventListener('submit', function(event) {
            var fileInput = document.getElementById('new_cover');
            var imageError = document.getElementById('image-error');

            var filePath = fileInput.value;
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            var maxSize = 20 * 1024 * 1024; // 20MB

            if (!allowedExtensions.exec(filePath) || fileInput.files[0].size > maxSize) {
                imageError.style.display = 'block';
                event.preventDefault();
                return false;
            } else {
                imageError.style.display = 'none';
            }
        });
    </script>
    <?php include("../../footer.php"); ?>
</body>
</html>
