<?php
include_once dirname(__DIR__, 2) . '/config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = "SELECT * FROM announcements WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    $existing_images = explode(',', $row['photos']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $long_detail = mysqli_real_escape_string($conn, $_POST['long_detail']);

    $image_names = $existing_images; // Keep existing images

    // Handle new image uploads
    if (!empty($_FILES['photos']['name'][0])) {
        foreach ($_FILES['photos']['tmp_name'] as $key => $tmp_name) {
            $photo_name = time() . "_" . basename($_FILES['photos']['name'][$key]);
            $target_path = "../uploads/announcements/" . $photo_name;

            if (move_uploaded_file($tmp_name, $target_path)) {
                $image_names[] = $photo_name;
            }
        }
    }

    $image_string = implode(',', $image_names); // Store as comma-separated values

    // Update announcement
    $update_query = "UPDATE announcements SET title='$title', description='$description', long_detail='$long_detail', photos='$image_string' WHERE id=$id";
    mysqli_query($conn, $update_query);

    header("Location: manage_announcements.php");
    exit();
}

// Delete specific image
if (isset($_GET['delete_img'])) {
    $img_to_delete = $_GET['delete_img'];
    $updated_images = array_diff($existing_images, [$img_to_delete]);

    // Remove file from server
    unlink("../uploads/announcements/" . $img_to_delete);

    $image_string = implode(',', $updated_images);

    // Update database
    mysqli_query($conn, "UPDATE announcements SET photos='$image_string' WHERE id=$id");

    header("Location: edit_announcement.php?id=$id");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Announcement</title>
</head>
<body>
    <h2>Edit Announcement</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <label>Title:</label>
        <input type="text" name="title" value="<?= htmlspecialchars($row['title']) ?>" required><br><br>

        <label>Description:</label>
        <textarea name="description" required><?= htmlspecialchars($row['description']) ?></textarea><br><br>

        <label>Long Detail (Optional):</label>
        <textarea name="long_detail"><?= htmlspecialchars($row['long_detail']) ?></textarea><br><br>

        <label>Existing Photos:</label><br>
        <?php foreach ($existing_images as $image): ?>
            <img src="../uploads/announcements/<?= htmlspecialchars($image) ?>" width="100">
            <a href="?id=<?= $id ?>&delete_img=<?= urlencode($image) ?>">Delete</a><br>
        <?php endforeach; ?>
        
        <label>Add New Photos:</label>
        <input type="file" name="photos[]" multiple><br><br>

        <button type="submit">Update Announcement</button>
    </form>
</body>
</html>
