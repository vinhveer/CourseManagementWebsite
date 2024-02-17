<?php

// Kiểm tra xem có phải là yêu cầu POST không
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Kiểm tra xem có file được gửi lên hay không
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $uploadDir = 'uploads/'; // Thay đổi đường dẫn tới thư mục lưu trữ tệp tin
        $uploadFile = $uploadDir . basename($_FILES["file"]["name"]);

        // Đảm bảo tên file là duy nhất
        $i = 1;
        while (file_exists($uploadFile)) {
            $uploadFile = $uploadDir . pathinfo($_FILES["file"]["name"], PATHINFO_FILENAME) . "_" . $i . "." . pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
            $i++;
        }

        // Di chuyển tệp tin đã tải lên vào thư mục lưu trữ
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadFile)) {
            // Trả về phản hồi JSON với đường dẫn của tệp tin
            echo json_encode(["location" => $uploadFile]);
        } else {
            // Trả về phản hồi JSON với thông báo lỗi
            echo json_encode(["error" => "File upload failed"]);
        }
    } else {
        // Trả về phản hồi JSON với thông báo lỗi
        echo json_encode(["error" => "No file uploaded"]);
    }
} else {
    // Trả về phản hồi JSON với thông báo lỗi
    echo json_encode(["error" => "Invalid request"]);
}
?>
