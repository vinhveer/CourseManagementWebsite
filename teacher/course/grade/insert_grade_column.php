<?php
include('layout.php');
include_once('../../../config/connect.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Function to escape HTML for preventing XSS attacks
function escapeHTML($value)
{
    if (is_array($value)) {
        return implode(", ", $value);
    } else {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}

if (isset($_GET['id'])) {
    $column_id = $_GET['id'];
    $_SESSION['column_id'] = $column_id;
} else {
    $column_id = $_SESSION['column_id'];
}

if (isset($_SESSION['course_id'])) {
    $course_id = $_SESSION['course_id'];

    $sql = "SELECT user.full_name, user.date_of_birth, user.gender, grade.score, course_member.member_id
            FROM course_member
            INNER JOIN user ON course_member.student_id = user.user_id
            INNER JOIN grade ON course_member.member_id = grade.member_id
            INNER JOIN grade_column ON grade.column_id = grade_column.column_id
            WHERE grade_column.course_id = $course_id AND grade_column.column_id = $column_id";

    $result = mysqli_query($dbconnect, $sql);
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
            <div class="col-md-8">
                <h3>Điểm số</h3>
            </div>
            <div class="col-md-4 d-flex align-items-center justify-content-end">
                <form class="d-flex">
                    <input class="form-control me-2 float-end" type="search" placeholder="Tìm kiếm" aria-label="Tìm kiếm">
                    <button class="btn btn-outline-primary float-end" type="submit">Tìm</button>
                </form>
            </div>
        </div>
    </header>
    <form action="process.php" method="post">
        <div class="container mt-4">
            <div class="row mt-2">
                <div class="col-md-8">
                    <a href="#" class="btn btn-primary me-2">Nhập từ file excel</a>
                    <a href="#" class="btn btn-primary">Lấy điểm từ bài kiểm tra hoặc bài tập</a>
                </div>
                <div class="col-md-4">
                    <button type="submit" name="submit_grade_member" class="btn btn-primary me-2 float-end">Lưu điểm vừa nhập</button>
                </div>
            </div>
        </div>
        <div class="container mt-4">
            <section class="mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Họ và tên</th>
                            <th>Ngày sinh</th>
                            <th>Giới tính</th>
                            <th>Điểm số</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        mysqli_data_seek($result, 0);

                        $index = 0;
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td><?php echo ++$index; ?></td>
                                <td><?php echo $row['full_name']; ?></td>
                                <td><?php echo date('d/m/Y', strtotime($row['date_of_birth'])); ?></td>
                                <td><?php echo ($row['gender'] == "M" ? "Nam" : "Nữ"); ?></td>
                                <td>
                                    <input type="text" class="form-control" name="score[]" value="<?php echo $row['score']; ?>">
                                    <input type="hidden" name="member_id[]" value="<?php echo escapeHTML($row['member_id']); ?>">
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>