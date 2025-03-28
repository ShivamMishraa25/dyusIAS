<?php
include_once dirname(__DIR__, 2) . '/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $duration = $_POST['duration'];
    $summary = $_POST['summary'];
    $points = $_POST['points'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $query = "UPDATE courses SET title=?, duration=?, summary=?, points=?, description=?, price=? WHERE id=?";
    
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssssdi", $title, $duration, $summary, $points, $description, $price, $id);
    
    if (mysqli_stmt_execute($stmt)) {
        header ("Location: manage_courses.php?success=1");
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}
?>
