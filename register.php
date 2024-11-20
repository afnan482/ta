<?php
include("../User/config.php");

if (!empty($_SESSION["id"])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $role = 'user'; // Role di-set menjadi 'user'

    // Prepared statement untuk memeriksa duplikasi username/email
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Username or Email has Already Taken');</script>";
    } else {
        if ($password == $confirmpassword) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash password

            // Insert data pengguna menggunakan prepared statement
            $stmt = $conn->prepare("INSERT INTO user (name, username, email, password, role) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $name, $username, $email, $hashed_password, $role);
            $stmt->execute();

            echo "<script>alert('Register Successful');</script>";
            header("Location: login.php");
            exit();
        } else {
            echo "<script>alert('Password Does Not Match');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <form action="" method="post" autocomplete="off">
            <h1>Register</h1>
            <div class="input-box">
                <input type="text" name="name" id="name" placeholder="Name" required> <br>
            </div>
            <div class="input-box">
                <input type="text" name="username" id="username" placeholder="Username" required> <br>
            </div>
            <div class="input-box">
                <input type="text" name="email" id="email" placeholder="Email" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" id="password" placeholder="Password" required> <br>
            </div>
            <div class="input-box">
                <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" required> <br>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Register</button>
            <div class="register-link">
                <p>Sudah Punya Akun? <a href="login.php">Login</a></p>
            </div>
        </form>
    </div>
</body>
</html>
