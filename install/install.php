<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cài đặt LMS</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <header class="container mt-4">
        <h2>Cài đặt LMS</h2>
    </header>
    <div class="container mt-3">
        <form action="process.php" method="post">
            <div class="form-group">
                <label for="dbPath">Đường dẫn MySQL:</label>
                <input type="text" class="form-control" id="dbPath" name="dbPath" required>
            </div>
            <div class="form-group">
                <label for="dbPath">Tên đăng nhập:</label>
                <input type="text" class="form-control" id="dbUsername" name="dbUsername" required>
            </div>
            <div class="form-group">
                <label for="dbPassword">Mật khẩu:</label>
                <input type="password" class="form-control" id="dbPassword" name="dbPassword" required>
            </div>
            <button type="submit" class="btn btn-primary" name="install">Bắt đầu khởi tạo dữ liệu</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>