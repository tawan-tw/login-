<?php
include 'config.php';
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        $message = "Signup successful! <a href='login.php'>Login here</a>";
    } else {
        $message = "Error: ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <title>Signup</title>
</head>
<body>
    <form method="post" action="index.php">
        <h2>Signup</h2>
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Signup</button>
        <p>Already have an account? <a href="login.php">Login</a></p>
        <p><?php echo $message; ?></p>
    </form>
</body>
</html>
