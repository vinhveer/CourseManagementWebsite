<?php
include("layout.php");
include_once('../../config/connect.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$embed_id = $_GET['content_id'];
$sql = "SELECT * FROM embedded_contents ec
INNER JOIN course_contents ct ON ct.contents_id = ec.course_content_id
INNER JOIN topics tp ON ct.topic_id = tp.topic_id
INNER JOIN course c ON tp.course_id = c.course_id
INNER JOIN user us ON us.user_id = c.teacher_id
WHERE ec.embedded_id = $embed_id";
$result=mysqli_query($dbconnect,$sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Bài giảng Video</title>
</head>

<body>
    <?php while ($row_vd = mysqli_fetch_assoc($result)) : ?>
    <header class="container mt-4">
        <div class="row">
            <h3>
                <a href="content.php"><i class="bi bi-arrow-left-circle"></i></a>
               <?php echo $row_vd['title_content'];?>
            </h3>
        </div>
    </header>
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
                    <b>Ngày tạo: </b><?php echo $row_vd['created_at']?>
                </p>
            </div>
        </div>
    </div>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-7">
            <iframe width="100%" height="315" src="<?php echo $row_vd['embed_code']?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
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
