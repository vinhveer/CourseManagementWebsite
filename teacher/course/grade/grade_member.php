<?php
include_once('../../../config/connect.php');

session_start();

if (isset($_SESSION['course_id'])) {
    $course_id = $_SESSION['course_id'];
    $sql = "SELECT * FROM course_member
    INNER JOIN user ON course_member.student_id = user.user_id
    WHERE course_id = $course_id";
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
    <!-- Thêm mã JavaScript và thư viện jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        $(document).ready(function () {
            // Xử lý khi nút toggle được nhấp vào
            $('.toggle-button').click(function () {
                // Tìm hàng anh chị em hiện tại có lớp "score-details"
                var scoreDetailsRow = $(this).siblings('.score-details');
                // Bật tắt hiển thị của nó
                scoreDetailsRow.toggle();
                });
        });
    </script>
</head>

<body>

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
                                while ($row = mysqli_fetch_array($result_member)) {
                                    $sum_score += $row['score'] * $row['proportion'];
                                    $sum_proportion += $row['proportion'];
                                }

                                $result_average = $sum_score / $sum_proportion;
                                $rounded_result = number_format($result_average, 2);

                                echo $rounded_result;
                                ?>
                            </td>
                            <!-- Thêm nút toggle và thẻ div để chứa nội dung điểm -->
                            <td>
                                <button class="btn btn-info toggle-button">Hiện điểm</button>
                            </td>
                        </tr>
                        <tr class="score-details" style="display: none;">
                            <td colspan="5">
                                <?php
                                // Xử lý hiển thị điểm ở đây
                                echo '<h2>Điểm</h2>';
                                ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
