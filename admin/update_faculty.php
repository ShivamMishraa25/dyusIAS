<?php
include_once dirname(__DIR__, 2) . '/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
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

        $query = "UPDATE faculty SET photo=?, name=?, subject=?, small_intro=?, long_intro=?, linkedin=?, twitter=?, email=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssssssssi", $photo, $name, $subject, $small_intro, $long_intro, $linkedin, $twitter, $email, $id);
    } else {
        $query = "UPDATE faculty SET name=?, subject=?, small_intro=?, long_intro=?, linkedin=?, twitter=?, email=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssssssi", $name, $subject, $small_intro, $long_intro, $linkedin, $twitter, $email, $id);
    }

    if (mysqli_stmt_execute($stmt)) {
        header ("Location: manage_faculty.php?success=1.");
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}
?>
