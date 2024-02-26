<?php
include('layout.php');
include_once('../../config/connect.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$file_id = $_GET['content_id'];
$sql = "SELECT * FROM file_contents fc
INNER JOIN course_contents ct ON ct.contents_id = fc.course_content_id
INNER JOIN topics tp ON ct.topic_id = tp.topic_id
INNER JOIN course c ON tp.course_id = c.course_id
INNER JOIN user us ON us.user_id = c.teacher_id
WHERE fc.file_id = $file_id";
$result = mysqli_query($dbconnect, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
    <title>Xem nội dung</title>
</head>

<body>
    <?php while ($row_file = mysqli_fetch_assoc($result)) : ?>
        <div class="container mt-4">
            <h3><br>
                <a href="content.php"><i class="bi bi-arrow-left-circle"></i></a>
                <?php echo $row_file['title_content']; ?>
            </h3>
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <p>
                            <b>Tạo bởi: </b> <img src="../../assets/images/<?php echo $row_file['image'] ?> " alt="Avatar" class="img-fluid rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
                            <span><?php echo $row_file['full_name']; ?></span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p class="float-end">
                            <b>Ngày tạo: </b><?php echo $row_file['created_at'] ?>
                            <b> - Kích thước:</b><?php echo $row_file['file_size'] ?> KB
                        </p>
                    </div>
                </div>
                <div class="card col-md-12">
                    <div class="card-body">
                        <h5>Mô tả tài liệu</h5>
                        <hr>
                        <p><?php echo $row_file['description_content'] ?></p>
                    </div>
                </div>

            </div>
            <div class="container mt-4">
                <iframe id="inlineFrameExample" title="Inline Frame Example" width="100%" height="800" src="../../assets/<?php echo $row_file['file_name'] ?>">
                </iframe>
            </div>
        <?php endwhile; ?>
        <?php include("../../footer.php"); ?>
</body>

</html>
