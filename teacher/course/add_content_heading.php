<?php
include("layout.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo chủ để mới</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.2/dist/quill.snow.css" rel="stylesheet">
</head>

<body>
    <form action="process.php" method="post">
        <header class="container mt-4">
            <div class="row">
                <div class="col-md-6">
                    <h3>Tạo chủ đề mới</h3>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary float-end" name="create_post">Lưu nội dung</button>
                </div>
            </div>
            </div>
        </header>
        <div class="container mt-3">
            <div class="form-group">
                <label for="postTitle">Tên chủ đề</label>
                <input type="text" class="form-control" id="postTitle" name="postTitle" required>
            </div>
            <div class="form-group">
                <label for="postContent">Mô tả chủ đề</label>
                <div id="editor-container"></div>
                <textarea class="form-control" id="postContent" name="postContent" style="display: none;" rows="8" required></textarea>
            </div>
        </div>
    </form>
    <!-- Bootstrap JS and Popper.js -->
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
</body>

</html>