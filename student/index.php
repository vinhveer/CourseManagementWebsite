<?php
include_once('layout.php');
include_once('../config/connect.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['username'])) 
{
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM user WHERE user_id = $user_id";
    $result = mysqli_query($dbconnect, $sql);
} 
else 
{
    $username_now = "User not logged in";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Trang chủ</title>
    <style>
    .custom-card {
        width: 100%;
        height: 0;
        padding-top: 50%;
        position: relative;
    }

    .custom-card img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    </style>
</head>

<body>
    <?php
        $row = mysqli_fetch_assoc($result)
    ?>
    <header class="container mt-4">
        <h3>Xin chào, <?php echo $row['full_name'];?></h3>
    </header>

    <div class="container mt-5">
        <h5>Khóa học hôm nay</h5>

        <?php
        $dayOfWeekNumber = date("N");

        // Query to check if there are courses for the current day
        $sql = "SELECT * FROM course co
        INNER JOIN course_member cm ON co.course_id = cm.course_id
        INNER JOIN course_schedule cs ON co.course_id = cs.course_id
        WHERE student_id = $user_id AND day_of_week = $dayOfWeekNumber";
        
        $result = mysqli_query($dbconnect, $sql);
        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0) {
            // Display courses
        ?>
        <div class="row">
            <?php
                mysqli_data_seek($result, 0);
                while ($row = mysqli_fetch_array($result)) {
                ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="custom-card">
                        <img src="../assets/images/course1.jpg" class="card-img-top" alt="Course 1 Image">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['course_name'];?></h5>
                        <p class="card-text">
                            Mã khóa học: <?php echo $row['course_code'];?> <br>
                            Thời gian: Từ <?php echo $row['start_time'] . " đến " . $row['end_time']?>
                        </p>

                        <a class="btn btn-primary" href="course/index.php?id=<?php echo $row['course_id']; ?>">Truy
                            cập</a>
                    </div>
                </div>
            </div>
            <?php
                }
                ?>
        </div>
        <?php
        } else {
        ?>
        <p>Không có khóa học nào trong hôm nay.</p>
        <?php
        }
        ?>
    </div>
</body>

</html>