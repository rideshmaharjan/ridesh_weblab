<?php
$err = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['name'])) {
        $name = $_POST['name'];
    } else {
        $err['name'] = 'Enter name';
    }

    if (!empty($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        $err['email'] = 'Enter email';
    }

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    } else {
        $err['password'] = 'Enter password';
    }

    if (!empty($_POST['phone'])) {
        $phone = $_POST['phone'];
    } else {
        $err['phone'] = 'Enter phone';
    }

    if (!empty($_POST['gender'])) {
        $gender = $_POST['gender'];
    } else {
        $err['gender'] = 'Select gender';
    }

    if (!empty($_POST['faculty'])) {
        $faculty = $_POST['faculty'];
    } else {
        $err['faculty'] = 'Enter faculty';
    }

    if (count($err) == 0) {
        $conn = new mysqli('localhost','root','','project');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "INSERT INTO registration (name,email,password,phone,gender,faculty)
                VALUES ('$name','$email','$password','$phone','$gender','$faculty')";
        if ($conn->query($sql)) {
            $msg = "Registration successful";
        } else {
            $msg = "Error: " . $conn->error;
        }
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
</head>
<body>
  <h1>Registration Form</h1>
  <?php if (isset($msg)) echo "<p>$msg</p>"; ?>
  <form method="post">
    Name:<br>
    <input type="text" name="name" value="<?= isset($name)?$name:'' ?>"><br>
    <?= isset($err['name'])?$err['name']:'' ?><br>

    Email:<br>
    <input type="email" name="email" value="<?= isset($email)?$email:'' ?>"><br>
    <?= isset($err['email'])?$err['email']:'' ?><br>

    Password:<br>
    <input type="password" name="password"><br>
    <?= isset($err['password'])?$err['password']:'' ?><br>

    Phone:<br>
    <input type="text" name="phone" value="<?= isset($phone)?$phone:'' ?>"><br>
    <?= isset($err['phone'])?$err['phone']:'' ?><br>

    Gender:<br>
    <select name="gender">
      <option value="">--Select--</option>
      <option value="Male" <?= (isset($gender)&&$gender=='Male')?'selected':'' ?>>Male</option>
      <option value="Female" <?= (isset($gender)&&$gender=='Female')?'selected':'' ?>>Female</option>
      <option value="Other" <?= (isset($gender)&&$gender=='Other')?'selected':'' ?>>Other</option>
    </select><br>
    <?= isset($err['gender'])?$err['gender']:'' ?><br>

    Faculty:<br>
    <input type="text" name="faculty" value="<?= isset($faculty)?$faculty:'' ?>"><br>
    <?= isset($err['faculty'])?$err['faculty']:'' ?><br><br>

    <input type="submit" value="Register">
  </form>
</body>
</html>
