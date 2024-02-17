<?php
include("layout.php");
include_once('../../config/connect.php');

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    $sql_edit = "SELECT * FROM post WHERE post_id = $post_id";
    $result_edit = mysqli_query($dbconnect, $sql_edit);
    $row_edit = mysqli_fetch_assoc($result_edit);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo bài đăng mới</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.2/dist/quill.snow.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <a href="post.php">&lt; Trở về trang bài đăng </a>
    </div>
    <form action="process.php?post_id=<?php echo $row_edit['post_id'] ?>" method="post">
        <header class="container mt-4">
            <div class="row">
                <div class="col-md-6">
                    <h3>Sửa thông tin</h3>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary float-end" name="edit_post">Đăng bài</button>
                </div>
            </div>
            </div>
        </header>
        <div class="container mt-3">
            <div class="form-group">
                <label for="postTitle">Tiêu đề bài đăng</label>
                <input type="text" class="form-control" id="postTitle" name="postTitle" required value="<?php echo $row_edit['title'];?>" placeholder="Tiêu đề">
            </div>
            <div class="form-group">
                <label for="postContent">Nội dung bài đăng</label>
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
                    [{'header': [1, 2, false]}],
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote', 'code-block'],
                    [{'list': 'ordered'}, {'list': 'bullet'}],
                    [{'script': 'sub'}, {'script': 'super'}],
                    [{'indent': '-1'}, {'indent': '+1'}],
                    [{'direction': 'rtl'}],
                    [{'size': ['small', false, 'large', 'huge']}],
                    [{'header': [1, 2, 3, 4, 5, 6, false]}],
                    [{'color': []}, {'background': []}],
                    [{'font': []}],
                    [{'align': []}],
                    ['clean']
                ],
            },
        });
        <?php if(isset($row_edit['content'])): ?>
            quill.root.innerHTML = '<?php echo addslashes($row_edit['content']); ?>';
        <?php endif; ?>
        quill.on('text-change', function() {
            const content = quill.root.innerHTML;
            document.getElementById('postContent').value = content;
        });
    </script>
    <?php include("../../footer.php"); ?>
</body>

</html>
