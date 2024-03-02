<?php
include_once('../config/connect.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['edit_student'])) {
    echo "Hoàn thanh";
    // Lấy dữ liệu từ form
    $full_name = mysqli_real_escape_string($dbconnect, $_POST['full_name']);
    $citizen_id = mysqli_real_escape_string($dbconnect, $_POST['citizen_id']);
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $phone = mysqli_real_escape_string($dbconnect, $_POST['phone']);
    $email = mysqli_real_escape_string($dbconnect, $_POST['email']);
    $address = mysqli_real_escape_string($dbconnect, $_POST['address']);
    $teacher_id = $_SESSION['user_id'];

    // Kiểm tra xem người dùng có tải lên ảnh mới không
    if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
        // Xử lý tải lên ảnh mới
        $target_dir = "../assets/images/";
        $image_name=$_FILES["image"]["name"];
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        // Cập nhật thông tin người dùng trong cơ sở dữ liệu
        $update_user_query = "UPDATE user SET
        full_name = '$full_name',
        citizen_id = '$citizen_id',
        date_of_birth = '$date_of_birth',
        gender = '$gender',
        phone = '$phone',
        email = '$email',
        address = '$address',
        image = '$image_name'
        WHERE user_id = $teacher_id";
        mysqli_query($dbconnect, $update_user_query);
    } else {
        $update_user_query = "UPDATE user SET
        full_name = '$full_name',
        citizen_id = '$citizen_id',
        date_of_birth = '$date_of_birth',
        gender = '$gender',
        phone = '$phone',
        email = '$email',
        address = '$address'
        WHERE user_id = $teacher_id";
        mysqli_query($dbconnect, $update_user_query);
    }

    header("Location: index.php");
    exit();
}
