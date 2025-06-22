<?php
session_start();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'store') {
        $_SESSION['username'] = $_POST['username'] ?? '';
        $msg = "Session stored successfully.";
    } elseif ($_POST['action'] == 'retrieve') {
        $msg = isset($_SESSION['username']) ? "Stored username: " . $_SESSION['username'] : "No session found.";
    } elseif ($_POST['action'] == 'destroy') {
        session_unset();
        session_destroy();
        $msg = "Session destroyed successfully.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Session Example</title></head>
<body>
<h2>Session </h2>
<?php if (isset($msg)) echo "<p>$msg</p>"; ?>

<form method="post">
    Enter Username: <input type="text" name="username"><br><br>
    <button type="submit" name="action" value="store">Store Session</button>
    <button type="submit" name="action" value="retrieve">Retrieve Session</button>
    <button type="submit" name="action" value="destroy">Destroy Session</button>
</form>
</body>
</html>