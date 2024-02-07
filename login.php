<?php
include_once('config/connect.php');

session_start();
try {
    if (isset($cookie_name)) {
        if (isset($_COOKIE[$cookie_name]) == 1) {
            $cookie_data = $_COOKIE[$cookie_name];
            parse_str($cookie_data, $cookie_values);

            if (isset($cookie_values['usr']) && isset($cookie_values['hash'])) {
                $stored_username = $cookie_values['usr'];
                $stored_password = $cookie_values['hash'];

                $sql = "SELECT * FROM user_account WHERE username='$stored_username' AND password='$stored_password'";
                $result = mysqli_query($dbconnect, $sql);
                if ($result) {
                    if ($row = mysqli_fetch_array($result)) {
                        $sql_role = "SELECT r.role_name FROM user_account ua
                                INNER JOIN user_role ur ON ua.user_id = ur.user_id
                                INNER JOIN role r ON ur.role_id = r.role_id
                                WHERE ua.username = '$stored_username'";

                        $result_r = mysqli_query($dbconnect, $sql_role);
                        if ($result_r) {
                            if ($row_role = mysqli_fetch_assoc($result_r)) {
                                switch ($row_role['role_name']) {
                                    case "student":
                                        header('location:student/index.php');
                                        exit;
                                    case "teacher":
                                        header('location:teacher/index.php');
                                        exit;
                                    case "admin":
                                        header('location:admin/index.php');
                                        exit;
                                    default:
                                        echo "Vai trò không hợp lệ.";
                                        exit;
                                }
                            }
                        } else {
                            echo "Lỗi câu truy vấn vai trò: " . mysqli_error($dbconnect);
                            exit;
                        }
                    }
                }
            }
        }
    }

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $a_check = ((isset($_POST['remember']) != 0) ? 1 : "");

        if ($username == "" || $password == "") {
            $login_error_message = "Thông tin chưa đầy đủ. <br>  Vui lòng nhập đầy đủ thông tin.";
        } else {
            $sql = "SELECT * FROM user_account WHERE username='$username' AND password='$password'";
            $result = mysqli_query($dbconnect, $sql);

            if (!$result) {
                echo "Lỗi câu truy vấn" . mysqli_error($dbconnect);
                exit;
            }

            if ($result) {
                $row = mysqli_fetch_array($result);

                if ($row) {
                    $f_user = $row['username'];
                    $f_pass = $row['password'];

                    if ($a_check == 1) {
                        $_SESSION['username'] = $f_user;
                        $_SESSION['password'] = $f_pass;
                        setcookie($cookie_name, 'usr=' . $f_user . '&hash=' . $f_pass, time() + $cookie_time);
                    }

                    $sql_user = "SELECT us.full_name, us.user_id FROM user us
                    INNER JOIN user_account ua ON us.user_id = ua.user_id
                    WHERE username = '$username'";

                    $result_user = mysqli_query($dbconnect, $sql_user);

                    $row_user = mysqli_fetch_assoc($result_user);

                    $_SESSION['full_name'] = $row_user['full_name'];
                    $_SESSION['user_id'] = $row_user['user_id'];

                    $sql_role = "SELECT r.role_name FROM user_account ua
                        INNER JOIN user_role ur ON ua.user_id = ur.user_id
                        INNER JOIN role r ON ur.role_id = r.role_id
                        WHERE ua.username = '$username'";

                    $result_role = mysqli_query($dbconnect, $sql_role);

                    if ($result_role) {
                        $row_role = mysqli_fetch_assoc($result_role);

            
                if ($row) {
                    $f_user = $row['username'];
                    $f_pass = $row['password'];
            
                    $_SESSION['username'] = $f_user;
                    $_SESSION['password'] = $f_pass;
            
                    $sql_user = "SELECT us.full_name, us.user_id FROM user us
                    INNER JOIN user_account ua ON us.user_id = ua.user_id
                    WHERE username = '$username'";
            
                    $result_user = mysqli_query($dbconnect, $sql_user);
            
                    $row_user = mysqli_fetch_assoc($result_user);
            
                    $_SESSION['full_name'] = $row_user['full_name'];
                    $_SESSION['user_id'] = $row_user['user_id'];
            
                    $sql_role = "SELECT r.role_name FROM user_account ua
                        INNER JOIN user_role ur ON ua.user_id = ur.user_id
                        INNER JOIN role r ON ur.role_id = r.role_id 
                        WHERE ua.username = '$username'";
            
                    $result_role = mysqli_query($dbconnect, $sql_role);
            
                    if ($result_role) {
                        $row_role = mysqli_fetch_assoc($result_role);
            
                        if ($row_role) {
                            if ($row_role['role_name'] == "student") {
                                $_SESSION['role_name'] = $row_role['role_name'];
                                header('location:student/index.php');
                                exit;
                            } else if ($row_role['role_name'] == "teacher") {
                                $_SESSION['role_name'] = $row_role['role_name'];
                                header('location:teacher/index.php');
                                exit;
                            } else {
                                $_SESSION['role_name'] = $row_role['role_name'];
                                header('location:admin/index.php');
                                exit;
                            }
                        } else {
                            echo "Không tìm thấy thông tin vai trò cho người dùng.";
                            exit;
                        }
                    } else {
                        echo "Lỗi câu truy vấn vai trò: " . mysqli_error($dbconnect);
                        exit;
                    }
                } else {
                    $login_error_message = "Tên đăng nhập hoặc mật khẩu không chính xác";
                }
            } else {
                echo "Lỗi câu truy vấn: " . mysqli_error($dbconnect);
                exit;
            }
        }
    }
} catch (Exception $exp) {
    echo $exp->getMessage() . '<br>';
    echo 'File: ' . $exp->getFile() . '<br>';
    echo 'Line: ' . $exp->getLine() . '<br>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Đăng nhập</title>
    <style>
    body {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0;
    }

    .login-container {
        max-width: 400px;
    }
    </style>
</head>

<body>
    <div class="container-fluid">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container-fluid ">
                <a class="navbar-brand" href="#" onclick="loadContent('home')">LMS - Đăng nhập</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link">Trang chủ</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <?php
        if (!empty($login_error_message)) {
            echo '<div class="alert alert-danger mt-3" role="alert">' . $login_error_message . '</div>';
        }
        ?>

        <header class="text-center">
            <h3>Đăng nhập</h3>
        </header>

        <div class="container mt-5 login-container">
            <div class="row justify-content-center">
                <div class="col-md-14">
                    <div class="card">
                        <div class="card-body">
                            <form action="login.php" method="post">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="username" name="username"
                                        placeholder="username">
                                    <label for="username">Tên đăng nhập</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="password">
                                    <label for="password">Mật khẩu</label>
                                </div>

                                 <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember" value="1">
                                    <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" name="submit">Đăng nhập</button>
                                </div>

                                <?php
                                if (!empty($login_error_message)) {
                                    echo '<div class="alert alert-danger mt-3" role="alert">' . $login_error_message . '</div>';
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>