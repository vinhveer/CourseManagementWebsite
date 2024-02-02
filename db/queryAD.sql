USE course_management;

-- Đăng nhập
SET @input_username = 'nguyenminhtai';
SET @input_password = 'dododododo';

SELECT ua.username, ua.password, r.role_name
FROM user_account ua
INNER JOIN user us ON ua.user_id = us.user_id
INNER JOIN user_role ur ON us.user_id = ur.user_id
INNER JOIN role r ON ur.role_id = r.role_id
WHERE ua.username = @input_username
AND ua.password = @input_password;

-- Khóa học
SELECT co.course_code, co.course_name, co.course_description
FROM course co
INNER JOIN course_member cm ON co.course_id = cm.course_id;

-- Học sinh
SELECT us.user_id,us.full_name,us.date_of_birth,ua.username, ua.password
FROM user us
INNER JOIN user_role ur ON us.user_id = ur.user_id
INNER JOIN user_account ua ON ua.user_id = us.user_id
WHERE ur.role_id = 1;

--Add HS

SELECT * FROM user;
INSERT INTO user (full_name, date_of_birth,gender,address,phone,email,citizen_id,image) VALUES ('$name','$birth','$gender',
'$address','$phone','$email','citizen_id','$image');

--Sửa HS
SELECT *
FROM user us
INNER JOIN user_role ur ON us.user_id = ur.user_id
INNER JOIN user_account ua ON ua.user_id = us.user_id
WHERE ur.role_id = 1 AND us.user_id=1;

UPDATE user SET user_id='$id',full_name='$name', date_of_birth = '$birth',gender ='$gender',
address = '$address',phone = '$phone',email='$email',citizen_id = 'citizen_id',image='$image' WHERE user_id='$id';

--Xóa HS
SELECT *
FROM user us
INNER JOIN user_role ur ON us.user_id = ur.user_id
INNER JOIN user_account ua ON ua.user_id = us.user_id
WHERE ur.role_id = 1 AND us.user_id=1;

DELETE FROM user WHERE user_id='$id'

-- Xem TT HS
SELECT us.user_id,us.full_name,us.date_of_birth,ua.username, ua.password
FROM user us
INNER JOIN user_role ur ON us.user_id = ur.user_id
INNER JOIN user_account ua ON ua.user_id = us.user_id
WHERE ur.role_id = 1 AND us.user_id=1;

-- Giáo viên
SELECT us.user_id,us.full_name,us.date_of_birth,ua.username, ua.password
FROM user us
INNER JOIN user_role ur ON us.user_id = ur.user_id
INNER JOIN user_account ua ON ua.user_id = us.user_id
WHERE ur.role_id = 2;

--Add GV

SELECT * FROM user;
INSERT INTO user (full_name, date_of_birth,gender,address,phone,email,citizen_id,image) VALUES ('$name','$birth','$gender',
'$address','$phone','$email','citizen_id','$image');

--Sửa GV
SELECT *
FROM user us
INNER JOIN user_role ur ON us.user_id = ur.user_id
INNER JOIN user_account ua ON ua.user_id = us.user_id
WHERE ur.role_id = 2 AND us.user_id=1;

UPDATE user SET user_id='$id',full_name='$name', date_of_birth = '$birth',gender ='$gender',
address = '$address',phone = '$phone',email='$email',citizen_id = 'citizen_id',image='$image' WHERE user_id='$id';

--Xóa GV
SELECT *
FROM user us
INNER JOIN user_role ur ON us.user_id = ur.user_id
INNER JOIN user_account ua ON ua.user_id = us.user_id
WHERE ur.role_id = 2 AND us.user_id=1;

DELETE FROM user WHERE user_id='$id'

-- Xem TT GV
SELECT us.user_id,us.full_name,us.date_of_birth,ua.username, ua.password
FROM user us
INNER JOIN user_role ur ON us.user_id = ur.user_id
INNER JOIN user_account ua ON ua.user_id = us.user_id
WHERE ur.role_id = 1 AND us.user_id=1;

--Admin
SELECT us.user_id,us.full_name,us.date_of_birth,ua.username, ua.password
FROM user us
INNER JOIN user_role ur ON us.user_id = ur.user_id
INNER JOIN user_account ua ON ua.user_id = us.user_id
WHERE ur.role_id = 3;

--Add AD

SELECT * FROM user;
INSERT INTO user (full_name, date_of_birth,gender,address,phone,email,citizen_id,image) VALUES ('$name','$birth','$gender',
'$address','$phone','$email','citizen_id','$image');

--Sửa AD
SELECT *
FROM user us
INNER JOIN user_role ur ON us.user_id = ur.user_id
INNER JOIN user_account ua ON ua.user_id = us.user_id
WHERE ur.role_id = 3 AND us.user_id=1;

UPDATE user SET user_id='$id',full_name='$name', date_of_birth = '$birth',gender ='$gender',
address = '$address',phone = '$phone',email='$email',citizen_id = 'citizen_id',image='$image' WHERE user_id='$id';

--Xóa AD
SELECT *
FROM user us
INNER JOIN user_role ur ON us.user_id = ur.user_id
INNER JOIN user_account ua ON ua.user_id = us.user_id
WHERE ur.role_id = 3 AND us.user_id=1;

DELETE FROM user WHERE user_id='$id'

-- Xem TT AD
SELECT us.user_id,us.full_name,us.date_of_birth,ua.username, ua.password
FROM user us
INNER JOIN user_role ur ON us.user_id = ur.user_id
INNER JOIN user_account ua ON ua.user_id = us.user_id
WHERE ur.role_id = 3 AND us.user_id=1;
