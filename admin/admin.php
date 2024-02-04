<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Quản Lý Quản Trị Hệ Thống</title>
</head>
<body>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <h2>Quản Lý Quản trị hệ thống</h2>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Tìm kiếm" aria-label="Tìm kiếm">
                    <button class="btn btn-outline-primary" type="submit">Tìm</button>
                </form>
            </div>
            <div class="col-md-6 text-right">
                <button class="btn btn-primary" type="button" onclick="loadContent('ad_create_acc')">Tạo Tài Khoản Mới</button>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mã Giáo Viên</th>
                            <th>Họ Tên Giáo Viên</th>
                            <th>Ngày Sinh</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Tính Năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>HS001</td>
                            <td>Nguyen Van A</td>
                            <td>01/01/2000</td>
                            <td>user001</td>
                            <td>********</td>
                            <td>
                                <button class="btn btn-info btn-sm">Sửa</button>
                                <button class="btn btn-danger btn-sm">Xóa</button>
                                <button class="btn btn-info btn-sm">Phân quyền</button>
                            </td>
                        </tr>
                        <!-- Thêm các dòng dữ liệu khác tương tự -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>