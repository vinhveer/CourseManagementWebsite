<?php
include("layout.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$student_id = $_SESSION['user_id'];

$sql_course = "SELECT * FROM course co
INNER JOIN course_member cm ON co.course_id = cm.course_id
INNER JOIN course_schedule cs ON co.course_id = cs.course_id
WHERE student_id = $student_id";
$result_course = mysqli_query($dbconnect, $sql_course);
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
        <h3>Bảng điểm</h3>
    </header>
    <?php
    while ($row_course = mysqli_fetch_array($result_course))
    {
        $course_id = $row_course['course_id'];
        $sql_grade = "SELECT * FROM grade gr
        INNER JOIN grade_column gc ON gr.column_id = gc.column_id
        INNER JOIN course_member cm ON gr.member_id = cm.member_id
        WHERE cm.course_id = $course_id AND cm.student_id = $student_id";
        $result_grade = mysqli_query($dbconnect, $sql_grade);
    ?>
    <div class="container mt-4">
        <h5>
            
        </h5>
    </div>
    <div class="container mt-4">
        <h5><?php echo "Khóa học: " . $row_course['course_name'] . " - " . $row_course['course_code']?></h5>
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
    <?php
    }
    ?>
</body>

</html>