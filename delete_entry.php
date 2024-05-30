<?php
include 'includes/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM logbook_entries WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION['user_id']]);

header('Location: list_entries.php');
?>
