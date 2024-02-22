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
    <form class="form-group" action="process.php" method="post" enctype="multipart/form-data">
        <header class="container mt-4">
            <div class="row">
                <div class="col-md-6">
                    <h3>
                        <a href="exam.php"><i class="bi bi-arrow-left-circle"></i></a>
                        Tạo bài tập mới
                    </h3>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary float-end" type="submit" name="create_practice">Lưu nội dung</button>
                </div>
            </div>
        </header>

        <div class="container mt-4">
            <div class="mb-3">  
                <label for="title_practice" class="form-label">Tiêu đề bài tập</label>
                <input type="text" class="form-control" id="title_practice" name="title_practice">
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="open_date" class="form-label">Ngày mở bài tập</label>
                            <input type="date" class="form-control" id="open_date" name="open_date">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="close_date" class="form-label">Ngày đóng bài tập</label>
                            <input type="date" class="form-control" id="close_date" name="close_date">
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="content_practice" class="form-label">Nội dung bài tập</label>
                <textarea class="form-control" id="content_practice" name="content_practice"></textarea>
            </div>
            <div class="mb-3">
                <label for="upload_file" class="form-label">Tải lên file (Nếu có)</label>
                <input type="file" class="form-control" id="upload_file" name="upload_file">
            </div>
            <div class="mb-3">
                <label for="type_submit" class="form-label">Hình thức nộp bài</label>
                <select class="form-select" aria-label="type_submit" name="type_submit">
                    <option selected>Không nộp nội dung</option>
                    <option value="1">Tải file lên hệ thống</option>
                    <option value="2">Nhập vào dạng text</option>
                </select>
            </div>
        </div>

    </form>

    <?php include("../../footer.php"); ?>
</body>

</html>