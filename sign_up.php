
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Success</title>
    <style>
        .navbar {
            z-index: 1000;
        }
        #content {
            padding-top: 100px;
            /* Adjust the padding-top as needed */
        }

        header.container {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" onclick="loadContent('home')">LMS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
    <div class="container mt-3"> <!-- Add the mt-5 class for extra top margin -->
        <div id="content">
            <h2>Đăng ký thành công!</h2>
            <p>Truy cập vào <a href="login.php">đây</a> để đăng nhập.</p>
        </div>
    </div>

    <!-- Additional content can be added here -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php include("footer.php"); ?>
</body>

</html>
