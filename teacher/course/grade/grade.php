<?php
include_once('../../../config/connect.php');

session_start();

$result = null;

if (isset($_SESSION['course_id'])) {
    $course_id = $_SESSION['course_id'];
    $sql = "SELECT * FROM grade_column WHERE course_id = $course_id";
    $result = mysqli_query($dbconnect, $sql);

    if (!$result) {
        die('Query failed: ' . mysqli_error($dbconnect));
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Điểm số và Năng lực</title>
    <style>
        .navbar {
            z-index: 1000;
        }

        body {
            padding-top: 70px; /* Adjusted to accommodate fixed navbar */
        }

        #content {
            padding-top: 70px; /* Adjusted to accommodate fixed navbar */
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Điểm số</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="loadContent('grade'); hideNavbar()">Điểm số</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="loadContent('member'); hideNavbar()">Thành viên</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <h2>Điểm số</h2>
            </div>
            <div class="col-md-6">
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Tìm kiếm" aria-label="Tìm kiếm">
                    <button class="btn btn-outline-primary" type="submit">Tìm</button>
                </form>
            </div>
        </div>
    </header>

    <div class="container mt-4">
        <section class="mt-4">
            <h4>Đanh sách các cột điểm</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã cột điểm</th>
                        <th>Tên cột điểm</th>
                        <th>Tỉ lệ tích lũy</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                // Đặt con trỏ kết quả về đầu để có thể duyệt lại từ đầu
                mysqli_data_seek($result, 0);

                $index = 0;
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td><?php $index++; echo $index;?></td>
                        <td><?php echo $row['column_id']?></td>
                        <td><?php echo $row['grade_column_name']?></td>
                        <td><?php echo $row['proportion']?></td>
                        <td><button class="btn btn-primary">Sửa cột điểm</button></td>
                    </tr>
                <?php 
                }
                ?>
                </tbody>
            </table>
        </section>

        <section class="mt-4">
            <h4>Tổng kết điểm tích lũy</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Dạng tích lũy</th>
                        <th>Tổng số điểm</th>
                        <th>Xem chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Thêm dữ liệu của bảng ở đây -->
                    <tr>
                        <td>1</td>
                        <td>Điểm cuối kỳ</td>
                        <td>80</td>
                        <td><button class="btn btn-primary">Xem chi tiết</button></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Điểm giữa kỳ</td>
                        <td>75</td>
                        <td><button class="btn btn-primary">Xem chi tiết</button></td>
                    </tr>
                    <!-- Thêm dữ liệu của bảng ở đây -->
                </tbody>
            </table>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
