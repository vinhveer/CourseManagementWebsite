<?php
include("layout.php");
session_start();

// Clear session variables
$_SESSION = array();

// Destroy the session
session_destroy();
// Delete cookie
setcookie("abc", "", time() - 3600);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Đăng xuất</title>
</head>

<body>
    <div class="container mt-5">
        <div id="content">
            <h2>Bạn đã đăng xuất!</h2>
            <p>Vui lòng <a href="login.php">đăng nhập</a> để tiếp tục.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php include('footer.php'); ?>
</body>

</html>