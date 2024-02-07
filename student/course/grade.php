<?php
include("layout.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$course_id = $_SESSION['course_id'];
$student_id = $_SESSION['user_id'];

$sql_grade = "SELECT * FROM grade gr
INNER JOIN grade_column gc ON gr.column_id = gc.column_id
INNER JOIN course_member cm ON gr.member_id = cm.member_id
WHERE cm.course_id = $course_id AND cm.student_id = $student_id";
$result_grade = mysqli_query($dbconnect, $sql_grade);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Điểm số</title>
</head>

<body>
    <header class="container mt-4">
        <h3>Điểm số của bạn trong học phần này</h3>
    </header>
    <div class="container mt-4">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên cột điểm</th>
                    <th scope="col">Tỉ lệ tích lũy</th>
                    <th scope="col">Số điểm</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $sum_score = 0;
                $sum_proportion = 0;
                while ($row_grade = mysqli_fetch_array($result_grade))
                {
                    $score_temp = $row_grade['score'];
                    $proportion_temp = $row_grade['proportion'];
                    $sum_score += $score_temp * $proportion_temp;
                    $sum_proportion += $proportion_temp;

                ?>
                <tr>
                    <th scope="row"><?php $i++; echo $i;?></th>
                    <td><?php echo $row_grade['grade_column_name']?></td>
                    <td><?php echo $row_grade['proportion']?></td>
                    <td><?php echo $score_temp?></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <th>Điểm trung bình</th>
                    <td>
                    <?php 
                    $rounded_result = number_format($sum_score / $sum_proportion, 2);
                    echo $rounded_result;
                    ?>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>