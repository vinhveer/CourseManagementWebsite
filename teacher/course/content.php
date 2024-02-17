<?php
include_once('layout.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nội dung khóa học</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <header class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <h3>Nội dung khóa học</h3>
            </div>
            <div class="col-md-4">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Tìm kiếm ..." aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-dark" type="button" id="button-addon2">Tìm</button>
                </div>
            </div>
            <div class="col-md-2">
                <a class="btn btn-primary float-end" href="add_content_heading.php">+ Tạo chủ đề mới</a>
            </div>
        </div>
    </header>
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title">Card title</h4>
                    </div>
                    <div class="col-md-6">
                        <a type="button" class="btn btn-primary float-end" href="add_content_in_heading.php">+ Thêm nội dung mới</a>
                    </div>
                </div>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <table class="table">
                    <tbody>
                        <td>Phần 1: Giới thiệu về C++ và C#</td>
                        <td>Bài giảng video</td>
                        <td>Thời gian: 9 phút</td>
                        <td>
                            <a class="float-end">Truy cập nội dung</a>
                        </td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include("../../footer.php"); ?>
</body>

</html>