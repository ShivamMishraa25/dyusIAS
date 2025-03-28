<?php
include_once dirname(__DIR__, 2) . '/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $small_intro = $_POST['small_intro'];
    $long_intro = $_POST['long_intro'];
    $linkedin = $_POST['linkedin'];
    $twitter = $_POST['twitter'];
    $email = $_POST['email'];

    $photo = NULL;

    if (!empty($_FILES["photo"]["name"])) {
        $target_dir = "../uploads/faculty/";
        $photo = basename($_FILES["photo"]["name"]);
        $target_file = $target_dir . $photo;
        
        if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            echo "Error uploading photo.";
            exit();
        }
    }

    $query = "INSERT INTO faculty (photo, name, subject, small_intro, long_intro, linkedin, twitter, email) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssssssss", $photo, $name, $subject, $small_intro, $long_intro, $linkedin, $twitter, $email);
    
    if (mysqli_stmt_execute($stmt)) {
        header ("Location: manage_faculty.php?success=1");
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add faculty</title>
</head>
<body>

<form action="add_faculty.php" method="POST" enctype="multipart/form-data">
    <label>Name:</label>
    <input type="text" name="name" required>

    <label>Subject:</label>
    <input type="text" name="subject" required>

    <label>Small Intro:</label>
    <textarea name="small_intro" required></textarea>

    <label>Long Intro:</label>
    <textarea name="long_intro"></textarea>

    <label>LinkedIn:</label>
    <input type="url" name="linkedin">

    <label>Twitter:</label>
    <input type="url" name="twitter">

    <label>Email:</label>
    <input type="email" name="email">

    <label>Photo:</label>
    <input type="file" name="photo">

    <button type="submit">Add Faculty</button>
</form>

</body>
</html>