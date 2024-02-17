<?php
include('layout.php');
include_once('../../../config/connect.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['course_id'])) {
    $course_id = $_SESSION['course_id'];
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['timkiem'])) {
        $tukhoa = $_POST['tukhoa'];
        $keyword = strtolower(trim($tukhoa));
        $keyword = str_replace(' ', '', $keyword);
        $sql = "SELECT * FROM course_member
        INNER JOIN user ON course_member.student_id = user.user_id
        WHERE course_id = $course_id AND
        (LOWER(REPLACE(REPLACE(REPLACE(REPLACE(full_name, ' ', ''), 'Đ', 'D'),'đ','d'), ' ', '')) LIKE '%$keyword%' OR full_name LIKE '%$tukhoa%')";
        $result = mysqli_query($dbconnect, $sql);
    } else {
        $sql = "SELECT * FROM course_member
            INNER JOIN user ON course_member.student_id = user.user_id
            WHERE course_id = $course_id";
        $result = mysqli_query($dbconnect, $sql);
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
                <h3>Điểm số</h3>
            </div>
            <div class="col-md-6">
                <form class="d-flex" action="grade_member.php" method="POST">
                    <div class="input-group">
                        <input type="search" class="form-control me-2" placeholder="Tìm kiếm " name="tukhoa" aria-label="Tìm kiếm">
                        <button class="btn btn-outline-primary" type="submit" name="timkiem" value="find">Tìm kiếm</button><br>
                    </div>
                </form>
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

    <div class="container mt-4">
        <section class="mt-4">
            <table class="table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Họ và tên</th>
                        <th>Ngày sinh</th>
                        <th>Điểm trung bình</th>
                        <th>Chi tiết</th>
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
                            <td><?php echo $row['full_name']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($row['date_of_birth'])); ?></td>
                            <td>
                                <?php
                                $user_id = $row['user_id'];

                                $sql_member = "SELECT * FROM grade gr
                                                INNER JOIN grade_column gc ON gr.column_id = gc.column_id
                                                INNER JOIN course_member cm ON gr.member_id = cm.member_id
                                                WHERE cm.student_id = $user_id AND cm.course_id = $course_id";

                                $result_member = mysqli_query($dbconnect, $sql_member);

                                $sum_score = 0;
                                $sum_proportion = 0;
                                while ($row_member = mysqli_fetch_array($result_member)) {
                                    $sum_score += $row_member['score'] * $row_member['proportion'];
                                    $sum_proportion += $row_member['proportion'];
                                }

                                $result_average = ($sum_proportion != 0) ? $sum_score / $sum_proportion : 0;
                                $rounded_result = number_format($result_average, 2);

                                echo $rounded_result;
                                ?>
                            </td>
                            <!-- Thêm nút toggle và thẻ div để chứa nội dung điểm -->
                            <td>
                                <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapse<?php echo $index; ?>" aria-expanded="false" aria-controls="collapse<?php echo $index; ?>">
                                    Hiện điểm
                                </button>
                            </td>
                        </tr>
                        <tr class="collapse" id="collapse<?php echo $index; ?>">
                            <td colspan="5">
                                <div class="card card-body">
                                    <?php
                                    $sql_grade = "SELECT gc.grade_column_name, gc.proportion, gr.score FROM grade gr
                                                    INNER JOIN grade_column gc ON gr.column_id = gc.column_id
                                                    INNER JOIN course_member cm ON gr.member_id = cm.member_id
                                                    WHERE cm.student_id = $user_id AND cm.course_id = $course_id";
                                    $result_grade = mysqli_query($dbconnect, $sql_grade);
                                    echo '<table>';
                                    echo '<tr><th>STT</th><th>Tên cột điểm</th><th>Tỉ lệ tích lũy</th><th>Điểm số</th></tr>';
                                    $i = 1; // Start index from 1
                                    while ($row_grade = mysqli_fetch_array($result_grade)) {
                                        echo '<tr>';
                                        echo '<td>' . $i . '</td>';
                                        echo '<td>' . $row_grade['grade_column_name'] . '</td>';
                                        echo '<td>' . $row_grade['proportion'] . '</td>';
                                        echo '<td>' . $row_grade['score'] . '</td>';
                                        echo '</tr>';

                                        $i++;
                                    }
                                    echo '</table>';
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
