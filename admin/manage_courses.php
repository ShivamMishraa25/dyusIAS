<?php
session_start();
require_once dirname(__DIR__, 2) . '/config.php'; // Database connection file

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Fetch courses
$query = "SELECT * FROM courses";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses</title>
</head>
<body>
    <h2>Manage Courses</h2>
    <a href="add_course.php">Add New Course</a>
    <form action="add_course.php" method="POST">
    <label>Title:</label>
    <input type="text" name="title" required>
    
    <label>Duration:</label>
    <input type="text" name="duration" required>
    
    <label>Summary:</label>
    <textarea name="summary" required></textarea>
    
    <label>Points (comma-separated):</label>
    <textarea name="points" required></textarea>
    
    <label>Description (optional):</label>
    <textarea name="description"></textarea>
    
    <label>Price:</label>
    <input type="number" step="0.01" name="price" required>
    
    <button type="submit">Add Course</button>
</form>

    <h3>Existing Courses</h3>
    <table border="1">
    <tr>
        <th>Title</th>
        <th>Duration</th>
        <th>Summary</th>
        <th>Points</th>
        <th>Description</th>
        <th>Price</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['duration']; ?></td>
        <td><?php echo $row['summary']; ?></td>
        <td><?php echo $row['points']; ?></td>
        <td><?php echo $row['description']; ?></td>
        <td><?php echo $row['price']; ?></td>
        <td>
            <a href="edit_course.php?id=<?php echo $row['id']; ?>">Edit</a>
            <a href="delete_course.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<a href="index.php">Back to Dashboard</a>
</body>
</html>
