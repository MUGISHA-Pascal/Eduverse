<?php
include 'includes/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM logbook_entries WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$entries = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logbook Entries</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <div class="top">
   <div><h1>Logbook Entries</h1></div>
   <div class="j"><a class="h" href="index.php">Home</a></div>
    </div>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Days</th>
                <th>Week</th>
                <th>Description</th>
                <th>Hours</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($entries as $entry): ?>
                <tr>
                    <td><?= htmlspecialchars($entry['entry_date']) ?></td>
                    <td><?= htmlspecialchars($entry['entry_time']) ?></td>
                    <td><?= htmlspecialchars($entry['days']) ?></td>
                    <td><?= htmlspecialchars($entry['week']) ?></td>
                    <td><?= htmlspecialchars($entry['activity_description']) ?></td>
                    <td><?= htmlspecialchars($entry['working_hour']) ?></td>
                    <td>
                        <a id="a" href="edit_entry.php?id=<?= $entry['id'] ?>">Edit</a>
                        <a id="a2" href="delete_entry.php?id=<?= $entry['id'] ?>" onclick="return confirm('Are you sure you want to delete this entry?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
