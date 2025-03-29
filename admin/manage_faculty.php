<?php
include_once dirname(__DIR__, 2) . '/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Faculty</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
        }
    </style>
</head>
<body>
    <h2>Manage Faculty</h2>
    <a href="add_faculty.php">➕ Add New Faculty</a>
    <table>
        <thead>
            <tr>
                <th>Photo</th>
                <th>Name</th>
                <th>Subject</th>
                <th>Small Intro</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM faculty ORDER BY id DESC";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>";
                    if (!empty($row['photo'])) {
                        echo "<img src='../uploads/faculty/" . htmlspecialchars($row['photo']) . "' alt='Photo'>";
                    } else {
                        echo "No Photo";
                    }
                    echo "</td>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['subject']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['small_intro']) . "</td>";
                    echo "<td class='action-buttons'>";
                    echo "<a href='edit_faculty.php?id=" . $row['id'] . "'>✏️ Edit</a>";
                    echo "<a href='delete_faculty.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\")'>🗑️ Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No faculty members found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <a href="index.php">Back to Dashboard</a>
</body>
</html>
