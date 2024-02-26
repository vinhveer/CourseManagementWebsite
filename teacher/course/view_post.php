<?php
include('layout.php');
include_once('../../config/connect.php');

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    $sql_view = "SELECT * FROM post WHERE post_id = $post_id";
    $result_view = mysqli_query($dbconnect, $sql_view);
    $row_view = mysqli_fetch_assoc($result_view);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Bài viết</title>
</head>

<body>
    <div class="container mt-4">
        <a href="post.php">&lt; Trở về trang bài đăng </a>
    </div>
    <div class="container mt-4">
        <h3><?php echo $row_view['title']; ?></h3>
    </div>
    <?php
    $user_id = $row_view['user_id'];
    $sql_user = "SELECT * FROM user WHERE user_id = $user_id";
    $result_user = mysqli_query($dbconnect, $sql_user);
    $row_user = mysqli_fetch_assoc($result_user);
    $full_name = $row_user['full_name'];
    $image = $row_user['image'];
    ?>
    <div class="container mt-4">
        <p>
            <b>Tạo bởi: </b> <img src="<?php echo "../../assets/images/" . $image ?>" alt="Avatar" class="img-fluid rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
            <span><?php echo $full_name; ?></span>
            <b> - Ngày tạo: </b><?php echo $row_view['created_at']; ?>
        </p>
    </div>
    <div class="container mt-4">
        <?php echo $row_view['content']?>
    </div>
    <?php include("../../footer.php"); ?>
</body>

</html>
