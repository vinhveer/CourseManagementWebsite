<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Danh sách thành viên</title>
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Danh sách thành viên</h1>

        <!-- Bảng Giáo viên chính -->
        <h2>Giáo viên chính</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã định danh</th>
                    <th>Họ và tên</th>
                    <th>Giới tính</th>
                    <th>Email</th>
                    <th>Trang cá nhân</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dữ liệu mẫu, bạn có thể thay thế bằng dữ liệu thực tế từ cơ sở dữ liệu -->
                <tr>
                    <td>1</td>
                    <td>GV001</td>
                    <td>Nguyễn Văn A</td>
                    <td>Nam</td>
                    <td>nguyenvana@email.com</td>
                    <td><button class="btn btn-primary">Xem</button></td>
                </tr>
                <!-- Thêm các dòng dữ liệu khác tương tự ở đây -->
            </tbody>
        </table>

        <!-- Bảng Trợ giảng -->
        <h2>Trợ giảng</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã định danh</th>
                    <th>Họ và tên</th>
                    <th>Giới tính</th>
                    <th>Email</th>
                    <th>Trang cá nhân</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dữ liệu mẫu cho bảng Trợ giảng -->
                <tr>
                    <td>1</td>
                    <td>TG001</td>
                    <td>Trần Thị B</td>
                    <td>Nữ</td>
                    <td>tranthib@email.com</td>
                    <td><button class="btn btn-primary">Xem</button></td>
                </tr>
                <!-- Thêm các dòng dữ liệu khác tương tự ở đây -->
            </tbody>
        </table>

        <!-- Bảng Học sinh đăng ký -->
        <h2>Học sinh đăng ký</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã định danh</th>
                    <th>Họ và tên</th>
                    <th>Giới tính</th>
                    <th>Email</th>
                    <th>Trang cá nhân</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dữ liệu mẫu cho bảng Học sinh đăng ký -->
                <tr>
                    <td>1</td>
                    <td>HS001</td>
                    <td>Phạm Văn C</td>
                    <td>Nam</td>
                    <td>phamvanc@email.com</td>
                    <td><button class="btn btn-primary">Xem</button></td>
                </tr>
                <!-- Thêm các dòng dữ liệu khác tương tự ở đây -->
            </tbody>
        </table>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>