<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h2>Welcome!</h2>

<p>Hello, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</p>

<p>You have successfully logged in.</p>

<a href="logout.php">Logout</a>
<link rel="stylesheet" href="style.css">

</body>
</html>
