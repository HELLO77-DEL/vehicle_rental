<?php

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

require_once "db.php";
$id = $_GET['id'];

$sql = "DELETE FROM vehicles WHERE id = ?";
$stmt = $pdo->prepare($sql);

$stmt->execute([$id]);

echo "Vehicle deleted successfully!";

?>

<br><br>

<a href="index.php">Back to Vehicle Records</a>