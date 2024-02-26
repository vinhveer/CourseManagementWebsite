<?php
include_once('../../config/connect.php');
include('layout.php');
$text_id = $_GET['content_id'];
$sql = "SELECT * FROM text_contents tc
INNER JOIN course_contents ct ON ct.contents_id = tc.course_content_id
INNER JOIN topics tp ON ct.topic_id = tp.topic_id
INNER JOIN course c ON tp.course_id = c.course_id
INNER JOIN user us ON us.user_id = c.teacher_id
WHERE tc.text_id = $text_id";
$result = mysqli_query($dbconnect, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Xem nội dung</title>
</head>

<body>
    <?php while ($row_text = mysqli_fetch_assoc($result)) : ?>
        <div class="container mt-4">
            <h3><a href="content.php"><i class="bi bi-arrow-left-circle"></i></a>
                <?php echo $row_text['title_content']; ?></h3>
        </div>
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-6">
                    <p>
                        <b>Tạo bởi: </b> <img src="../../assets/images/<?php echo $row_text['image'] ?> " alt="Avatar" class="img-fluid rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
                        <span><?php echo $row_text['full_name']; ?></span>
                    </p>
                </div>
                <div class="col-md-6">
                    <p class="float-end">
                        <b>Ngày tạo: </b><?php echo $row_text['created_at'] ?>
                    </p>
                </div>
                <div class="card col-md-12">
                    <div class="card-body">
                        <h6>Mô tả nội dung</h6>
                        <hr>
                        <p><?php echo $row_text['description_content'] ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-4">
            <div class="row">
                <div class="card col-md-12">
                    <div class="card-body">
                        <h6>Mô tả nội dung</h6>
                        <hr>
                        <p><?php echo $row_text['text_content'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
    <?php include("../../footer.php"); ?>
</body>

</html>
