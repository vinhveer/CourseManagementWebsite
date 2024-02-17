<?php
include_once('layout.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Học Liệu</title>
    <!-- Sử dụng Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <header class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <h3>Nội dung khóa học</h3>
            </div>
            <div class="col-md-6 d-flex justify-content-end align-items-center">
               <form class="d-flex" action="content.php" method="POST" >
                    <div class="input-group">
                        <input type="search" class="form-control rounded-start" placeholder="Tìm kiếm học liệu ..." name="tukhoa">
                        <button class="btn btn-secondary rounded-end" type="submit" name="timkiem">Tìm kiếm</button>
                        <button class="btn btn-success ml-2 rounded-end rounded-start">Tạo chủ đề mới</button>
                    </div>
               </form>
            </div>
            <div class="col-md-12 d-flex justify-content-end align-items-center">
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
        </div>
    </header>

    <!-- Phần Body -->
    <div class="container mt-4">
        <!-- Chủ đề 1 -->
        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h4>Chủ đề 1: ...</h4>
                <button class="btn btn-warning">Sửa chủ đề</button>
            </div>
            <p>Nội dung của chủ đề 1</p>
        </div>

        <!-- Chủ đề 2 -->
        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h4>Chủ đề 2: ...</h4>
                <button class="btn btn-warning">Sửa chủ đề</button>
            </div>
            <p>Nội dung của chủ đề 2</p>
        </div>
    </div>

    <!-- Sử dụng Bootstrap JS và Popper.js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
