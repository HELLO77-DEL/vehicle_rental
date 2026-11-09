<?php

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

require_once "db.php";

if (isset($_POST['add_vehicle'])) {

    $vehicle_name = $_POST['vehicle_name'];
    $plate_number = $_POST['plate_number'];
    $vehicle_type = $_POST['vehicle_type'];
    $price_per_day = $_POST['price_per_day'];
    $status = $_POST['status'];

    if (!in_array($status, ['Active', 'Inactive'], true)) {
        die("Invalid vehicle status.");
    }

    $sql = "INSERT INTO vehicles
            (vehicle_name, plate_number, vehicle_type, price_per_day, status)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $vehicle_name,
        $plate_number,
        $vehicle_type,
        $price_per_day,
        $status
    ]);

    header("Location: add_vehicle.php?success=1");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Vehicle</title>
</head>
<body>

    <h1>Add Vehicle</h1>

    <?php
    if (isset($_GET['success'])) {
        echo "<p>Vehicle added successfully!</p>";
    }
    ?>

    <form method="POST">

        <label>Vehicle Name:</label><br>
        <input type="text" name="vehicle_name" required>
        <br><br>

        <label>Plate Number:</label><br>
        <input type="text" name="plate_number" required>
        <br><br>

        <label>Vehicle Type:</label><br>
        <input type="text" name="vehicle_type" required>
        <br><br>

        <label>Price Per Day:</label><br>
        <input type="number" name="price_per_day"
               min="0.01" step="0.01" required>
        <br><br>

        <label>Status:</label><br>
        <select name="status" required>
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
        </select>
        <br><br>

        <button type="submit" name="add_vehicle">
            Add Vehicle
        </button>

    </form>

    <br>

    <a href="index.php">Back to Main Menu</a>

</body>
</html>