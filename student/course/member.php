<?php
include_once('layout.php');
include_once('../../config/connect.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Initialize $result to avoid undefined variable warning
$result = null;

if (isset($_SESSION['course_id'])) {
    $course_id = $_SESSION['course_id'];
    $sql = "SELECT * FROM user us
    INNER JOIN course_member cm ON us.user_id = cm.student_id
    WHERE course_id = $course_id";
    $result = mysqli_query($dbconnect, $sql);

    if (!$result) {
        // Query execution failed
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
    <title>Danh sách thành viên</title>
</head>

<body>
    <header class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <h3>Danh sách thành viên</h3>
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
        <div class="row">
            <div class="">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>STT</th>
                            <th>Họ và tên</th>
                            <th>Ngày sinh</th>
                            <th>Giới tính</th>
                            <th>Email</th>
                            <th>Trang cá nhân</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result && mysqli_num_rows($result) > 0) {
                            
                            mysqli_data_seek($result, 0);
                            $index = 0;
                            while ($row = mysqli_fetch_array($result)) {
                                $student_id = $row['student_id'];
                        ?>
                        <tr>
                            <td><?php $index++; echo $index;?></td>
                            <td><?php echo $row['full_name'];?></td>
                            <td><?php echo date('d/m/Y', strtotime($row['date_of_birth'])); ?></td>
                            <td><?php echo ($row['gender'] == "M" ? "Nam" : "Nữ");?></td>
                            <td><?php echo $row['email'];?></td>
                            <td><a type="button" class="btn btn-primary" href="my_student.php?user_id=<?php echo $student_id?>">Xem chi tiết thông tin</td>
                        </tr>
                        <?php
                            }
                        } else {
                            echo '<tr><td colspan="7">No records found</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>