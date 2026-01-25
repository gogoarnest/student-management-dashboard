<?php
session_start();
session_destroy(); // يمسح سيشن قديمة
session_start();   // يبدأ سيشن جديدة للتسجيل
require_once "connection.php";

$error = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = md5($_POST["password"]);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION["user"] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="login-body">

<div class="login-container">
    <h2>🔐 Login</h2>

    <?php if ($error): ?>
        <p class="error-msg"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="post" class="login-form">
        
        <label>Username</label>
        <input type="text" name="username" placeholder="Enter username" required autocomplete="off">

        <label>Password</label>
        <input type="password" name="password" placeholder="Enter password" required autocomplete="new-password">

        <button type="submit" class="login-btn">Login</button>
    </form>
</div>

</body>
</html>
