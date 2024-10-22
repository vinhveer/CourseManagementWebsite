<?php
include_once('layout.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Bài tập và Kiểm tra</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="header">
                    <h2>Bài tập và Kiểm tra</h2>
                </div>
            </div>
            <div class="col-md-6">
                <form class="d-flex" action="exam.php" method="POST">
                    <div class="input-group mb-3">
                        <input type="search" class="form-control" placeholder="Tìm kiếm" name="tukhoa" aria-label="Tìm kiếm" aria-describedby="search-icon">
                        <button class="btn btn-primary rounded-end" type="submit" name="timkiem" value="find"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['timkiem'])) { ?>
                    <div class="row mt-3">
                        <div class="col">
                            <?php
                            $tukhoa = $_POST['tukhoa'];
                            echo "<p>Tìm kiếm với từ khóa: '<strong>$tukhoa</strong>'</p>"; ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="text-right">
                    <button class="btn btn-primary" type="button" onclick="loadContent('st_create_acc')">+ Tạo bài kiểm tra mới</button>
                </div>
                <div class="text-right">
                    <button class="btn btn-primary" type="button" onclick="loadContent('st_create_acc')">+ Tạo bài tập mới</button>
                </div>
                <div class="text-right">
                    <button class="btn btn-primary" type="button" onclick="loadContent('st_create_acc')">+ Tạo bài kiểm tra mới</button>
                </div>
                <div class="text-right">
                    <button class="btn btn-primary" type="button" onclick="loadContent('st_create_acc')">+ Tạo bài tập mới</button>
                </div>
            </div>
        </div>

        <div class="body mt-4">
            <!-- Bài kiểm tra trong tuần này -->
            <div class="card">
                <div class="card-header">
                    Bài kiểm tra trong tuần này
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Mã</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Ngày mở</th>
                                    <th scope="col">Ngày đóng</th>
                                    <th scope="col">Truy cập</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>KT001</td>
                                    <td>Kiểm tra 1</td>
                                    <td>2024-01-29</td>
                                    <td>2024-02-05</td>
                                    <td><a href="#" class="btn btn-primary">Truy cập</a></td>
                                </tr>
                                <!-- Thêm các bài kiểm tra khác tương tự ở đây -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Bài tập trong tuần này -->
            <div class="card mt-4">
                <div class="card-header">
                    Bài tập trong tuần này
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Mã</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Ngày mở</th>
                                    <th scope="col">Ngày đóng</th>
                                    <th scope="col">Truy cập</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>BT001</td>
                                    <td>Bài tập 1</td>
                                    <td>2024-01-30</td>
                                    <td>2024-02-06</td>
                                    <td><a href="#" class="btn btn-primary">Truy cập</a></td>
                                </tr>
                                <!-- Thêm các bài tập khác tương tự ở đây -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Bài tập và bài kiểm tra sắp tới -->
            <div class="card mt-4">
                <div class="card-header">
                    Bài tập và bài kiểm tra sắp tới
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Mã</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Ngày mở</th>
                                    <th scope="col">Ngày đóng</th>
                                    <th scope="col">Truy cập</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>KT002</td>
                                    <td>Kiểm tra 2</td>
                                    <td>2024-02-01</td>
                                    <td>2024-02-08</td>
                                    <td><a href="#" class="btn btn-primary">Truy cập</a></td>
                                </tr>
                                <tr>
                                    <td>BT002</td>
                                    <td>Bài tập 2</td>
                                    <td>2024-02-02</td>
                                    <td>2024-02-09</td>
                                    <td><a href="#" class="btn btn-primary">Truy cập</a></td>
                                </tr>
                                <!-- Thêm các bài tập và bài kiểm tra khác tương tự ở đây -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Bài tập và bài kiểm tra đã hoàn thành -->
            <div class="card mt-4">
                <div class="card-header">
                    Bài tập và bài kiểm tra đã hoàn thành
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Mã</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Ngày mở</th>
                                    <th scope="col">Ngày đóng</th>
                                    <th scope="col">Truy cập</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>KT003</td>
                                    <td>Kiểm tra 3</td>
                                    <td>2024-01-25</td>
                                    <td>2024-02-01</td>
                                    <td><a href="#" class="btn btn-primary">Truy cập</a></td>
                                </tr>
                                <tr>
                                    <td>BT003</td>
                                    <td>Bài tập 3</td>
                                    <td>2024-01-26</td>
                                    <td>2024-02-02</td>
                                    <td><a href="#" class="btn btn-primary">Truy cập</a></td>
                                </tr>
                                <!-- Thêm các bài tập và bài kiểm tra đã hoàn thành khác tương tự ở đây -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Script Bootstrap và jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
