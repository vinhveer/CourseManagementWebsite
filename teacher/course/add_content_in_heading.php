<?php
include('layout.php');

$nav_id = isset($_GET['nav_id']) ? $_GET['nav_id'] : 1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Tạo nội dung mới</title>
</head>

<body>
    <header class="container mt-4">
        <h3>
            <a href="content.php"><i class="bi bi-arrow-left-circle"></i></a>
            Tạo chủ đề mới
        </h3>
    </header>
    <div class="container mt-4">
        <ul class="nav nav-tabs">
            <?php
            $tabs = ['Tải lên video', 'Nhúng video', 'Tập tin', 'Nội dung văn bản'];
            for ($i = 1; $i <= count($tabs); $i++) {
                echo '<li class="nav-item">
                        <a class="nav-link ' . ($nav_id == $i ? "active" : "") . '" href="add_content_in_heading.php?nav_id=' . $i . '">' . $tabs[$i - 1] . '</a>
                    </li>';
            }
            ?>
        </ul>
    </div>
    <div class="container mt-4">
        <?php
        switch ($nav_id) {
            case 1:
                echo '
                    <form action="process.php" method="post" class="row g-3">
                        <div class="col-12">
                            <label for="file_title" class="form-label">Tiêu đề bài học</label>
                            <input type="text" class="form-control" id="file_title">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress2" class="form-label">Mô tả bài học</label>
                            <input type="textarea" class="form-control" id="inputAddress2">
                        </div>
                        <div class="col-12">
                            <label for="inputCity" class="form-label">Tải lên file video</label>
                            <input type="file" class="form-control" id="inputCity">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Lưu nội dung</button>
                        </div>
                    </form>';
                break;

            case 2:
                echo '
                    <form action="process.php" method="post" class="row g-3">
                        <div class="col-12">
                            <label for="file_title" class="form-label">Tiêu đề bài học</label>
                            <input type="text" class="form-control" id="file_title">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress2" class="form-label">Mô tả bài học</label>
                            <input type="textarea" class="form-control" id="inputAddress2">
                        </div>
                        <div class="col-12">
                            <label for="inputCity" class="form-label">Dán mã nhúng vào đây</label>
                            <textarea class="form-control" id="inputCity"></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Lưu nội dung</button>
                        </div>
                    </form>';
                break;

            case 3:
                echo '
                    <form action="process.php" method="post" class="row g-3">
                        <div class="col-12">
                            <label for="file_title" class="form-label">Tiêu đề bài học</label>
                            <input type="text" class="form-control" id="file_title">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress2" class="form-label">Mô tả bài học</label>
                            <input type="textarea" class="form-control" id="inputAddress2">
                        </div>
                        <div class="col-12">
                            <label for="inputCity" class="form-label">Tải lên tập tin</label>
                            <input type="file" class="form-control" id="inputCity">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Lưu nội dung</button>
                        </div>
                    </form>';
                break;

            case 4:
                echo '
                    <form action="process.php" method="post" class="row g-3">
                        <div class="col-12">
                            <label for="file_title" class="form-label">Tiêu đề bài học</label>
                            <input type="text" class="form-control" id="file_title">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress2" class="form-label">Mô tả bài học</label>
                            <input type="textarea" class="form-control" id="inputAddress2">
                        </div>
                        <div class="col-12">
                            <label for="inputCity" class="form-label">Nội dung (Dạng text)</label>
                            <textarea class="form-control" id="inputCity"></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Lưu nội dung</button>
                        </div>
                    </form>';
                break;

            default:
                // Handle default case here if needed
                break;
        }
        ?>
    </div>
    <?php include("../../footer.php"); ?>
</body>

</html>