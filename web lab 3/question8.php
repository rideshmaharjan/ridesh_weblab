<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "book";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$result = $conn->query("SELECT id, title, publisher, author, edition, no_of_page, price, publish_date, isbn FROM books");
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Books</title>
    <style>
        table { border: 1px solid black; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 5px; text-align: left; }
        th { background-color: #ddd; }
    </style>
</head>
<body>
    <h2>Books List</h2>
    <?php if ($result->num_rows > 0): ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Publisher</th>
            <th>Author</th>
            <th>Edition</th>
            <th>Pages</th>
            <th>Price</th>
            <th>Publish Date</th>
            <th>ISBN</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['title'] ?></td>
            <td><?= $row['publisher'] ?></td>
            <td><?= $row['author'] ?></td>
            <td><?= $row['edition'] ?></td>
            <td><?= $row['no_of_page'] ?></td>
            <td><?= $row['price'] ?></td>
            <td><?= $row['publish_date'] ?></td>
            <td><?= $row['isbn'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <?php else: ?>
        <p>No books found.</p>
    <?php endif; ?>
    <?php $conn->close(); ?>
</body>
</html>