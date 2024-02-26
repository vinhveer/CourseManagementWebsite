<?php
session_start();
include_once('layout.php');
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sbm'])) {
    $_SESSION['role'] = $_POST['sbm'];
    header("location: set_account.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chọn vai trò người dùng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofMhU+3vxiL6lFfQ8+pPUEbjvSwlO9aP9" crossorigin="anonymous">
    <style>
        img {
            max-width: 50%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        /* Điều chỉnh style cho các card */
        .card {
            width: 18rem;
            margin-right: 1rem; /* Khoảng cách giữa các card */
        }

        /* Căn giữa card trong container */
        .container {
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <header class="text-center"></header>
    <form class="form-group" method="post">
        <div class="container mt-4">
            <h3 class="text-center mb-5">Chọn vai trò người dùng của bạn</h3>
        </div>
        <div class="container align-items-center">
            <button type="submit" class="card mb-3" name="sbm" value="teacher">
                <img src="assets\images\pngegg.png" alt="Giáo viên">
                <div class="container mt-4 mb-4">
                    <h5 class="text-center">Giáo viên</h5>
                </div>
            </button>

            <button type="submit" class="card mb-3" name="sbm" value="student">
                <img src="assets\images\—Pngtree—teachers   cartoon student_4087234.png" alt="Học sinh">
                <div class="container mt-4 mb-4">
                    <h5 class="text-center">Học sinh</h5>
                </div>
            </button>

            <button type="submit" class="card mb-3" name="sbm" value="both">
                <img src="assets\images\9269766.png" alt="Cả hai vai trò">
                <div class="container mt-4 mb-4">
                    <h5 class="text-center">Cả hai vai trò</h5>
                </div>
            </button>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-rqI2waM7CtpVHmUnY9NXfQTKc3N8RBLtbl6TbY3b3NC6HjbF2wF81v11z5KnMK17" crossorigin="anonymous"></script>
</body>

</html>
