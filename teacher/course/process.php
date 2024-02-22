<?php
include_once('../../config/connect.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['delete_course'])) {
    // Lấy course_id từ SESSION
    $course_id = $_SESSION['course_id'];

    // Thực hiện thao tác xóa khóa học từ cơ sở dữ liệu
    $sql_delete_course = "DELETE FROM course WHERE course_id = $course_id";
    $result_delete_course = mysqli_query($dbconnect, $sql_delete_course);

    if ($result_delete_course) {
        // Xóa thành công, có thể thực hiện các bước khác nếu cần thiết
        header("location: ../courses.php");
    } else {
        // Xóa thất bại, xử lý lỗi hoặc thông báo cho người dùng
        echo "Không thể xóa khóa học. Lỗi: " . mysqli_error($dbconnect);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["change_cover"])) {
    $course_id =  $_SESSION['course_id'];
    if ($_FILES['new_cover']['size'] > 0) {
        $file_name = $_FILES['new_cover']['name'];
        $file_size = $_FILES['new_cover']['size'];
        $file_tmp = $_FILES['new_cover']['tmp_name'];
        $file_type = $_FILES['new_cover']['type'];

        $upload_dir = "../../assets/file/course_background/";
        $target_file = $upload_dir . basename($file_name);

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
        if (!in_array($imageFileType, $allowed_extensions)) {
            echo "Chỉ chấp nhận tệp ảnh có định dạng JPG, JPEG, PNG, hoặc GIF.";
            exit();
        }
        $max_file_size = 20 * 1024 * 1024;
        if ($file_size > $max_file_size) {
            echo "Kích thước tệp ảnh quá lớn. Vui lòng chọn một tệp ảnh nhỏ hơn.";
            exit();
        }

        if (move_uploaded_file($file_tmp, $target_file)) {
            $sql_update_cover = "UPDATE course SET course_background = '$file_name' WHERE course_id = $course_id";
            mysqli_query($dbconnect, $sql_update_cover);
            echo "Cập nhật ảnh bìa thành công.";
        } else {
            echo "Đã xảy ra lỗi khi tải lên tệp ảnh.";
        }
        header('location: edit_course.php');
    }
}

if (isset($_POST['edit_course'])) {
    // Lấy dữ liệu từ form
    $course_name = mysqli_real_escape_string($dbconnect, $_POST['course_name']);
    $course_code = mysqli_real_escape_string($dbconnect, $_POST['course_code']);
    $course_description = mysqli_real_escape_string($dbconnect, $_POST['course_description']);
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $course_id = $_SESSION['course_id'];

    // Cập nhật thông tin khóa học trong cơ sở dữ liệu
    $update_course_query = "UPDATE course SET
                            course_name = '$course_name',
                            course_code = '$course_code',
                            course_description = '$course_description',
                            start_date = '$start_date',
                            end_date = '$end_date'
                            WHERE course_id = $course_id";

    mysqli_query($dbconnect, $update_course_query);

    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_schedule"])) {
    $course_id = $_SESSION['course_id'];
    $dayOfWeeks = $_POST["dayOfWeek"];
    $startTimes = $_POST["startTime"];
    $endTimes = $_POST["endTime"];

    if (!empty($dayOfWeeks) && !empty($startTimes) && !empty($endTimes)) {
        $scheduleIdsToKeep = array();
        for ($i = 0; $i < count($dayOfWeeks); $i++) {
            $dayOfWeek = $dayOfWeeks[$i];
            $startTime = $startTimes[$i];
            $endTime = $endTimes[$i];
            switch ($dayOfWeek) {
                case "monday":
                    $dayOfWeekValue = "2";
                    break;
                case "tuesday":
                    $dayOfWeekValue = "3";
                    break;
                case "wednesday":
                    $dayOfWeekValue = "4";
                    break;
                case "thursday":
                    $dayOfWeekValue = "5";
                    break;
                case "friday":
                    $dayOfWeekValue = "6";
                    break;
                case "saturday":
                    $dayOfWeekValue = "7";
                    break;
                case "sunday":
                    $dayOfWeekValue = "C";
                    break;
            }

            if (isset($_POST['schedule_id'][$i])) {
                $schedule_id = $_POST['schedule_id'][$i];
                $scheduleIdsToKeep[] = $schedule_id;
                // Nếu có, thực hiện cập nhật thông tin thời khóa biểu
                $sql_schedule = "UPDATE course_schedule SET day_of_week ='$dayOfWeekValue', start_time='$startTime', end_time= '$endTime' where course_schedule_id = $schedule_id";
                mysqli_query($dbconnect, $sql_schedule);
            } else {
                // Nếu không, thực hiện thêm mới thông tin thời khóa biểu
                $sql_schedule = "INSERT INTO course_schedule (course_id, day_of_week, start_time, end_time) VALUES ('$course_id', '$dayOfWeekValue', '$startTime', '$endTime')";
                mysqli_query($dbconnect, $sql_schedule);
                $scheduleIdsToKeep[] = mysqli_insert_id($dbconnect);
            }
        }
        // Xóa thời khóa biểu không có trong khóa học
        $scheduleisset = implode(',', $scheduleIdsToKeep);
        $sql_delete_schedule = "DELETE FROM course_schedule WHERE course_id ='$course_id' AND course_schedule_id NOT IN ($scheduleisset)";
        mysqli_query($dbconnect, $sql_delete_schedule);

        header("Location: index.php");
        exit();
    } else {
        echo "Không có dữ liệu được gửi từ form.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["delete_member_course"])) {
        if (isset($_POST["delete_student_id"])) {
            $student_id = $_POST["delete_student_id"];

            $course_id = $_SESSION['course_id'];

            echo $course_id;
            echo $student_id . " - m";

            $delete_query = "DELETE FROM course_member WHERE course_id = $course_id AND student_id = $student_id";
            $delete_result = mysqli_query($dbconnect, $delete_query);

            if ($delete_result) {
                header("Location: member.php");
                exit();
            } else {
                die('Deletion failed: ' . mysqli_error($dbconnect));
            }
        } else {
            echo "Error: delete_student_id not set";
        }
    }
} else {
    echo "Invalid request method";
}

