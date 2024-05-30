<?php
include 'includes/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $entry_date = $_POST['entry_date'];
    $entry_time = $_POST['entry_time'];
    $days = $_POST['days'];
    $week = $_POST['week'];
    $activity_description = $_POST['activity_description'];
    $working_hour = $_POST['working_hour'];

    $stmt = $pdo->prepare("UPDATE logbook_entries SET entry_date = ?, entry_time = ?, days = ?, week = ?, activity_description = ?, working_hour = ? WHERE id = ? AND user_id = ?");
    $stmt->execute([$entry_date, $entry_time, $days, $week, $activity_description, $working_hour, $id, $_SESSION['user_id']]);

    header('Location: list_entries.php');
} else {
    $stmt = $pdo->prepare("SELECT * FROM logbook_entries WHERE id = ? AND user_id = ?");
    $stmt->execute([$id, $_SESSION['user_id']]);
    $entry = $stmt->fetch();
}

if (!$entry) {
    die("Entry not found.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Entry</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <form action="edit_entry.php?id=<?= $id ?>" method="POST">
        <input type="date" name="entry_date" value="<?= htmlspecialchars($entry['entry_date']) ?>" required>
        <input type="time" name="entry_time" value="<?= htmlspecialchars($entry['entry_time']) ?>" required>
        <input type="text" name="days" value="<?= htmlspecialchars($entry['days']) ?>" required>
        <input type="number" name="week" value="<?= htmlspecialchars($entry['week']) ?>" required>
        <textarea name="activity_description" required><?= htmlspecialchars($entry['activity_description']) ?></textarea>
        <input type="number" name="working_hour" value="<?= htmlspecialchars($entry['working_hour']) ?>" required>
        <button type="submit">Update Entry</button>
    </form>
</body>
</html>
