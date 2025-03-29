<?php
include_once dirname(__DIR__, 2) . '/config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Get images and delete from server
    $img_query = "SELECT photos FROM announcements WHERE id = $id";
    $img_result = mysqli_query($conn, $img_query);
    $img_row = mysqli_fetch_assoc($img_result);
    $images = explode(',', $img_row['photos']);

    foreach ($images as $img) {
        unlink("../uploads/announcements/" . $img);
    }

    // Delete announcement
    mysqli_query($conn, "DELETE FROM announcements WHERE id = $id");

    header("Location: manage_announcements.php");
    exit();
}
?>
