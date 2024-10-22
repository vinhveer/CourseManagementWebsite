CREATE DATABASE course_management;

USE course_management;

CREATE TABLE user
(
    user_id BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    full_name VARCHAR(50) NOT NULL,
    date_of_birth DATE NOT NULL ,
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
CREATE TABLE topics (
    topic_id INT AUTO_INCREMENT PRIMARY KEY,
    title_topic VARCHAR(255) NOT NULL,
    course_id INT,
    description TEXT,
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES course(course_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE course_contents (
    contents_id INT AUTO_INCREMENT PRIMARY KEY,
    topic_id INT NOT NULL,
    title_content VARCHAR(255) NOT NULL,
    content_type VARCHAR(100) NOT NULL,
    description_content TEXT,
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (topic_id) REFERENCES topics(topic_id) ON DELETE CASCADE ON UPDATE CASCADE

);

CREATE TABLE video_contents (
    video_id INT AUTO_INCREMENT PRIMARY KEY,
    course_content_id INT,
    video_url VARCHAR(255) NOT NULL,
    video_size DECIMAL,
    FOREIGN KEY (course_content_id) REFERENCES course_contents(contents_id) ON DELETE CASCADE ON UPDATE CASCADE

);

CREATE TABLE embedded_contents (
    embedded_id INT AUTO_INCREMENT PRIMARY KEY,
    course_content_id INT,
    embed_code TEXT NOT NULL,
    FOREIGN KEY (course_content_id) REFERENCES course_contents(contents_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE file_contents (
    file_id INT AUTO_INCREMENT PRIMARY KEY,
    course_content_id INT,
    file_name VARCHAR(255) NOT NULL,
    file_size DECIMAL,
    FOREIGN KEY (course_content_id) REFERENCES course_contents(contents_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE text_contents (
    text_id INT AUTO_INCREMENT PRIMARY KEY,
    course_content_id INT,
    text_content TEXT NOT NULL,
    FOREIGN KEY (course_content_id) REFERENCES course_contents(contents_id) ON DELETE CASCADE ON UPDATE CASCADE
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
ON DELETE CASCADE ON UPDATE CASCADE;
