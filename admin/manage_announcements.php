<?php
include_once dirname(__DIR__, 2) . '/config.php';

$query = "SELECT * FROM announcements ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Announcements</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        img {
            width: 80px;
            height: auto;
            margin: 5px;
        }
    </style>
</head>
<body>
    <h2>Manage Announcements</h2>
    <a href="add_announcement.php">+ Add New Announcement</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Images</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= htmlspecialchars($row['description']) ?></td>
                    <td>
                        <?php 
                        $images = explode(',', $row['photos']);
                        foreach ($images as $img): 
                            if (!empty($img)): ?>
                                <img src="../uploads/announcements/<?= htmlspecialchars($img) ?>" alt="Announcement Image">
                            <?php endif; 
                        endforeach; ?>
                    </td>
                    <td>
                        <a href="edit_announcement.php?id=<?= $row['id'] ?>">Edit</a> | 
                        <a href="delete_announcement.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="index.php">Back to Dashboard</a>
</body>
</html>
