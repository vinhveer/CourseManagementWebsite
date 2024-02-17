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
    <style>
        img {
            max-width: 50%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .container {
            margin-top: 70px;
            /* Có thể điều chỉnh giá trị theo ý muốn */
        }
    </style>
</head>

<body>
    <div class="container"></div>
    <h3 class="mb-4 text-center">Chọn vai trò người dùng của bạn</h3>

    <form class="form-group" method="post">
        <div class="container d-flex justify-content-center">
            <!-- Option 1: Giáo viên -->
            <button type="submit" class="card mb-3 me-3" style="width: 18rem;" name="sbm" value="teacher">
                <img src="assets\images\pngegg.png" alt="Giáo viên" class="card-img-top">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title text-center">Giáo viên</h5>
                </div>
            </button>

            <!-- Option 2: Học sinh -->
            <button type="submit" class="card mb-3 me-3" style="width: 18rem;" name="sbm" value="student">
                <img src="assets\images\—Pngtree—teachers   cartoon student_4087234.png" alt="Học sinh" class="card-img-top">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title text-center">Học sinh</h5>
                </div>
            </button>

            <!-- Option 3: Cả hai vai trò -->
            <button type="submit" class="card mb-3 me-3" style="width: 18rem;" name="sbm" value="both">
                <img src="assets\images\9269766.png" alt="Cả hai vai trò" class="card-img-top">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title text-center">Chọn cả hai vai trò</h5>
                </div>
            </button>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-rqI2waM7CtpVHmUnY9NXfQTKc3N8RBLtbl6TbY3b3NC6HjbF2wF81v11z5KnMK17" crossorigin="anonymous"></script>
</body>

</html>