// Check if the form is submitted
if (isset($_POST['create_post'])) {
    // Retrieve user_id and course_id from the session
    $user_id = $_SESSION["user_id"];
    $course_id = $_SESSION['course_id'];
    $title = mysqli_real_escape_string($dbconnect, $_POST["postTitle"]);
    $content = mysqli_real_escape_string($dbconnect, $_POST["postContent"]);

    $sql = "INSERT INTO post (user_id, course_id, title, content, created_at) VALUES ($user_id, $course_id, '$title', '$content', DEFAULT)";

    mysqli_query($dbconnect, $sql);

    header("Location: post.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['edit_post'])) {
        $post_id = $_GET['post_id'];
        $title = $_POST["postTitle"];
        $content = $_POST["postContent"];
        $sql = "UPDATE post SET title = '$title', content = '$content', created_at = DEFAULT WHERE post_id = $post_id";
        mysqli_query($dbconnect, $sql);
        header("Location: post.php");
        exit();
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_post'])) {
    $post_id = $_GET['post_id'];
    $sql_delete = "DELETE FROM post WHERE post_id = $post_id";
    $result_delete = mysqli_query($dbconnect, $sql_delete);
    if ($result_delete) {
        header("location: post.php");
    } else {
        echo "Không thể xóa. Lỗi: " . mysqli_error($dbconnect);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create_practice"])) {
    $title_practice = $_POST["title_practice"];
    $open_date = $_POST["open_date"];
    $close_date = $_POST["close_date"];
    $content_practice = $_POST["content_practice"];
    $type_submit = $_POST["type_submit"];

    // Check if a file was uploaded
    if (isset($_FILES["upload_file"]) && $_FILES["upload_file"]["error"] == 0) {
        $file_name = $_FILES["upload_file"]["name"];
        $file_tmp = $_FILES["upload_file"]["tmp_name"];
        $file_destination = "../../assets/file/content/" . $file_name;

        if (move_uploaded_file($file_tmp, $file_destination)) {
            echo "File uploaded successfully.";
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "No file uploaded.";
        $file_destination = null; // Set to null if no file is uploaded
    }

    $sql = "INSERT INTO practice (course_id, open_time, close_time, description, file_content, type_question, text_content)
            VALUES (NULL, '$open_date', '$close_date', '$title_practice', '$file_destination', '$type_submit', '$content_practice')";

    if ($dbconnect->query($sql) === TRUE) {
        header("Location: exam.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $dbconnect->error;
    }
}
