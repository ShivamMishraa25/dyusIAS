<?php
include_once dirname(__DIR__, 2) . '/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM courses WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $course = mysqli_fetch_assoc($result);

    if (!$course) {
        echo "Course not found!";
        exit();
    }
    mysqli_stmt_close($stmt);
}
?>

<form action="update_course.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $course['id']; ?>">
    
    <label>Title:</label>
    <input type="text" name="title" value="<?php echo htmlspecialchars($course['title']); ?>" required>

    <label>Duration:</label>
    <input type="text" name="duration" value="<?php echo htmlspecialchars($course['duration']); ?>" required>

    <label>Summary:</label>
    <textarea name="summary" required><?php echo htmlspecialchars($course['summary']); ?></textarea>

    <label>Points:</label>
    <textarea name="points" required><?php echo htmlspecialchars($course['points']); ?></textarea>

    <label>Description:</label>
    <textarea name="description"><?php echo htmlspecialchars($course['description']); ?></textarea>

    <label>Price:</label>
    <input type="number" step="0.01" name="price" value="<?php echo $course['price']; ?>" required>

    <button type="submit">Update Course</button>
</form>
