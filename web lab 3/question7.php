<?php
session_start();
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $publisher = trim($_POST['publisher']);
    $author = trim($_POST['author']);
    $edition = trim($_POST['edition']);
    $no_of_page = intval($_POST['no_of_page']);
    $price = floatval($_POST['price']);
    $publish_date = $_POST['publish_date'];
    $isbn = trim($_POST['isbn']);

    if ($title && $publisher && $author && $isbn) {
        $conn = new mysqli("localhost", "root", "", "book");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO books (title, publisher, author, edition, no_of_page, price, publish_date, isbn) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssidss", $title, $publisher, $author, $edition, $no_of_page, $price, $publish_date, $isbn);

        if ($stmt->execute()) {
            $success = "Book record saved successfully.";
        } else {
            $error = "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        $error = "Please fill in all required fields.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Book</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        form { max-width: 500px; margin: auto; }
        label { display: block; margin-top: 10px; }
        input { width: 90%; padding: 8px; margin-top: 4px; }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
    <h2>Add Book</h2>
    <?php if ($error) echo "<p class='error'>$error</p>"; ?>
    <?php if ($success) echo "<p class='success'>$success</p>"; ?>
    <form method="post">
        <label>Title*</label>
        <input type="text" name="title" required>

        <label>Publisher*</label>
        <input type="text" name="publisher" required>

        <label>Author*</label>
        <input type="text" name="author" required>

        <label>Edition</label>
        <input type="text" name="edition">

        <label>No. of Pages</label>
        <input type="number" name="no_of_page">

        <label>Price</label>
        <input type="text" name="price">

        <label>Publish Date</label>
        <input type="date" name="publish_date">

        <label>ISBN*</label>
        <input type="text" name="isbn" required>

        <input type="submit" value="Save Book" style="margin-top:15px;">
    </form>
</body>
</html>