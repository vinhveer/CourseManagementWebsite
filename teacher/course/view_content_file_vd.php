<?php
include('layout.php');
include_once('../../config/connect.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$video_id = $_GET['content_id'];
$sql = "SELECT * FROM video_contents vc
INNER JOIN course_contents ct ON ct.contents_id = vc.course_content_id
INNER JOIN topics tp ON ct.topic_id = tp.topic_id
INNER JOIN course c ON tp.course_id = c.course_id
INNER JOIN user us ON us.user_id = c.teacher_id
WHERE vc.video_id = $video_id";
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
    <?php while ($row_vd = mysqli_fetch_assoc($result)) : ?>
        <div class="container mt-4">
            <div class="row">
                <h3><a href="content.php"><i class="bi bi-arrow-left-circle"></i></a>
                    <?php echo $row_vd['title_content']; ?>
            </div>
        </div>
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-6">
                    <p>
                        <b>Tạo bởi: </b> <img src="../../assets/images/<?php echo $row_vd['image'] ?> " alt="Avatar" class="img-fluid rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
                        <span><?php echo $row_vd['full_name']; ?></span>
                    </p>
                </div>
                <div class="col-md-6">
                    <p class="float-end">
                        <b>Ngày tạo: </b></b><?php echo $row_vd['created_at']?>
                        <b> - Kích thước:</b><?php echo $row_vd['video_size']?> KB
                    </p>
                </div>
            </div>
        </div>
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-7">
                    <iframe id="inlineFrameExample" title="Inline Frame Example" width="100%" height="450" src="../../assets/<?php echo $row_vd['video_url']?>">
                    </iframe>
                </div>
                <div class="card col-md-5">
                    <div class="card-body">
                        <h5>Mô tả video</h5>
                        <hr>
                        <p><?php echo $row_vd['description_content'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
    <?php include("../../footer.php"); ?>
</body>

</html>
