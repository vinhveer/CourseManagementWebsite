<?php
include('layout.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$nav_id = isset($_GET['nav_id']) ? $_GET['nav_id'] : "";
$topic_id = isset($_GET['topic_id']) ? $_GET['topic_id'] : "";
if (isset($_GET['nav_id'])) {
    $content_id = $_GET['content_id'];
    if ($nav_id == 1) {
        $sql = "SELECT * FROM course_contents ct
        INNER JOIN video_contents vc ON ct.contents_id = vc.course_content_id WHERE contents_id =  $content_id";
        $result = mysqli_query($dbconnect, $sql);
        $row = mysqli_fetch_array($result);
    } else if ($nav_id == 2) {
        $sql = "SELECT * FROM course_contents ct
        INNER JOIN embedded_contents ec ON ct.contents_id = ec.course_content_id WHERE contents_id =  $content_id";
        $result = mysqli_query($dbconnect, $sql);
        $row = mysqli_fetch_array($result);
    } else if ($nav_id == 3) {
        $sql = "SELECT * FROM course_contents ct
        INNER JOIN file_contents fc ON ct.contents_id = fc.course_content_id WHERE contents_id =  $content_id";
        $result = mysqli_query($dbconnect, $sql);
        $row = mysqli_fetch_array($result);
    } else if ($nav_id == 4) {
        $sql = "SELECT * FROM course_contents ct
        INNER JOIN text_contents tc ON ct.contents_id = tc.course_content_id WHERE contents_id =  $content_id";
        $result = mysqli_query($dbconnect, $sql);
        $row = mysqli_fetch_array($result);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.2/dist/quill.snow.css" rel="stylesheet">
    <title>Tạo nội dung mới</title>
</head>

<body>
    <header class="container mt-4">
        <h3>
            <a href="edit_content.php?topic_id=<?php echo $topic_id ?>"><i class="bi bi-arrow-left-circle"></i></a>
            Sửa nội dung
        </h3>
    </header>
    <div class="container mt-4">
        <ul class="nav nav-tabs">
            <?php
            $tabs = ['Tải lên video', 'Nhúng video', 'Tập tin', 'Nội dung văn bản'];
            echo '<li class="nav-item">
                <a class="nav-link ' . "active" . '" href="edit_content_in_heading.php?nav_id=' . $nav_id . '&topic_id=' . $topic_id . '">' . $tabs[$nav_id - 1] . '</a>
              </li>';
            ?>
        </ul>
    </div>
    <div class="container mt-4">
        <?php
        switch ($nav_id) {
            case 1:
                echo '
                    <form action="process.php?content_id=' . $content_id . '" method="post" class="row g-3" enctype="multipart/form-data">
                        <div class="col-12">
                            <label for="file_title" class="form-label">Tiêu đề bài học</label>
                            <input type="text" class="form-control" id="file_title" name="titlecontent" required value="' . $row['title_content'] . '">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress2" class="form-label">Mô tả bài học</label>
                            <input type="textarea" class="form-control" id="inputAddress2" name="title_description" value="' . $row['description_content'] . '" required>
                        </div>
                        <div class="col-12">
                            <p>File hiện tại:' . $row['video_url'] . '</p>
                            <label for="videoInput" class="form-label">Tải lên file video</label>
                            <input type="file" class="form-control" id="videoInput" name="contentVideo">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary" name="edit_content">Lưu nội dung</button>
                        </div>
                    </form>';
                break;

            case 2:
                echo '
                    <form action="process.php?content_id=' . $content_id . '" method="post" class="row g-3">
                        <div class="col-12">
                            <label for="file_title" class="form-label">Tiêu đề bài học</label>
                            <input type="text" class="form-control" id="file_title" name="titlecontent" required value="' . $row['title_content'] . '">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress2" class="form-label">Mô tả bài học </label>
                            <input type="textarea" class="form-control" id="inputAddress2" name="title_description" value="' . $row['description_content'] . '" required>
                        </div>
                        <div class="col-12">
                            <label for="inputCity" class="form-label">Dán mã nhúng vào đây</label>
                            <textarea class="form-control" id="inputCity" name="code_embedded" required><iframe width="100%" height="315" src="' . $row['embed_code'] . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe> </textarea >
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary" name="edit_content">Lưu nội dung</button>
                        </div>
                    </form>';
                break;

            case 3:
                echo '
                    <form action="process.php?content_id=' . $content_id . '" method="post" class="row g-3" enctype="multipart/form-data">
                        <div class="col-12">
                            <label for="file_title" class="form-label">Tiêu đề bài học</label>
                            <input type="text" class="form-control" id="file_title" name="titlecontent" required value="' . $row['title_content'] . '">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress2" class="form-label">Mô tả bài học </label>
                            <input type="textarea" class="form-control" id="inputAddress2" name="title_description" value="' . $row['description_content'] . '" required>
                        </div>
                        <div class="col-12">
                            <p>File hiện tại:' . $row['file_name'] . '</p>
                            <label for="inputCity" class="form-label">Tải lên tập tin</label>
                            <input type="file" class="form-control" id="inputCity" name="contentFile">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary" name="edit_content">Lưu nội dung</button>
                        </div>
                    </form>';
                break;

            case 4:
                echo '
                    <form action="process.php?content_id=' . $content_id . '" method="post" class="row g-3">
                        <div class="col-12">
                            <label for="file_title" class="form-label">Tiêu đề bài học</label>
                            <input type="text" class="form-control" id="file_title" name="titlecontent" required value="' . $row['title_content'] . '">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress2" class="form-label">Mô tả bài học</label>
                            <input type="textarea" class="form-control" id="inputAddress2" name="title_description"value="' . $row['description_content'] . '" required>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="postContent">Nội dung bài đăng</label>
                                <div id="editor-container"></div>
                                <textarea class="form-control" id="postContent" name="contentText" style="display: none;" rows="8" required>' . $row['text_content'] . '</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary" name="edit_content">Lưu nội dung</button>
                        </div>
                    </form>';
                break;

            default:
                // Handle default case here if needed
                break;
        }
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Quill JS -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.2/dist/quill.js"></script>
    <script>
        const quill = new Quill('#editor-container', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{
                        'header': [1, 2, false]
                    }],
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote', 'code-block'],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }],
                    [{
                        'script': 'sub'
                    }, {
                        'script': 'super'
                    }],
                    [{
                        'indent': '-1'
                    }, {
                        'indent': '+1'
                    }],
                    [{
                        'direction': 'rtl'
                    }],
                    [{
                        'size': ['small', false, 'large', 'huge']
                    }],
                    [{
                        'header': [1, 2, 3, 4, 5, 6, false]
                    }],
                    [{
                        'color': []
                    }, {
                        'background': []
                    }],
                    [{
                        'font': []
                    }],
                    [{
                        'align': []
                    }],
                    ['clean']
                ],
            },
        });
        <?php if (isset($row['text_content'])) : ?>
            quill.root.innerHTML = '<?php echo addslashes($row['text_content']); ?>';
        <?php endif; ?>
        quill.on('text-change', function() {
            const content = quill.root.innerHTML;
            document.getElementById('postContent').value = content;
        });
    </script>
    <?php include("../../footer.php"); ?>
</body>

</html>
