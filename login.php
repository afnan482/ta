<?php
include ('../User/config.php');
if(!empty($_SESSION["id"])){
    header("Location: ../User/index.php");
}
if(isset($_POST["submit"])){
    $usernameemail = $_POST["usernameemail"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$usernameemail' OR email = '$usernameemail'");
    $row = mysqli_fetch_assoc($result);

        // Asumsikan sudah ada sesi yang berisi user_id setelah login berhasil
    session_start();
    $user_id = $_SESSION['user_id']; // Ambil user_id dari sesi setelah login berhasil
    $sql = "INSERT INTO logins (user_id) VALUES ('$user_id')";
    $conn->query($sql);


    if(mysqli_num_rows($result) > 0){
        if($password == $row["password"]){
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            $_SESSION["role"] = $row["role"];  // Menyimpan role di session

            // Redirect berdasarkan role
            if($row["role"] == "admin"){
                header("Location: ../admin/home.php");  // Halaman admin
            } else {
                header("Location: ../User/index.php");   // Halaman user
            }
            exit;
        } else {
            echo "<script>alert('Wrong Password');</script>";
        }
    } else {
        echo "<script>alert('User Not Registered');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="wrapper">
        <form action="login.php" method="post">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" id="usernameemail" placeholder="Username" name="usernameemail" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" id="password" placeholder="Password" name="password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox"> Remember me</label>
                <a href="register.php">Forgot password?</a>
            </div>

            <button type="submit" name="submit" class="btn">Login</button>

            <div class="register-link">
                <p>Belum Punya Akun? <a href="register.php">Register</a></p>
            </div>
        </form>
    </div>
    
    
</body>
</html>