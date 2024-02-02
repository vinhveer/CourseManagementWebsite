USE course_management;

-- Đăng nhập
SET @input_username = 'nguyenquangvinh';
SET @input_password = 'dododododo';

SELECT ua.username, ua.password, r.role_name
FROM user_account ua
INNER JOIN user us ON ua.user_id = us.user_id
INNER JOIN user_role ur ON us.user_id = ur.user_id
INNER JOIN role r ON ur.role_id = r.role_id
WHERE ua.username = @input_username
AND ua.password = @input_password;

-- Khóa học của tôi
SELECT co.course_code, co.course_name, us.full_name
FROM course co
INNER JOIN user us ON co.teacher_id = us.user_id
WHERE us.user_id = 68;

-- Lịch giảng dạy
SELECT co.course_name ,cs.day_of_week, cs.start_time, cs.end_time
FROM course_schedule cs
INNER JOIN course co ON cs.course_id = co.course_id
INNER JOIN user us ON co.teacher_id = us.user_id WHERE us.user_id = 68;

--Khóa học khác
SELECT DISTINCT co_other.course_code, co_other.course_name, us_other.full_name
FROM course co_other
INNER JOIN user us_other ON co_other.teacher_id = us_other.user_id
WHERE us_other.user_id = 68
AND co_other.course_id NOT IN (
    SELECT co.course_id
    FROM course co
    INNER JOIN user us ON co.teacher_id = us.user_id
    WHERE us.user_id = 68
);
--Tính năng khác
-- Cái này chưa có table phòng học lấy ví dụ đăng kí khóa học của giáo viên
SELECT co.course_id, co.course_name, COUNT(*) AS registration_count
FROM course co
INNER JOIN user us ON co.teacher_id = us.user_id
WHERE us.user_id = 68
GROUP BY co.course_id, co.course_name;

-- Trong khóa học, giả sử là INS325
-- Danh sách thành viên khóa học
SELECT us.user_id, us.full_name, co.course_code
FROM course co
INNER JOIN course_member cm ON co.course_id = cm.course_id
INNER JOIN user us ON cm.student_id = us.user_id
WHERE co.course_code = 'INS325';

-- Điểm số thành viên
SELECT us.user_id, us.full_name, co.course_code, gc.grade_column_name, gr.score
FROM course co
INNER JOIN course_member cm ON co.course_id = cm.course_id
INNER JOIN user us ON cm.student_id = us.user_id
INNER JOIN grade gr ON cm.member_id = gr.member_id
INNER JOIN grade_column gc ON gr.column_id = gc.column_id
WHERE co.course_code = 'INS325';

--Tạo bài kiểm tra (tạo cho vụ chứ không bk đúng hay không)
SELECT DISTINCT gc.grade_column_name,gc.proportion
FROM course co
INNER JOIN user us ON co.teacher_id = us.user_id
INNER JOIN course_member cm ON co.course_id = cm.course_id
INNER JOIN grade gr ON cm.member_id = gr.member_id
INNER JOIN grade_column gc ON gr.column_id = gc.column_id
WHERE us.user_id = 68 AND co.course_code = "INS325" AND gc.course_id=1;
INSERT INTO grade_column (column_id,course_id,grade_column_name,proportion) VALUE('$column','$course_id','$name','$proportion');
-- .... Thiếu nhiều table skip
