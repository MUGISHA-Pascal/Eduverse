<?php
include 'includes/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $entry_date = $_POST['entry_date'];
    $entry_time = $_POST['entry_time'];
    $days = $_POST['days'];
    $week = $_POST['week'];
    $activity_description = $_POST['activity_description'];
    $working_hour = $_POST['working_hour'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO logbook_entries (entry_date, entry_time, days, week, activity_description, working_hour, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$entry_date, $entry_time, $days, $week, $activity_description, $working_hour, $user_id]);

    header('Location: list_entries.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Entry</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <form action="add_entry.php" method="POST">
        <input type="date" name="entry_date" required>
        <input type="time" name="entry_time" required>
        <input type="text" name="days" placeholder="Days" required>
        <input type="number" name="week" placeholder="Week" required>
        <textarea name="activity_description" placeholder="Activity Description" required></textarea>
        <input type="number" name="working_hour" placeholder="Working Hours" required>
        <button type="submit">Add Entry</button>
    </form>
</body>
</html>
