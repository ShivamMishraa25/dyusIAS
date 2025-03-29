<?php
include_once dirname(__DIR__, 2) . '/config.php'; // Ensure database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $long_detail = mysqli_real_escape_string($conn, $_POST['long_detail']);

    $image_names = [];

    // Handle multiple image uploads
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

    // Insert into announcements table
    $query = "INSERT INTO announcements (title, description, long_detail, photos) 
              VALUES ('$title', '$description', '$long_detail', '$image_string')";
    
    if (mysqli_query($conn, $query)) {
        header("Location: manage_announcements.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Announcement</title>
</head>
<body>
    <h2>Add New Announcement</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <label>Title:</label>
        <input type="text" name="title" required><br><br>

        <label>Description:</label>
        <textarea name="description" required></textarea><br><br>

        <label>Long Detail (Optional):</label>
        <textarea name="long_detail"></textarea><br><br>

        <label>Photos (Optional, Multiple Allowed):</label>
        <input type="file" name="photos[]" multiple><br><br>

        <button type="submit">Add Announcement</button>
    </form>
</body>
</html>
