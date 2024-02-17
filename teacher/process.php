<?php
include_once('../config/connect.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_course"])) {
    $teacher_id = $_SESSION['user_id'];
    // Lấy thông tin từ form
    $course_name = $_POST["course_name"];
    $course_code = $_POST["course_code"];
    $course_description = $_POST["course_description"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];

    // Xử lý tệp tin ảnh
    if (isset($_FILES["course_image"])) {
        $fileTmpName = $_FILES["course_image"]["tmp_name"];
        $fileSize = $_FILES["course_image"]["size"];
        $fileError = $_FILES["course_image"]["error"];

        if ($fileError === 0) {
            $fileName = $course_code . "_" . $_FILES["course_image"]["name"];

            $uploadDestination = "../assets/file/course_background/" . $fileName;
            move_uploaded_file($fileTmpName, $uploadDestination);
        } else {
            // Xử lý lỗi khi tải lên tệp tin
            echo "Có lỗi xảy ra khi tải lên tệp tin.";
        }
    }

    $sql_create_course = "INSERT INTO course (course_background, course_code, course_name, course_description, teacher_id, start_date, end_date, status)
    VALUES ('$fileName', '$course_code', '$course_name', '$course_description', '$teacher_id', '$start_date', '$end_date', 'N')";

    if (mysqli_query($dbconnect, $sql_create_course)) {
        $sql_course_id = "SELECT course_id FROM course WHERE course_code = '$course_code'";
        $result_course_id = mysqli_query($dbconnect, $sql_course_id);
        $row_course_id = mysqli_fetch_assoc($result_course_id);
        $_SESSION['course_id'] = $row_course_id['course_id'];
        header("Location: create_schedule.php");
        exit();
    } else {
        die("Something went wrong. Error: " . mysqli_error($dbconnect));
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_schedule"])) {
    // Lấy thông tin từ form
    $dayOfWeeks = $_POST["dayOfWeek"];
    $startTimes = $_POST["startTime"];
    $endTimes = $_POST["endTime"];

    // Kiểm tra xem có dữ liệu được gửi hay không
    if (!empty($dayOfWeeks) && !empty($startTimes) && !empty($endTimes)) {
        // Lặp qua từng hàng và hiển thị thông tin
        for ($i = 0; $i < count($dayOfWeeks); $i++) {
            switch ($dayOfWeeks[$i]) {
                case "monday":
                    $dayOfWeek = "2";
                    break;
                case "tuesday":
                    $dayOfWeek = "3";
                    break;
                case "wednesday":
                    $dayOfWeek = "4";
                    break;
                case "thursday":
                    $dayOfWeek = "5";
                    break;
                case "friday":
                    $dayOfWeek = "6";
                    break;
                case "saturday":
                    $dayOfWeek = "7";
                    break;
                case "sunday":
                    $dayOfWeek = "C";
                    break;
            }
            $startTime = $startTimes[$i];
            $endTime = $endTimes[$i];

            $course_id = $_SESSION['course_id'];

            $sql_schedule = "INSERT INTO course_schedule (course_id, day_of_week, start_time, end_time)
            VALUES ($course_id, '$dayOfWeek', '$startTime', '$endTime') ";
            mysqli_query($dbconnect, $sql_schedule);
        }
        header("Location: success_create_course.php");
        exit();
    } else {
        echo "Không có dữ liệu được gửi từ form.";
    }
}
if (isset($_POST['edit_teacher'])) {
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
        image = '$target_file'
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

    // Chuyển hướng về trang danh sách người dùng hoặc thực hiện hành động khác tùy thuộc vào logic của bạn.
    header("Location: index.php");
    exit();
}
?>