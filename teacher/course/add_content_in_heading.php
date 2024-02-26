<?php
include('layout.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$nav_id = isset($_GET['nav_id']) ? $_GET['nav_id'] : 1;
$topic_id = isset($_GET['topic_id']) ? $_GET['topic_id'] : "";

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
            <a href="content.php"><i class="bi bi-arrow-left-circle"></i></a>
            Tạo chủ đề mới
        </h3>
    </header>
    <div class="container mt-4">
        <ul class="nav nav-tabs">
            <?php
            $tabs = ['Tải lên video', 'Nhúng video', 'Tập tin', 'Nội dung văn bản'];
            for ($i = 1; $i <= count($tabs); $i++) {
                echo '<li class="nav-item">
                        <a class="nav-link ' . ($nav_id == $i ? "active" : "") . '" href="add_content_in_heading.php?nav_id=' . $i . '&topic_id=' . $topic_id . '">' . $tabs[$i - 1] . '</a>
                    </li>';
            }
            ?>
        </ul>
    </div>
    <div class="container mt-4">
        <?php
        switch ($nav_id) {
            case 1:
                echo '
                    <form action="process.php?topic_id=' . $topic_id . '" method="post" class="row g-3" enctype="multipart/form-data">
                        <div class="col-12">
                            <label for="file_title" class="form-label">Tiêu đề bài học</label>
                            <input type="text" class="form-control" id="file_title" name="titlecontent" required>
                        </div>
                        <div class="col-12">
                            <label for="inputAddress2" class="form-label">Mô tả bài học</label>
                            <input type="textarea" class="form-control" id="inputAddress2" name="title_description" value="No description" required>
                        </div>
                        <div class="col-12">
                            <label for="videoInput" class="form-label">Tải lên file video</label required>
                            <input type="file" class="form-control" id="videoInput" name="contentVideo">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary" name="create_video">Lưu nội dung</button>
                        </div>
                    </form>';
                break;

            case 2:
                echo '
                    <form action="process.php?topic_id=' . $topic_id . '" method="post" class="row g-3">
                        <div class="col-12">
                            <label for="file_title" class="form-label">Tiêu đề bài học</label>
                            <input type="text" class="form-control" id="file_title" name="titlecontent" required>
                        </div>
                        <div class="col-12">
                            <label for="inputAddress2" class="form-label">Mô tả bài học </label>
                            <input type="textarea" class="form-control" id="inputAddress2" name="title_description" value="No description" required>
                        </div>
                        <div class="col-12">
                            <label for="inputCity" class="form-label">Dán mã nhúng vào đây</label>
                            <textarea class="form-control" id="inputCity" name="code_embedded" required></textarea >
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary" name="create_embedded">Lưu nội dung</button>
                        </div>
                    </form>';
                break;

            case 3:
                echo '
                    <form action="process.php?topic_id=' . $topic_id . '" method="post" class="row g-3" enctype="multipart/form-data">
                        <div class="col-12">
                            <label for="file_title" class="form-label">Tiêu đề bài học</label>
                            <input type="text" class="form-control" id="file_title" name="titlecontent" required>
                        </div>
                        <div class="col-12">
                            <label for="inputAddress2" class="form-label">Mô tả bài học </label>
                            <input type="textarea" class="form-control" id="inputAddress2" name="title_description" value="No description" required>
                        </div>
                        <div class="col-12">
                            <label for="inputCity" class="form-label">Tải lên tập tin</label>
                            <input type="file" class="form-control" id="inputCity" name="contentFile" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary" name="create_file">Lưu nội dung</button>
                        </div>
                    </form>';
                break;

            case 4:
                echo '
                    <form action="process.php?topic_id=' . $topic_id . '" method="post" class="row g-3">
                        <div class="col-12">
                            <label for="file_title" class="form-label">Tiêu đề bài học</label>
                            <input type="text" class="form-control" id="file_title" name="titlecontent" required>
                        </div>
                        <div class="col-12">
                            <label for="inputAddress2" class="form-label">Mô tả bài học</label>
                            <input type="textarea" class="form-control" id="inputAddress2" name="title_description" value="No description" required>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="postContent">Nội dung bài đăng</label>
                                <div id="editor-container"></div>
                                <textarea class="form-control" id="postContent" name="contentText" style="display: none;" rows="8" required></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary" name="create_text">Lưu nội dung</button>
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
                    ['bold', 'italic', 'underline', 'strike'], // in đậm, in nghiêng, gạch ngang, gạch chân
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
                    }], // chú thích dưới, chú thích trên
                    [{
                        'indent': '-1'
                    }, {
                        'indent': '+1'
                    }], // thu nhỏ đoạn, mở rộng đoạn
                    [{
                        'direction': 'rtl'
                    }], // chuyển hướng viết từ phải sang trái
                    [{
                        'size': ['small', false, 'large', 'huge']
                    }], // kích thước chữ
                    [{
                        'header': [1, 2, 3, 4, 5, 6, false]
                    }],
                    [{
                        'color': []
                    }, {
                        'background': []
                    }], // chọn màu chữ, chọn màu nền
                    [{
                        'font': []
                    }],
                    [{
                        'align': []
                    }],
                    ['clean'] // xóa định dạng
                ],
            },
        });

        // Update hidden textarea on editor change
        quill.on('text-change', function() {
            const content = quill.root.innerHTML;
            document.getElementById('postContent').value = content;
        });
    </script>
    <?php include("../../footer.php"); ?>
</body>

</html>
