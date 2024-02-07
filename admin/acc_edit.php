<?php
include("layout.php");
include_once("../config/connect.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$role_id = $_GET['role_id']; $role_name = $_GET['role_name'];
if($role_id == 1){
    $role_fullName = "Học Sinh";
}else if($role_id == 2){
    $role_fullName = "Giáo Viên";
}else if($role_id == 3){
    $role_fullName = "Quản Trị Viên";
}
$id = $_GET['user_id'];
$sql_edit = "SELECT * FROM user where user_id=$id";
$query_update = mysqLi_query($dbconnect, $sql_edit);
$row_update = mysqli_fetch_assoc($query_update);
mysqli_close($dbconnect);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Registration Form</title>
</head>

<body>

    <div class="container mt-5">
        <!-- Header -->
        <div class="row mb-3">
            <div class="col-md-6">
                <h2>Sửa đổi thông tin (<?php echo $role_fullName?>)</h2>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary me-2">Tải lên từ Excel</button>
                    <a class="btn btn-primary" href="<?php echo $role_name;?>.php">Thoát</a>
                </div>
            </div>
        </div>

        <!-- Body - Registration Form -->
        <form action="pross/edit.php?id=<?php echo $_GET['user_id']; ?>" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="fullName" class="form-label">Họ và tên</label>
                <input type="text" class="form-control" name="full_name" id="fullName" required value="<?php echo $row_update['full_name']; ?>" placeholder="Nhập Họ Tên Học Sinh">
            </div>

            <div class="mb-3">
                <label for="dob" class="form-label">Ngày sinh</label>
                <input type="date" class="form-control" name="date_of_birth" id="dob" required value="<?php echo $row_update['date_of_birth']; ?>">
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">Giới tính</label>
                <select class="form-select" name="gender" id="gender" required>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" required value="<?php echo $row_update['email']; ?>" placeholder="Nhập Email">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Số điện thoại</label>
                <input type="tel" class="form-control" name="phone" id="phone" required value="<?php echo $row_update['phone']; ?>" placeholder="Nhập Số điện thoại">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Địa chỉ nhà</label>
                <input class="form-control" name="address" id="address" required value="<?php echo $row_update['address']; ?>" placeholder="Nhập địa chỉ"></input>
            </div>

            <div class="mb-3">
                <label for="idCardNumber" class="form-label">Mã số căn cước công dân</label>
                <input type="text" class="form-control" name="citizen_id" id="idCardNumber" required value="<?php echo $row_update['citizen_id']; ?>" placeholder="Nhập CCCD">
            </div>

            <div class="mb-3">
                <label for="idCardImage" class="form-label">Tải ảnh thẻ lên</label><br>
                <span style="padding-left: 10px;"><img src="/assets/images/<?php echo $row_update['image']; ?>" width="60px"></span> <br><br>
                <input type="file" class="form-control" name="image" id="idCardImage" accept="image/*">
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary" name="sbm">Lưu</button>
                <a type="button" class="btn btn-secondary" href="<?php echo $role_name;?>.php">Thoát</a>
            </div>
        </form>
    </div>

</body>

</html>
