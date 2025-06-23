<?php
session_start();

// Database connection setup
$host = "localhost";
$user = "root";       // change if needed
$password = "";       // change if needed
$database = "challangedb";

// Connect to database
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
$login_message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $username = trim($_POST['username']);

    // Prepare query
    $query = $conn->prepare("SELECT * FROM users WHERE name = ? AND surname = ? AND username = ?");
    $query->bind_param("sss", $name, $surname, $username);
    $query->execute();
    $result = $query->get_result();

    // Check if user exists
    if ($result->num_rows === 1) {
        $_SESSION['name'] = $name;
        $_SESSION['surname'] = $surname;
        $_SESSION['username'] = $username;
        header('location:dashboard.php');
        $login_message = "Welcome, $name!";
    } else {
        $login_message = "Login failed: user not found.";
    }

    $query->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #eef;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    form {
      background: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      width: 300px;
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    input {
      display: block;
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    button {
      background: #007bff;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 4px;
      width: 100%;
    }
    .message {
      margin-top: 15px;
      color:red;
      text-align: center;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <form method="POST" action="">
    <h2>Login</h2>
    <input type="text" name="name" placeholder="First Name" required />
    <input type="text" name="surname" placeholder="Last Name" required />
    <input type="text" name="username" placeholder="Username" required />
    <button type="submit">Login</button>

    <?php if ($login_message): ?>
      <div class="message"><?= $login_message ?></div>
    <?php endif; ?>
  </form>
</body>
</html>