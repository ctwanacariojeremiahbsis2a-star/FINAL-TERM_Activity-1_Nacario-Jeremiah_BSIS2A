<?php


require 'config.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $confirm = $_POST["confirm"];

    if (empty($username) || empty($password) || empty($confirm)) {

        $message = "Please fill in all fields.";

    } elseif ($password !== $confirm) {

        $message = "Passwords do not match.";

    } else {

        $check = $conn->prepare(
            "SELECT id FROM users WHERE username = ?"
        );

        $check->execute([$username]);

        if ($check->fetch()) {

            $message = "Username already exists.";

        } else {

            $stmt = $conn->prepare(
                "INSERT INTO users (username, password)
                 VALUES (?, ?)"
            );

            $stmt->execute([$username, $password]);

            $message = "Registration successful! You can now login.";

        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>

<body>

<h2>Create Account</h2>

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

    <input type="password"
        name="confirm"
        placeholder="Confirm Password"
        required>

    <br><br>

    <button type="submit">Register</button>

</form>

<p>
    Already have an account?
    <a href="index.php">Login here</a>
</p>
<link rel="stylesheet" href="style.css">

</body>
</html>
