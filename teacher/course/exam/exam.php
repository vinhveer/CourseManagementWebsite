<?php
include("layout.php");
$nav_id = isset($_GET['nav_id']) ? $_GET['nav_id'] : 1;

$course_id = $_SESSION['course_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài tập và kiểm tra</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <header class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <h3>Bài tập và kiểm tra</h3>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3 float-end">
                    <input type="text" class="form-control" placeholder="Tìm kiếm ..." aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-dark" type="button" id="button-addon2">Tìm</button>
                </div>
            </div>
        </div>
    </header>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <ul class="nav nav-tabs">
                    <?php
                    $tabs = ['Bài tập', 'Bài kiểm tra'];
                    for ($i = 1; $i <= count($tabs); $i++) {
                        echo '<li class="nav-item">
                        <a class="nav-link ' . ($nav_id == $i ? "active" : "") . '" href="exam.php?nav_id=' . $i . '">' . $tabs[$i - 1] . '</a>
                    </li>';
                    }
                    ?>
                </ul>
            </div>
            <div class="col-md-4">
                <a class="btn btn-primary float-end" href="create_exam.php">+ Tạo bài kiểm tra</a>
                <a class="btn btn-primary float-end me-2" href="create_practice.php">+ Tạo bài tập</a>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <?php
        switch ($nav_id) {
            case 1:
                echo '
                <table class="table">
                <thead>
                    <th>Tiêu đề</th>
                    <th>Thời gian mở</th>
                    <th>Thời gian đóng</th>
                    <th></th>
                </thead>';
                $sql_practice = "SELECT * FROM practice WHERE course_id = $course_id";
                $result_practice = mysqli_query($dbconnect, $sql_practice);

                // Loop through practice results and generate table rows
                while ($row = mysqli_fetch_array($result_practice)) {
                    echo '<tr>
                        <td>' . $row['description'] . '</td>
                        <td>' . date('d/m/Y', strtotime($row['open_time'])) . '</td>
                        <td>' . date('d/m/Y', strtotime($row['close_time'])) . '</td>
                        <td>
                            <a class="me-2" style="text-decoration: none;" href="#">Truy cập</a>
                            <a class="me-2" style="text-decoration: none;" href="#">Sửa</a>
                            <a style="text-decoration: none;" href="#">Xóa</a>
                        </td>
                        </tr>';
                }
                echo '</tbody></table>';
                break;

            case 2:
                echo '
                <table class="table">
                <thead>
                    <th>Tiêu đề</th>
                    <th>Thời gian mở</th>
                    <th>Thời gian đóng</th>
                    <th></th>
                </thead>
                <tbody>
                    <tr>
                        <td>Bài kiểm tra lấy điểm quá trình</td>
                        <td>01/01/2024</td>
                        <td>31/12/2024</td>
                        <td>
                            <a class="me-2" style="text-decoration: none;" href="#">Truy cập</a>
                            <a class="me-2" style="text-decoration: none;" href="#">Sửa</a>
                            <a style="text-decoration: none;" href="#">Xóa</a>
                        </td>
                    </tr>
                </tbody>
            </table>';
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