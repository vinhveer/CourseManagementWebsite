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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Trang chủ</title>
</head>
<body>
    <header class="container mt-4">
        <h2>
        </h2>
    </header>
</body>
</html>