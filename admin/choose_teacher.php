<?php
include "layout.php";
include_once "../config/connect.php";
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (isset($_GET['role'])) {
  $role = $_GET['role'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['timkiem'])) {
  $tukhoa = $_POST['tukhoa'];
  $keyword = strtolower(trim($tukhoa));
  $keyword = str_replace(' ', '', $keyword);
  $sql_course = "SELECT * FROM user us
      INNER JOIN user_role ur ON us.user_id = ur.user_id
      WHERE ur.role_id = 2 AND
      (LOWER(REPLACE(REPLACE(REPLACE(us.full_name, ' ', ''), 'Đ', 'D'), ' ', '')) LIKE '%$keyword%' OR us.full_name LIKE '%$tukhoa%')";
  $result = mysqli_query($dbconnect, $sql_course);
} else {
  $sql_course = "SELECT * FROM user us
  INNER JOIN user_role ur ON us.user_id = ur.user_id where ur.role_id=2";
  $result = mysqLi_query($dbconnect, $sql_course);
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sbm"])) {
  $id = $_GET['id'];
  $role = $_GET['role'];
  $_SESSION['teacher_course'] = $_POST['sbm'];
  if ($role == 'add') {
    header("location: schedule_add.php");
  } else {
    header("location: schedule_edit.php?id=$id");
  }
  exit;
}
mysqli_close($dbconnect);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <title>Các khóa học khác</title>
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
  <header class="container mt-4">
    <h3><a href="<?php echo ($role == 'add') ? "course_add" : "course_edit" ?>.php"><i class="bi bi-arrow-left-circle"></i></a></h3>
    <div class="row">
      <div class="col-md-6">
        <h2>Danh sách giáo viên</h2>
      </div>
      <div class="col-md-6">
        <form class="d-flex" action="choose_teacher.php" method="POST">
          <input class="form-control me-2" type="search" placeholder="Tìm kiếm" aria-label="Tìm kiếm" name="tukhoa" value="">
          <button class="btn btn-outline-primary" type="submit" name="timkiem" value="find">Tìm</button>
        </form>
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['timkiem'])) { ?>
          <div class="row mt-3">
            <div class="col">
              <?php $tukhoa = $_POST['tukhoa'];
              echo "<p>Tìm kiếm với từ khóa: '<strong>$tukhoa</strong>'</p>"; ?>
            </div>
          </div>
        <?php } ?>
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
                <img src=<?php echo "../assets/images/" . $row['image'] ?> class="card-img-top" alt="Course 1 Image">
              </div>
              <div class="card-body">
                <h5 class="card-title"><?php echo $row['full_name']; ?></h5>
                <button class="btn btn-primary" type="submit" name="sbm" value="<?php echo $row['user_id'] ?>">Chọn</button>
              </div>
            </div>
          </div>
        <?php
        }
        ?>
      </div>
    </form>
  </div>
  <?php include("../footer.php"); ?>
</body>

</html>
