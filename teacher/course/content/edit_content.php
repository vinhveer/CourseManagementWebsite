<?php
include_once('layout.php');
include_once('../../config/connect.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$course_id = (isset($_GET['course_id'])) ? $_GET['course_id'] : $_SESSION['course_id'];
$topic_id = $_GET['topic_id'];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['timkiem'])) {
    $tukhoa = $_POST['tukhoa'];
    $keyword = strtolower(trim($tukhoa));
    $keyword = str_replace(' ', '', $keyword);
    $sql_content = "SELECT * FROM topics tp
    INNER JOIN course_contents ct ON tp.topic_id = ct.topic_id
    LEFT JOIN video_contents vc ON ct.contents_id = vc.course_content_id
    LEFT JOIN embedded_contents ec ON ct.contents_id = ec.course_content_id
    LEFT JOIN file_contents fc ON ct.contents_id = fc.course_content_id
    LEFT JOIN text_contents tc ON ct.contents_id = tc.course_content_id
    WHERE ct.topic_id=$topic_id AND
    (LOWER(REPLACE(REPLACE(REPLACE(REPLACE(title_content, ' ', ''), 'Đ', 'D'),'đ','d'), ' ', '')) LIKE '%$keyword%' OR title_content LIKE '%$tukhoa%')";
    $result_content = mysqli_query($dbconnect, $sql_content);
    $row = mysqli_fetch_assoc($result_content);
} else {
    $sql_content = "SELECT * FROM topics tp
    INNER JOIN course_contents ct ON tp.topic_id = ct.topic_id
    LEFT JOIN video_contents vc ON ct.contents_id = vc.course_content_id
    LEFT JOIN embedded_contents ec ON ct.contents_id = ec.course_content_id
    LEFT JOIN file_contents fc ON ct.contents_id = fc.course_content_id
    LEFT JOIN text_contents tc ON ct.contents_id = tc.course_content_id
    WHERE ct.topic_id=$topic_id";
    $result_content = mysqli_query($dbconnect, $sql_content);
    $row = mysqli_fetch_assoc($result_content);
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
        <?php if (empty($row['content_id'])) {
            $sql = "SELECT * FROM topics WHERE topic_id=$topic_id";
            $result = mysqli_query($dbconnect, $sql);
            $row_topic = mysqli_fetch_assoc($result);
        }
        ?>
        <div class="row">
            <div class="col-md-6">
                <h3>Nội dung chủ đề</h3>
            </div>
            <div class="col-md-6">
                <form class="d-flex" action="edit_content.php?topic_id=<?php echo $topic_id; ?>" method="POST">
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
        </div>
    </header>
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title"><?php echo $row_topic['title_topic']; ?></h4>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-danger float-end" data-postid="<?php echo $topic_id; ?>" data-bs-toggle="modal" data-bs-target="#deleteTopicModal">Xóa chủ đề</button>
                    </div>
                </div>
                <p class="card-text"><?php echo $row_topic['description']; ?></p>
                <table class="table">
                    <?php
                    mysqli_data_seek($result_content, 0);
                    while ($row = mysqli_fetch_assoc($result_content)) : ?>
                        <?php if ($row['embed_code']) : ?>
                            <tbody>
                                <td><i class="fa-solid fa-file-video"></i><?php echo " ." . $row['title_content']; ?></td>
                                <td><button type="button" class="btn btn-danger float-end me-2" data-postid="<?php echo $row['contents_id']; ?>" data-bs-toggle="modal" data-bs-target="#deleteCourseModal">Xóa</button>
                                    <a class="btn btn-info float-end me-2" href="edit_content_in_heading.php?content_id=<?php echo $row['contents_id']; ?>&topic_id=<?php echo $row['topic_id']; ?>&nav_id=2">Sửa</a>
                                    <a class="btn btn-info float-end me-2" href="view_content_video.php?content_id=<?php echo $row['embedded_id']; ?>">Thông tin</a>
                                </td>
                            </tbody>
                        <?php endif; ?>
                        <?php if ($row['video_url']) : ?>
                            <tbody>
                                <td><i class="fa-solid fa-film"></i><?php echo " ." . $row['title_content']; ?></td>
                                <td><button type="button" class="btn btn-danger float-end me-2" data-postid="<?php echo $row['contents_id']; ?>" data-bs-toggle="modal" data-bs-target="#deleteCourseModal">Xóa</button>
                                    <a class="btn btn-info float-end me-2" href="edit_content_in_heading.php?content_id=<?php echo $row['contents_id']; ?>&topic_id=<?php echo $row['topic_id']; ?>&nav_id=1">Sửa</a>
                                    <a class="btn btn-info float-end me-2" href="view_content_file_vd.php?content_id=<?php echo $row['video_id']; ?>">Thông tin</a>
                                </td>
                            </tbody>
                        <?php endif; ?>
                        <?php if ($row['text_content']) : ?>
                            <tbody>
                                <td><i class="fa-solid fa-file-pen"></i><?php echo " ." . $row['title_content']; ?></td>
                                <td><button type="button" class="btn btn-danger float-end me-2" data-postid="<?php echo $row['contents_id']; ?>" data-bs-toggle="modal" data-bs-target="#deleteCourseModal">Xóa</button>
                                    <a class="btn btn-info float-end me-2" href="edit_content_in_heading.php?content_id=<?php echo $row['contents_id']; ?>&topic_id=<?php echo $row['topic_id']; ?>&nav_id=4">Sửa</a>
                                    <a class="btn btn-info float-end me-2" href="view_content_text.php?content_id=<?php echo $row['text_id']; ?>">Thông tin</a>
                                </td>
                            </tbody>
                        <?php endif; ?>
                        <?php if ($row['file_name']) : ?>
                            <tbody>
                                <td><i class="fa-solid fa-file-invoice"></i><?php echo " ." . $row['title_content']; ?></td>
                                <td class="float-end"><button type="button" class="btn btn-danger float-end me-2" data-postid="<?php echo $row['contents_id']; ?>" data-bs-toggle="modal" data-bs-target="#deleteCourseModal">Xóa</button>
                                    <a class="btn btn-info float-end me-2" href="edit_content_in_heading.php?content_id=<?php echo $row['contents_id']; ?>&topic_id=<?php echo $row['topic_id']; ?>&nav_id=3">Sửa</a>
                                    <a class="btn btn-info float-end me-2" href="view_content_file.php?content_id=<?php echo $row['file_id']; ?>">Thông tin</a>
                                </td>
                            </tbody>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteCourseModal" tabindex="-1" aria-labelledby="deleteCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCourseModalLabel">Xác nhận xóa nội dung</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa nội dung này?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <form id="deletePostForm" action="" method="post">
                        <button type="submit" class="btn btn-danger" name="delete_content">Xác nhận</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteTopicModal" tabindex="-1" aria-labelledby="deleteTopicModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteTopicModalLabel">Xác nhận xóa chủ đề </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa chủ đề này?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <form id="deleteTopicForm" action="" method="post">
                        <button type="submit" class="btn btn-danger" name="delete_topic">Xác nhận</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn.btn-danger.float-end.me-2');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const contentId = this.getAttribute('data-postid');
                    const form = document.querySelector('#deletePostForm');
                    form.action = `process.php?content_id=${contentId}`;
                });
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const deleteTopics = document.querySelectorAll('.btn.btn-danger.float-end');
            deleteTopics.forEach(button => {
                button.addEventListener('click', function() {
                    const topicId = this.getAttribute('data-postid');
                    const form = document.querySelector('#deleteTopicForm');
                    form.action = `process.php?topic_id=${topicId}`;
                });
            });
        });
    </script>
    <?php include("../../footer.php"); ?>
</body>

</html>
