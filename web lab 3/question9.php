<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "book";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $publisher = $_POST['publisher'];
    $author = $_POST['author'];
    $edition = $_POST['edition'];
    $pages = $_POST['no_of_page'];
    $price = $_POST['price'];
    $publish_date = $_POST['publish_date'];
    $isbn = $_POST['isbn'];

    $sql = "UPDATE books SET title='$title', publisher='$publisher', author='$author', edition='$edition', no_of_page='$pages', price='$price', publish_date='$publish_date', isbn='$isbn' WHERE id=$id";
    $conn->query($sql);
}

$result = $conn->query("SELECT * FROM books");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Books</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid black; padding: 5px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Edit Books</h2>
    <table>
        <tr>
            <th>ID</th><th>Title</th><th>Publisher</th><th>Author</th>
            <th>Edition</th><th>Pages</th><th>Price</th>
            <th>Publish Date</th><th>ISBN</th><th>Action</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
        <form method="post">
            <td><input type="hidden" name="id" value="<?= $row['id'] ?>"> <?= $row['id'] ?></td>
            <td><input type="text" name="title" value="<?= $row['title'] ?>"></td>
            <td><input type="text" name="publisher" value="<?= $row['publisher'] ?>"></td>
            <td><input type="text" name="author" value="<?= $row['author'] ?>"></td>
            <td><input type="text" name="edition" value="<?= $row['edition'] ?>"></td>
            <td><input type="number" name="no_of_page" value="<?= $row['no_of_page'] ?>"></td>
            <td><input type="text" name="price" value="<?= $row['price'] ?>"></td>
            <td><input type="date" name="publish_date" value="<?= $row['publish_date'] ?>"></td>
            <td><input type="text" name="isbn" value="<?= $row['isbn'] ?>"></td>
            <td><input type="submit" value="Update"></td>
        </form>
        </tr>
        <?php endwhile; ?>
    </table>
    <?php $conn->close(); ?>
</body>
</html>