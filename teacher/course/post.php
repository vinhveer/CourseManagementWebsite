<?php
include("layout.php");
include_once('../../config/connect.php');

$course_id = $_SESSION['course_id'];

$sql_post = "SELECT * FROM post WHERE course_id = $course_id;";
$result_post = mysqli_query($dbconnect, $sql_post);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bài đăng</title>
</head>

<body>
  <header class="container mt-4">
    <div class="row">
      <div class="col-md-6">
        <h3>Bài đăng</h3>
      </div>
      <div class="col-md-4">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Tìm kiếm ..." aria-label="Recipient's username" aria-describedby="button-addon2">
          <button class="btn btn-dark" type="button" id="button-addon2">Tìm</button>
        </div>
      </div>
      <div class="col-md-2">
        <a class="btn btn-primary float-end" href="create_post.php">+ Tạo bài đăng mới</a>
      </div>
    </div>
  </header>
  <div class="container mt-4">
    <table class="table">
      <thead>
        <th>Tên bài viết</th>
        <th>Tác giả</th>
        <th>Ngày tạo</th>
        <th></th>
      </thead>
      <tbody>
        <?php
        while ($row_post = mysqli_fetch_array($result_post)) {
          $user_id = $row_post['user_id'];
          $sql_user = "SELECT * FROM user WHERE user_id = $user_id";
          $result_user = mysqli_query($dbconnect, $sql_user);
          $row_user = mysqli_fetch_assoc($result_user);
          $full_name = $row_user['full_name'];
          $image = $row_user['image'];
        ?>
          <tr>
            <td><?php echo $row_post['title']; ?></td>
            <td>
              <span><?php echo $full_name; ?></span>
              <img src="<?php echo "../" . $image ?>" alt="Avatar" class="img-fluid rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
            </td>
            <td><?php echo $row_post['created_at']; ?></td>
            <td>
              <a href="view_post.php?post_id=<?php echo $row_post['post_id'] ?>">Truy cập</a>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>