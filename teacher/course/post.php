<?php
include("layout.php");
include_once('../../config/connect.php');

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
$course_id = $_SESSION['course_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['timkiem'])) {
  $tukhoa = $_POST['tukhoa'];
  $keyword = strtolower(trim($tukhoa));
  $keyword = str_replace(' ', '', $keyword);
  $sql_post = "SELECT * FROM post WHERE course_id = $course_id AND
  (LOWER(REPLACE(REPLACE(REPLACE(REPLACE(title, ' ', ''), 'Đ', 'D'),'đ','d'), ' ', '')) LIKE '%$keyword%' OR title LIKE '%$tukhoa%')";
  $result_post = mysqli_query($dbconnect, $sql_post);
} else {
  $sql_post = "SELECT * FROM post WHERE course_id = $course_id";
  $result_post = mysqli_query($dbconnect, $sql_post);
}
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
        <form class="d-flex" action="post.php" method="POST">
          <div class="input-group mb-3">
            <input type="search" class="form-control" placeholder="Tìm kiếm ..." aria-label="Recipient's username" aria-describedby="button-addon2" name="tukhoa">
            <button class="btn btn-dark" type="submit" id="button-addon2" type="submit" name="timkiem">Tìm</button>
          </div>
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
        <th>Ngày đăng</th>
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
              <a style="text-decoration: none;" href="view_post.php?post_id=<?php echo $row_post['post_id'] ?>">Truy cập&nbsp;</a>
              <a style="text-decoration: none;" href="edit_post.php?post_id=<?php echo $row_post['post_id'] ?>">Sửa&nbsp;</a>
              <a href="" style="text-decoration: none;" class="delete-post-btn" data-postid="<?php echo $row_post['post_id'] ?>" data-bs-toggle="modal" data-bs-target="#deleteCourseModal">Xóa </a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <div class="modal fade" id="deleteCourseModal" tabindex="-1" aria-labelledby="deleteCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteCourseModalLabel">Xác nhận xóa nội dung</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Bạn có chắc chắn muốn xóa bài đăng này?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Hủy</button>
          <form id="deletePostForm" method="post" action="">
            <button type="submit" class="btn btn-danger" name="delete_post">Xóa</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-post-btn');
    deleteButtons.forEach(button => {
      button.addEventListener('click', function() {
        const postId = this.getAttribute('data-postid');
        const form = document.querySelector('#deletePostForm');
        form.action = `process.php?post_id=${postId}`;
      });
    });
  });
</script>
<?php include("../../footer.php"); ?>
</body>
</html>
