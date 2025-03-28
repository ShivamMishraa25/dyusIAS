<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - DYUS IAS</title>
    <link rel="stylesheet" href="style.css"> <!-- Add your CSS file -->
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <ul>
                <li><a href="manage_courses.php">Manage Courses</a></li>
                <li><a href="manage_faculty.php">Manage Faculty</a></li>
                <li><a href="manage_announcements.php">Manage Announcements</a></li>
                <li><a href="view_students.php">View Students</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Welcome, Admin</h2>
        <p>Use the navigation above to manage the website content.</p>
    </main>
</body>
</html>
