<?php
include("layout.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo bài tập mới</title>
</head>

<body>
    <header class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <h3>Tạo bài tập mới</h3>
            </div>
            <div class="col-md-6">
                <a class="btn btn-primary float-end me-2" href="add_content_heading.php">Lưu nội dung</a>
            </div>
        </div>
    </header>

    <div class="container mt-4">
        <form class="form-group" action="" method="post">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tiêu đề bài tập</label>
                <input type="email" class="form-control" id="exampleFormControlInput1">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nội dung bài tập</label>
                <textarea class="form-control" id="exampleFormControlInput1"></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tải lên file (Nếu có)</label>
                <input type="file" class="form-control" id="exampleFormControlInput1">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Hình thức nộp bài</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Không nộp nội dung</option>
                    <option value="1">Tải file lên hệ thống</option>
                    <option value="2">Nhập vào dạng text</option>
                </select>
            </div>
        </form>
    </div>

    <?php include("../../footer.php"); ?>
</body>

</html>