<?php
$msg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['action'] == 'store') {
        $name = $_POST['name'] ?? '';
        setcookie('username', $name, time() + 3600); // 1 hour
        $msg = "Cookie stored.";
    } elseif ($_POST['action'] == 'retrieve') {
        if (isset($_COOKIE['username'])) {
            $msg = "Stored cookie: " . $_COOKIE['username'];
        } else {
            $msg = "No cookie found.";
        }
    } elseif ($_POST['action'] == 'destroy') {
        setcookie('username', '', time() - 3600); // Expire in past
        $msg = "Cookie destroyed.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Cookie </title></head>
<body>
<h2>Cookie </h2>
<?php if ($msg) echo "<p>$msg</p>"; ?>

<form method="post">
    Enter Name: <input type="text" name="name"><br><br>
    <button type="submit" name="action" value="store">Store Cookie</button>
    <button type="submit" name="action" value="retrieve">Retrieve Cookie</button>
    <button type="submit" name="action" value="destroy">Destroy Cookie</button>
</form>
</body>
</html>