<?php
include_once('../../../config/connect.php');

session_start();

// Mặc định, người dùng chưa đăng nhập
$username_now = "User not logged in";

// Kiểm tra nếu người dùng đã đăng nhập
if (isset($_SESSION['username'])) {
    $username_now = $_SESSION['full_name'];
}
else 
{
    $username_now = "User not logged in";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script type="module" src="https://md-block.verou.me/md-block.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/showdown/1.9.1/showdown.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-b5H77Uo08fR+55Ar//Tw9c5n5k+K1a4H6Ou2EsPAd+pM6J6/wb18qv3Zlrse8lf+9GyCo62Gc9DD4egQe+T9Rg==" crossorigin="anonymous" />
  <title>Xem khóa học chi tiết</title>
  <style>
    .navbar {
      z-index: 1000;
    }

    #content {
      padding-top: 30px;
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Điểm số</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="loadContent('summary'); hideNavbar()">Tổng quan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="loadContent('grade_column'); hideNavbar()">Cột điểm</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="loadContent('grade_member'); hideNavbar()">Điểm số</a>
          </li>
          <li class="nav-item dropdown">
                  <?php if (isset($username_now)) : ?>
                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                              data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span>
                                  <?php echo $username_now; ?>
                              </span>
                              <img src="../../../assets/images/course1.jpg" alt="Avatar" class="rounded-circle" width="30"
                                  height="30">
                          </a>
                      <?php endif; ?>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#" onclick="loadContent('my')">Trang cá nhân</a>
              <a class="dropdown-item" href="../index.php?id=<?php echo $_SESSION['course_id']; ?>">Trang khóa học</a>
              <a class="dropdown-item" href="../../index.php">Trang chủ</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="../../../logout.php">Đăng xuất</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page content -->
  <div class="container-fluid mt-5" id="content">
    <!-- Content will be loaded here -->
  </div>

  <!-- Bootstrap JavaScript dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Trong đoạn mã JavaScript của bạn -->
  <script>
    // Load content for 'home' when the page is loaded
    document.addEventListener('DOMContentLoaded', function () {
      loadContent('summary');
    });

    function loadContent(page) {
      // Fetch and load content based on the clicked page
      fetch(`${page}.php`)
        .then(response => response.text())
        .then(html => {
          document.getElementById('content').innerHTML = html;

          // Cập nhật tiêu đề trang
          document.getElementById('pageTitle').innerText = page;
        });

      // Load specific CSS for the clicked page
      const head = document.head;
      const link = document.createElement('link');
      link.type = 'text/css';
      link.rel = 'stylesheet';
      link.href = `${page}.css`;
      head.appendChild(link);
    }

    function hideNavbar() {
      // Ẩn navbar khi click vào một li trong navbar
      const navbar = document.querySelector('.navbar-collapse');
      if (navbar.classList.contains('show')) {
        navbar.classList.remove('show');
      }
    }
  </script>

</body>

</html>