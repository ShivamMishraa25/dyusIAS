<?php
include_once dirname(__DIR__, 2) . '/config.php'; // Ensure database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $duration = $_POST['duration'];
    $summary = $_POST['summary'];
    $points = $_POST['points'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Use prepared statement to handle special characters
    $query = "INSERT INTO courses (title, duration, summary, points, description, price) 
              VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssssd", $title, $duration, $summary, $points, $description, $price);
    
    if (mysqli_stmt_execute($stmt)) {
        header ("Location: manage_courses.php?success=1");
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}
?>
