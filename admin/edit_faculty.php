<?php
include_once dirname(__DIR__, 2) . '/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM faculty WHERE id=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $faculty = mysqli_fetch_assoc($result);

    if (!$faculty) {
        echo "Faculty not found!";
        exit();
    }
    mysqli_stmt_close($stmt);
}
?>

<form action="update_faculty.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $faculty['id']; ?>">

    <label>Name:</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($faculty['name']); ?>" required>

    <label>Subject:</label>
    <input type="text" name="subject" value="<?php echo htmlspecialchars($faculty['subject']); ?>" required>

    <label>Small Intro:</label>
    <textarea name="small_intro"><?php echo htmlspecialchars($faculty['small_intro']); ?></textarea>

    <label>Long Intro:</label>
    <textarea name="long_intro"><?php echo htmlspecialchars($faculty['long_intro']); ?></textarea>

    <label>LinkedIn:</label>
    <input type="url" name="linkedin" value="<?php echo $faculty['linkedin']; ?>">

    <label>Twitter:</label>
    <input type="url" name="twitter" value="<?php echo $faculty['twitter']; ?>">

    <label>Email:</label>
    <input type="email" name="email" value="<?php echo $faculty['email']; ?>">

    <label>Photo:</label>
    <input type="file" name="photo">
    <p>Current Photo: <?php echo $faculty['photo'] ? "<img src='../uploads/faculty/{$faculty['photo']}' width='100'>" : "No photo uploaded"; ?></p>

    <button type="submit">Update Faculty</button>
</form>
