<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Tiến hành cài đặt</title>
</head>

<body>
    <div class="container mt-5">
        <h3>Tiến hành cài đặt</h3>
    </div>
</body>

</html>
<?php
if (isset($_POST['install'])) {
    if (isset($_POST['dbPath'], $_POST['dbUsername'], $_POST['dbPassword'])) {
        $dbPath = $_POST['dbPath'];
        $dbUsername = $_POST['dbUsername'];
        $dbPassword = $_POST['dbPassword'];

        // Kết nối đến MySQL Server
        $mysqli = new mysqli($dbPath, $dbUsername, $dbPassword);

        // Kiểm tra kết nối
        if ($mysqli->connect_error) {
            die("Kết nối không thành công: " . $mysqli->connect_error);
        }

        $dbName = "course_management";
        // Tạo database
        $query = "CREATE DATABASE IF NOT EXISTS $dbName";
        if ($mysqli->query($query) === TRUE) {
            echo "Database đã được tạo hoặc đã tồn tại.<br>";
            // Chọn database mới tạo
            $mysqli->select_db($dbName);

            // Thực hiện các lệnh SQL
            $sqlCommands = "
        CREATE TABLE user (
            user_id BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            full_name VARCHAR(50) NOT NULL,
            date_of_birth DATE NOT NULL,
            gender CHAR(1) NOT NULL,
            address VARCHAR(255) NOT NULL,
            phone VARCHAR(15) NOT NULL,
            email VARCHAR(255) NOT NULL,
            citizen_id VARCHAR(15) NOT NULL,
            image VARCHAR(255) NULL
        );

        CREATE TABLE user_role
        (
            user_id BIGINT NOT NULL,
            role_id INT  NOT NULL,
            PRIMARY KEY (user_id, role_id)
        );

        CREATE TABLE role
        (
            role_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            role_name VARCHAR(30) NOT NULL
        );

        CREATE TABLE user_account
        (
            account_id BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            username VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            user_id BIGINT NOT NULL
        );

        CREATE TABLE course
        (
            course_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            course_background VARCHAR(255),
            course_code VARCHAR(10) NOT NULL,
            course_name VARCHAR(255) NOT NULL,
            course_description TEXT NOT NULL,
            teacher_id BIGINT NOT NULL,
            start_date DATE NOT NULL,
            end_date DATE NOT NULL,
            status CHAR(1) NOT NULL
        );

        CREATE TABLE course_schedule
        (
        course_schedule_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
        course_id INT NOT NULL,
        day_of_week VARCHAR(1) NOT NULL,
        start_time TIME NOT NULL,
        end_time TIME NOT NULL
        );

        CREATE TABLE course_member
        (
        member_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
        course_id INT NOT NULL,
        student_id BIGINT NOT NULL
        );

        CREATE TABLE grade_column
        (
        column_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
        course_id INT NOT NULL,
        grade_column_name VARCHAR(255) NOT NULL,
        proportion INT NOT NULL
        );

        CREATE TABLE grade
        (
        grade_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
        column_id INT NOT NULL,
        member_id INT NOT NULL,
        score DECIMAL
        );

        CREATE TABLE post
        (
            post_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            user_id BIGINT NOT NULL,
            course_id INT,
            title VARCHAR(255) NOT NULL,
            content TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE CASCADE ON UPDATE CASCADE,
            FOREIGN KEY (course_id) REFERENCES course(course_id) ON DELETE SET NULL ON UPDATE CASCADE
        );

        ALTER TABLE user_account
        ADD CONSTRAINT fk_user_account_user_id FOREIGN KEY (user_id) REFERENCES user(user_id)
        ON DELETE CASCADE ON UPDATE CASCADE;

        ALTER TABLE user_role
        ADD CONSTRAINT fk_user_role_user_id FOREIGN KEY (user_id) REFERENCES user(user_id)
        ON DELETE CASCADE ON UPDATE CASCADE;

        ALTER TABLE user_role
        ADD CONSTRAINT fk_user_role_role_id FOREIGN KEY (role_id) REFERENCES role(role_id)
        ON DELETE CASCADE ON UPDATE CASCADE;

        ALTER TABLE course_member
        ADD CONSTRAINT fk_course_member_student_id FOREIGN KEY (student_id) REFERENCES user(user_id)
        ON DELETE CASCADE ON UPDATE CASCADE;

        ALTER TABLE course
        ADD CONSTRAINT fk_course_teacher_id FOREIGN KEY (teacher_id) REFERENCES user(user_id)
        ON DELETE CASCADE ON UPDATE CASCADE;

        ALTER TABLE course_member
        ADD CONSTRAINT fk_course_member_course_id FOREIGN KEY (course_id) REFERENCES course(course_id)
        ON DELETE CASCADE ON UPDATE CASCADE;

        ALTER TABLE grade
        ADD CONSTRAINT fk_grade_member_id FOREIGN KEY (member_id) REFERENCES course_member(member_id)
        ON DELETE CASCADE ON UPDATE CASCADE;

        ALTER TABLE course_schedule
        ADD CONSTRAINT fk_course_schedule_course_id FOREIGN KEY (course_id) REFERENCES course(course_id)
        ON DELETE CASCADE ON UPDATE CASCADE;

        ALTER TABLE grade
        ADD CONSTRAINT fk_grade_column_id FOREIGN KEY (column_id) REFERENCES grade_column(column_id)
        ON DELETE CASCADE ON UPDATE CASCADE;";

            if ($mysqli->multi_query($sqlCommands)) {
                echo "Các bảng đã được tạo thành công.";
            } else {
                echo "Lỗi khi tạo bảng: " . $mysqli->error;
            }
        } else {
            echo "Lỗi khi tạo database: " . $mysqli->error . "<br>";
        }
    } else {
        echo "<p>Chưa nhập thông tin!</p>";
    }
}
?>