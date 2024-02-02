<?php
session_start();
include_once('../config/connect.php');

// Check if the user is logged in using the session variable
if (isset($_SESSION['username'])) {
    // Get the username from the session
    $username = $_SESSION['username'];

    // Build the SQL query to fetch user information
    $sql_login = "SELECT us.full_name FROM user_account ua
                  INNER JOIN user us ON ua.user_id = us.user_id 
                  WHERE username = '$username'";

    // Execute the query
    $result_login = mysqli_query($dbconnect, $sql_login);

    // Check if the query was successful
    if ($result_login) {
        // Fetch the row associated with the user
        $row_login = mysqli_fetch_assoc($result_login);

        // Check if a valid row was fetched
        if ($row_login) {
            // Assign the full name to $username_now
            $username_now = $row_login['full_name'];
        } else {
            // Handle the case where no valid row is found
            $username_now = "Unknown User";
        }
    } else {
        // Handle the case where the query fails
        $username_now = "Error retrieving user information";
    }
} else {
    // Handle the case where the user is not logged in
    $username_now = "User not logged in";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <title>Learning Management System</title>
  <style>
    .navbar {
      z-index: 1000;
    }

    #content {
      padding-top: 30px;
      /* Adjust as needed based on the height of your navbar */
    }
  </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
          <a class="navbar-brand" href="#">LMS</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav ms-auto">
                  <li class="nav-item">
                      <a class="nav-link" href="#" onclick="loadContent('home'); hideNavbar()">Trang chủ</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#" onclick="loadContent('courses'); hideNavbar()">Khóa học của tôi</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#" onclick="loadContent('othercourses')">Các khóa học khác</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#" onclick="loadContent('schedule')">Lịch giảng dạy</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#" onclick="loadContent('other'); hideNavbar()">Tính năng khác</a>
                  </li>
                  <li class="nav-item dropdown">
                      <?php if (isset($username_now)) : ?>
                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                              data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span>
                                  <?php echo $username_now; ?>
                              </span>
                              <img src="/assets/images/course1.jpg" alt="Avatar" class="rounded-circle" width="30"
                                  height="30">
                          </a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="#" onclick="loadContent('my')">Trang cá nhân</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="/index.php">Đăng xuất</a>
                          </div>
                      <?php endif; ?>
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

  <!-- Custom JavaScript to handle content loading -->
  <script>
    // Load content for 'home' when the page is loaded
    document.addEventListener('DOMContentLoaded', function () {
      loadContent('home');
    });

    function loadContent(page) {
      // Fetch and load content based on the clicked page
      fetch(`${page}.php`)
        .then(response => response.text())
        .then(html => {
          document.getElementById('content').innerHTML = html;
        });

      // Load specific CSS for the clicked page
      const head = document.head;
      const link = document.createElement('link');
      link.type = 'text/css';
      link.rel = 'stylesheet';
      link.href = `${page}.css`;
      head.appendChild(link);
    }
  </script>

</body>

</html>