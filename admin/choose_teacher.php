<?php
include("layout.php");
include_once("../config/connect.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['timkiem'])) {
  $tukhoa = $_GET['tukhoa'];
  $keyword = strtolower(trim($tukhoa));
  $keyword = str_replace(' ', '', $keyword);
  $sql_course = "SELECT * FROM user us
      INNER JOIN user_role ur ON us.user_id = ur.user_id
      WHERE ur.role_id = 2 AND
      (LOWER(REPLACE(REPLACE(REPLACE(us.full_name, ' ', ''), 'Đ', 'D'), ' ', '')) LIKE '%$keyword%' OR us.full_name LIKE '%$tukhoa%')";
  $result = mysqli_query($dbconnect, $sql_course);
}
else{
  $sql_course = "SELECT * FROM user us
  INNER JOIN user_role ur ON us.user_id = ur.user_id where ur.role_id=2";
  $result = mysqLi_query($dbconnect, $sql_course);
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sbm"])) {
    $_SESSION['teacher_course'] = $_POST['sbm'];
     header("location: schedule_add.php");
     exit;
}
mysqli_close($dbconnect);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <title>Các khóa học khác</title>
  <style>
    .custom-card {
      width: 100%;
      height: 0;
      padding-top: 50%;
      /* 4:5 aspect ratio (5/4 * 100) */
      position: relative;
    }

    .custom-card img {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      /* Đảm bảo ảnh không bị biến dạng */
    }
  </style>
</head>

<body>


  <header class="container mt-4">
      <div class="row">
        <div class="col-md-6">
          <h2>Danh sách giáo viên</h2>
        </div>
        <div class="col-md-6">
          <form class="d-flex" action="choose_teacher.php" method="GET">
                <input class="form-control me-2" type="search" placeholder="Tìm kiếm" aria-label="Tìm kiếm" name="tukhoa"value="">
                <button class="btn btn-outline-primary" type="submit" name="timkiem" value="find">Tìm</button>
          </form>
        </div>
      </div>
  </header>

  <div class="container mt-5">
    <!-- Course Cards -->
    <form method="post">
        <div class="row">
            <?php
            // Đặt con trỏ kết quả về đầu để có thể duyệt lại từ đầu
            mysqli_data_seek($result, 0);
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <div class="col-md-3 mb-2">
                    <div class="card">
                        <div class="custom-card">
                            <img src=<?php echo "../assets/images/" . $row['image']?> class="card-img-top" alt="Course 1 Image">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['full_name'];?></h5>
                            <button class="btn btn-primary" type="submit" name="sbm" value="<?php echo $row['user_id']?>">Chọn</button>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </form>
  </div>
</body>

</html>
