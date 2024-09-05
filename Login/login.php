<?php
    require 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <title>Login</title>
</head>
<body>
    <form method="post">
    <h1>Log in</h1>
    <label for="user">Username</label>
    <input type="text" name="user" id="user"><br><br>
    <label for="pass">Password</label>
    <input type="password" name="pass" id="pass"><br><br>
    <button type="submit" name="submit">Submit</button>

    <?php
        if (isset($_POST['submit'])) {
            $user = $_POST['user'];
            $pass = $_POST['pass'];

            if (empty($user) || empty($pass)) {
                echo "Please enter username and password";
            } else {
                // Prepare SQL query to fetch the user by username
                $sql = "SELECT * FROM `users` WHERE `username` = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $user);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                // Check if the user exist and verify the password
                if ($row && password_verify($pass, $row['password'])) {
                    // Password is correct, redirect to dashboard
                    if ($row['status'] == 1) {
                        echo '<script>alert("This account is already logged in. Please log in with another account."); window.location.href = "index.php";</script>';
                        exit();
                    }else{
                        $query = "UPDATE `users` SET `status` = '1' WHERE `username` = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("s", $user);
                        $stmt->execute();

                        // Set session variables
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['status'] = $row['status'];

                        // Redirect to the dashboard
                        header("Location: dashboard.php");
                        exit();
                    }
                } else {
                    // Incorrect credentials
                    echo '<p>Incorrect Credentials</p>';
                }
            }
        }
    ?>
    </form>

    <span class="small"></span><p>Not have an account? <a href="register.php" class="btn btn-outline-info">REGISTER</a></p><br>
</body>
</html>
