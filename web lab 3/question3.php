<?php
session_start();
$msg = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email    = $_POST['email']    ?? '';
    $password = $_POST['password'] ?? '';

    if ($email !== '' && $password !== '') {
        $conn = new mysqli('localhost','root','','project');
        if ($conn->connect_error) {
            $msg = 'DB connection error';
        } else {
            $email    = $conn->real_escape_string($email);
            $sql      = "SELECT password FROM registration WHERE email='$email'";
            $res      = $conn->query($sql);
            if ($res && $res->num_rows === 1) {
                $row = $res->fetch_assoc();
                if ($password === $row['password']) {
                    $_SESSION['email'] = $email;
                    $msg = 'Login successful';
                } else {
                    $msg = 'Invalid credentials';
                }
            } else {
                $msg = 'Invalid credentials';
            }
            $conn->close();
        }
    } else {
        $msg = 'Enter email and password';
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
  <h1>Login</h1>
  <?php if ($msg): ?>
    <p><?= htmlspecialchars($msg) ?></p>
  <?php endif; ?>
  <form method="post">
    Email:<br>
    <input type="email" name="email" required><br><br>
    Password:<br>
    <input type="password" name="password" required><br><br>
    <input type="submit" value="Login">
  </form>
</body>
</html>

