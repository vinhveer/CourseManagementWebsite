<?php
include('layout.php');
include_once('../config/connect.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['full_name']))
{
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM course co
    INNER JOIN course_member cm ON co.course_id = cm.course_id
    INNER JOIN course_schedule cs ON co.course_id = cs.course_id
    WHERE student_id = $user_id";
    $result = mysqli_query($dbconnect, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Thời khóa biểu</title>
</head>
<body>
    <div class="container mt-4">
        <h2>Thời khóa biểu</h2>
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Mã</th>
                    <th scope="col">Tên khóa học</th>
                    <th scope="col">Thứ</th>
                    <th scope="col">Thời gian</th>
                </tr>
            </thead>
            <tbody>
            <?php
            mysqli_data_seek($result, 0);

            while ($row = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?php echo $row['course_code']; ?></td>
                    <td><?php echo $row['course_name']; ?></td>
                    <td>Thứ <?php echo $row['day_of_week']; ?></td>
                    <td><?php echo $row['start_time']; ?> - <?php echo $row['end_time']; ?></td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>
