<?php
// Database connection
$dbHost = 'localhost';
$dbUser = 'root';
$dbPassword = '';
$dbName = 'gamedatabase';

$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Login form handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $row["password"])) {
            echo "Login successful!";
            // Add your session or redirect logic here
            header("Location: GameStore.html");  // Arahkan ke gamestore.html setelah login berhasil
            exit();
        } else {
            $errorMsg = "Invalid password!";
        }
    } else {
        $errorMsg = "Invalid username!";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<link rel="stylesheet" href="style7.css">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        .error-message {
            color: red;
            margin-top: 5px;
        }
    </style>
</head>

<body>
<div class="login-box">
  <h2>Login</h2>
  <form action="GameStore.html" method="post">
    <div class="user-box">
      <input type="text" name="username" required="">
      <label>Username</label>
    </div>
    <div class="user-box">
      <input type="password" name="password" required="">
      <label>Password</label>
    </div>
    <span class="error-message"><?php echo isset($errorMsg) ? $errorMsg : ''; ?></span>
    <a href="GameStore.html">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <input type="submit" value="Submit">
    </a>
  </form>
</div>
</body>

</html>