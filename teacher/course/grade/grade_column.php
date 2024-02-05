<?php
include('layout.php');
include_once('../../../config/connect.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


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
    <title>Điểm số</title>
</head>

<body>
    
    <header class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <h3>Danh sách các cột điểm</h3>
            </div>
            <div class="col-md-6">
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Tìm kiếm theo tên ..." aria-label="Tìm kiếm">
                    <button class="btn btn-outline-primary" type="submit">Tìm</button>
                </form>
            </div>
        </div>
    </header>

    <div class="container mt-4">
        <section class="mt-4">
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
                            <td><?php echo ++$index; ?></td>
                            <td><?php echo $row['column_id']; ?></td>
                            <td><?php echo $row['grade_column_name']; ?></td>
                            <td><?php echo $row['proportion']; ?></td>
                            <td><button class="btn btn-primary">Sửa thuộc tính</button></td>
                            <td><button class="btn btn-primary">Nhập điểm cho cột này</button></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>
</body>

</html>
