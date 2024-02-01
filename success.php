<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success Page</title>
</head>

<body>
    <?php
    include_once('login.php');

    // Check if the user is logged in
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];

        // Fetch user details from the database
        $sql = "SELECT u.full_name, ua.username
                FROM user u
                INNER JOIN user_account ua ON u.user_id = ua.user_id
                WHERE ua. = '$username'";
        $result = mysqli_query($dbconnect, $sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);

            // Display user information
            echo "<p><strong>Họ và tên:</strong> " . $row['full_name'] . "</p>";
            echo "<p><strong>Username:</strong> " . $row['username'] . "</p>";

            // You can add more fields as needed
        } else {
            echo "Error fetching user information: " . mysqli_error($dbconnect);
        }
    } else {
        echo "User not logged in!";
    }
    ?>
</body>

</html>
