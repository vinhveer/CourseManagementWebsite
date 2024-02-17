<?php
include("layout.php");
include_once('../../config/connect.php');

$sql_course = "SELECT * FROM course WHERE course_id = $course_id";
$result = mysqli_query($dbconnect, $sql_course);

while ($row_course = mysqli_fetch_array($result)) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
        <title>Chỉnh sửa thuộc tính khóa học</title>
    </head>

    <body>
        <header class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <h3>Chỉnh sửa thuộc tính khóa học</h3>
                </div>
                <div class="col-md-6">
                    <a type="button" class="btn btn-primary float-end" href="change_background.php">Thay đổi ảnh bìa</a>
                </div>
            </div>
        </header>
        <div class="container mt-5">
            <form id="createCourseForm" action="process.php" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                <div class="mb-3 row">
                    <label for="course_name" class="col-sm-2 col-form-label">Tên khóa học</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="course_name" name="course_name" value="<?php echo $row_course['course_name'] ?>" maxlength="225" required>
                        <div class="invalid-feedback">
                            Tên khóa học không được trống và tối đa 225 ký tự.
                        </div>
                    </div>
                    <label for="course_code" class="col-sm-2 col-form-label">Mã khóa học</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="course_code" name="course_code" value="<?php echo $row_course['course_code'] ?>" maxlength="6" required>
                        <div class="invalid-feedback">
                            Mã khóa học không được trống và tối đa 6 ký tự.
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="course_description" class="col-sm-2 col-form-label">Mô tả khóa học</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="course_description" name="course_description" rows="5"><?php echo $row_course['course_description']; ?></textarea>
                        <div class="invalid-feedback">
                            Mô tả khóa học không được trống.
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="start_date" class="col-sm-2 col-form-label">Ngày bắt đầu</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo $row_course['start_date'] ?>" required>
                    </div>
                    <label for="end_date" class="col-sm-2 col-form-label">Ngày kết thúc</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo $row_course['end_date'] ?>" required>
                    </div>
                </div>
            <?php
        }
            ?>
            <div class="mb-3 row">
                <div class="col-sm-12 text-end">
                    <button type="submit" class="btn btn-primary" name="edit_course">Lưu</button>
                    <a type="button" class="btn btn-secondary" href="index.php?id=2">Thoát</a>
                </div>
            </div>
            </form>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-rqI2waM7CtpVHmUnY9NXfQTKc3N8RBLtbl6TbY3b3NC6HjbF2wF81v11z5KnMK17" crossorigin="anonymous">
        </script>
        <script>
            // Enable Bootstrap form validation
            (function() {
                'use strict';

                var forms = document.querySelectorAll('.needs-validation');

                Array.prototype.slice.call(forms)
                    .forEach(function(form) {
                        form.addEventListener('submit', function(event) {
                            if (!form.checkValidity()) {
                                event.preventDefault();
                                event.stopPropagation();
                            }

                            form.classList.add('was-validated');
                        }, false);
                    });
            })();
        </script>

    </body>

    </html>
