<?php
include_once('layout.php');
include_once('../../config/connect.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$course_id =   (isset($_GET['course_id'])) ? $_GET['course_id'] : $_SESSION['course_id'];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['timkiem'])) {
    $tukhoa = $_POST['tukhoa'];
    $keyword = strtolower(trim($tukhoa));
    $keyword = str_replace(' ', '', $keyword);
    $sql = "SELECT * FROM topics tp WHERE course_id = $course_id AND
    (LOWER(REPLACE(REPLACE(REPLACE(REPLACE(title_topic, ' ', ''), 'Đ', 'D'),'đ','d'), ' ', '')) LIKE '%$keyword%' OR title_topic LIKE '%$tukhoa%')";
    $result = mysqli_query($dbconnect, $sql);
} else {
    $sql = "SELECT * FROM topics tp WHERE course_id = $course_id";
    $result = mysqli_query($dbconnect, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nội dung khóa học</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <header class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <h3>Nội dung khóa học</h3>
            </div>
            <div class="col-md-4">
                <form class="d-flex" action="content.php" method="POST">
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
                <a class="btn btn-primary float-end" href="add_content_heading.php">+ Tạo chủ đề mới</a>
            </div>
        </div>
    </header>
    <div class="container mt-4">
        <?php while ($row_topic = mysqli_fetch_assoc($result)) : ?>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title"><?php echo $row_topic['title_topic']; ?></h4>
                        </div>
                        <div class="col-md-6">

                            <div><a type="button" class="btn btn-primary float-end" href="add_content_in_heading.php?topic_id=<?php echo $row_topic['topic_id']; ?>">+ Thêm nội dung mới</a></div>

                            <div><a type="button" class="btn btn-primary float-end me-2" href="edit_content.php?topic_id=<?php echo $row_topic['topic_id']; ?>">+ Sửa nội dung <i class="fas fa-dungeon"></i></a><span>&nbsp;</span></div>
                        </div>
                    </div>
                    <p class="card-text"><?php echo $row_topic['description']; ?></p>
                    <table class="table">
                        <?php $topic_id = $row_topic['topic_id'];
                        $sql_content = "SELECT * FROM topics tp
                        INNER JOIN course_contents ct ON tp.topic_id = ct.topic_id
                        LEFT JOIN video_contents vc ON ct.contents_id = vc.course_content_id
                        LEFT JOIN embedded_contents ec ON ct.contents_id = ec.course_content_id
                        LEFT JOIN file_contents fc ON ct.contents_id = fc.course_content_id
                        LEFT JOIN text_contents tc ON ct.contents_id = tc.course_content_id
                        WHERE tp.course_id = $course_id AND ct.topic_id=$topic_id";
                        $result_content = mysqli_query($dbconnect, $sql_content);
                        while ($row = mysqli_fetch_assoc($result_content)) : ?>
                            <?php if ($row['embed_code']) : ?>
                                <tbody>
                                    <td><i class="fa-solid fa-file-video"></i><?php echo " ." . $row['title_content']; ?></td>
                                    <td><?php echo $row['content_type']; ?></td>
                                    <td>
                                        <a class="float-end" href="view_content_video.php?content_id=<?php echo $row['embedded_id']; ?>">Truy cập nội dung</a>
                                    </td>
                                </tbody>
                            <?php endif; ?>
                            <?php if ($row['video_url']) : ?>
                                <tbody>
                                    <td><i class="fa-solid fa-film"></i><?php echo " ." . $row['title_content']; ?></td>
                                    <td><?php echo $row['content_type']; ?></td>
                                    <td>
                                        <a class="float-end" href="view_content_file_vd.php?content_id=<?php echo $row['video_id']; ?>">Truy cập nội dung</a>
                                    </td>
                                </tbody>
                            <?php endif; ?>
                            <?php if ($row['text_content']) : ?>
                                <tbody>
                                    <td><i class="fa-solid fa-file-pen"></i><?php echo " ." . $row['title_content']; ?></td>
                                    <td><?php echo $row['content_type']; ?></td>
                                    <td>
                                        <a class="float-end" href="view_content_text.php?content_id=<?php echo $row['text_id']; ?>">Truy cập nội dung</a>
                                    </td>
                                </tbody>
                            <?php endif; ?>
                            <?php if ($row['file_name']) : ?>
                                <tbody>
                                    <td><i class="fa-solid fa-file-invoice"></i><?php echo " ." . $row['title_content']; ?></td>
                                    <td><?php echo $row['content_type']; ?></td>
                                    <td>
                                        <a class="float-end" href="view_content_file.php?content_id=<?php echo $row['file_id']; ?>">Truy cập nội dung</a>
                                    </td>
                                </tbody>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </table>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <?php include("../../footer.php"); ?>
</body>

</html>
