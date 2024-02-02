<?php
include_once('config/connect.php');

try {
    if (empty($_SESSION['mySession'])) {
        if (isset($cookie_name)) {
            if (isset($_COOKIE[$cookie_name]) == 1) {
                $a = $_COOKIE[$cookie_name];
                parse_str($a, $res);
                $usr = $res['usr'];
                $hash = $res['hash'];

                header('location:index.php');
                exit;
            }
        }
    } else {
        header('location:index.php');
        exit;
    }

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $a_check = ((isset($_POST['remember']) != 0) ? 1 : "");

        if ($username == "" || $password == "") {
            echo "Vui lòng điền đầy đủ thông tin";
            exit;
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

                    $_SESSION['username'] = $f_user;
                    $_SESSION['password'] = $f_pass;

                    if ($a_check == 1) {
                        setcookie($cookie_name, 'usr=' . $f_user . '&hash=' . $f_pass, time() + $cookie_time);
                    }

                    $sql_role = "SELECT r.role_name FROM user_account ua
                        INNER JOIN user_role ur ON ua.user_id = ur.user_id
                        INNER JOIN role r ON ur.role_id = r.role_id 
                        WHERE ua.username = '$username'";

                    $result_role = mysqli_query($dbconnect, $sql_role);

                    if ($result_role) {
                        $row_role = mysqli_fetch_assoc($result_role);

                        if ($row_role) {
                            if ($row_role['role_name'] == "student") {
                                header('location:student/index.php');
                                exit;
                            } else if ($row_role['role_name'] == "teacher") {
                                header('location:teacher/index.php');
                                exit;
                            } else {
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
    <title>Login Page</title>
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
            <div class="container">
                <a class="navbar-brand" href="#" onclick="loadContent('home')">LMS</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="login.php" class="nav-link">Đăng nhập</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <header class="text-center">
            <h3>Đăng nhập</h3>
        </header>

        <div class="container mt-5 login-container">
            <div class="row justify-content-center">
                <div class="col-md-14">
                    <div class="card">
                        <div class="card-body">
                            <form action="login.php" method="post">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Tên đăng nhập</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Mật khẩu</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <!-- <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember" value="1">
                                    <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                                </div> -->
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
