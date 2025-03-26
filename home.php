<?php
session_start();
include 'lang.php';

// Check if language is changed
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

// Default to English if no session language is set
$language = $_SESSION['lang'] ?? 'en';
$text = $lang[$language];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DYUS IAS Coaching</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { font-family: 'Montserrat', sans-serif; }
        .hero { background: #1E4D8C; color: white; padding: 80px 20px; text-align: center; }
        .section { padding: 60px 20px; }
        .btn-primary { background: #FF6B6B; border: none; }
        .floating-button { position: fixed; bottom: 20px; right: 20px; background: #FFD700; color: #333; padding: 10px 20px; border-radius: 50px; }
    </style>
</head>
<body>

<!-- Navbar with Language Toggle -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">DYUS IAS</a>
        <div class="ms-auto">
            <a href="?lang=en" class="btn btn-light btn-sm">English</a>
            <a href="?lang=hi" class="btn btn-light btn-sm">हिन्दी</a>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1><?php echo $text["welcome"]; ?></h1>
        <p><?php echo $text["description"]; ?></p>
    </div>
</section>

<!-- Courses Section -->
<section class="section">
    <div class="container">
        <h2><?php echo $text["courses"]; ?></h2>
        <div class="row">
            <?php
            include 'db.php';
            $result = $conn->query("SELECT * FROM courses");
            while ($row = $result->fetch_assoc()) {
                echo "<div class='col-md-4'>
                        <div class='card p-3'>
                            <h4>{$row['name']}</h4>
                            <p>{$row['description']}</p>
                            <p><strong>Duration:</strong> {$row['duration']}</p>
                            <p><strong>Fee:</strong> {$row['fee']}</p>
                        </div>
                      </div>";
            }
            ?>
        </div>
    </div>
</section>

<!-- Faculty Section -->
<section class="section bg-light">
    <div class="container">
        <h2><?php echo $text["faculty"]; ?></h2>
        <div class="row">
            <?php
            $result = $conn->query("SELECT * FROM faculty");
            while ($row = $result->fetch_assoc()) {
                echo "<div class='col-md-3 text-center'>
                        <img src='assets/{$row['photo']}' class='rounded-circle' width='100' height='100'>
                        <h5>{$row['name']}</h5>
                        <p>{$row['subject']}</p>
                      </div>";
            }
            ?>
        </div>
    </div>
</section>

<!-- Announcements Section -->
<section class="section">
    <div class="container">
        <h2><?php echo $text["announcements"]; ?></h2>
        <ul>
            <?php
            $result = $conn->query("SELECT * FROM announcements ORDER BY created_at DESC LIMIT 5");
            while ($row = $result->fetch_assoc()) {
                echo "<li><strong>{$row['title']}</strong>: {$row['content']}</li>";
            }
            ?>
        </ul>
    </div>
</section>

<!-- Contact Form -->
<section class="section bg-light">
    <div class="container">
        <h2><?php echo $text["contact"]; ?></h2>
        <form action="contact.php" method="POST">
            <input type="text" name="name" placeholder="<?php echo $text['name']; ?>" class="form-control mb-2">
            <input type="email" name="email" placeholder="<?php echo $text['email']; ?>" class="form-control mb-2">
            <textarea name="message" placeholder="<?php echo $text['message']; ?>" class="form-control mb-2"></textarea>
            <button type="submit" class="btn btn-primary"><?php echo $text["send"]; ?></button>
        </form>
    </div>
</section>

<!-- Floating Contact Button -->
<a href="contact.php" class="floating-button"><?php echo $text["contact"]; ?></a>

</body>
</html>
