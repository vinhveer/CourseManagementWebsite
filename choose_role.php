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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Chọn vai trò người dùng</title>
    <style>
        /* Custom styles to center content */
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .text-center {
            text-align: center;
        }

        img {
            max-width: 50%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .card {
            margin: 10px;
        }
    </style>
</head>

<body>
    <h3 class="mb-4 text-center">Chọn vai trò người dùng của bạn</h3>

    <form method="post">
        <div class="container d-flex justify-content-center text-center">
            <!-- Option 1: Giáo viên -->
            <button type="submit" class="card mb-3" style="width: 18rem;" name="sbm" value="teacher">
                <img src="assets\images\pngegg.png" alt="Giáo viên" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Giáo viên</h5>
                </div>
            </button>

            <!-- Option 2: Học sinh -->
            <button type="submit" class="card mb-3" style="width: 18rem;" name="sbm" value="student">
                <img src="assets\images\—Pngtree—teachers   cartoon student_4087234.png" alt="Học sinh" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Học sinh</h5>
                </div>
            </button>

            <!-- Option 3: Cả hai vai trò -->
            <button type="submit" class="card mb-3" style="width: 18rem;" name="sbm" value="both">
                <img src="assets\images\9269766.png" alt="Cả hai vai trò" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Chọn cả hai vai trò</h5>
                </div>
            </button>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-rqI2waM7CtpVHmUnY9NXfQTKc3N8RBLtbl6TbY3b3NC6HjbF2wF81v11z5KnMK17" crossorigin="anonymous"></script>
</body>

</html>
