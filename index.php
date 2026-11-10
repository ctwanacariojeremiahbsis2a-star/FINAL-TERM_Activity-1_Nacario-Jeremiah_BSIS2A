<?php


session_start();
require 'config.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare(
        "SELECT * FROM users WHERE username = ?"
    );

    $stmt->execute([$username]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $password === $user["password"]) {

        session_regenerate_id(true);

        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];

        header("Location: dashboard.php");
        exit;

    } else {

        $message = "Invalid username or password.";

    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>

<body>

<h2>Sign In</h2>

<p><?php echo htmlspecialchars($message); ?></p>

<form method="POST">

    <input type="text"
        name="username"
        placeholder="Enter Username"
        required>

    <br><br>

    <input type="password"
        name="password"
        placeholder="Enter Password"
        required>

    <br><br>

    <button type="submit">Login</button>

</form>

<p>
    Don't have an account?
    <a href="register.php">Register here</a>
</p>
<link rel="stylesheet" href="style.css">

</body>
</html>
