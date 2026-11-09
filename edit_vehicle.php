<?php

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

require_once "db.php";
$id = $_GET['id'];

if (isset($_POST['update_vehicle'])) {

    $vehicle_name = $_POST['vehicle_name'];
    $plate_number = $_POST['plate_number'];
    $vehicle_type = $_POST['vehicle_type'];
    $price_per_day = $_POST['price_per_day'];
    $status = $_POST['status'];

    $sql = "UPDATE vehicles SET
            vehicle_name = ?,
            plate_number = ?,
            vehicle_type = ?,
            price_per_day = ?,
            status = ?
            WHERE id = ?";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $vehicle_name,
        $plate_number,
        $vehicle_type,
        $price_per_day,
        $status,
        $id
    ]);

    echo "Vehicle updated successfully!";
}

$sql = "SELECT * FROM vehicles WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$vehicle = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$vehicle) {
    die("Vehicle not found!");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Vehicle</title>
</head>
<body>

    <h1>Edit Vehicle</h1>

    <form method="POST">

        <label>Vehicle Name:</label><br>
        <input type="text" name="vehicle_name"
        value="<?php echo htmlspecialchars($vehicle['vehicle_name']); ?>" required>
        <br><br>

        <label>Plate Number:</label><br>
        <input type="text" name="plate_number"
        value="<?php echo htmlspecialchars($vehicle['plate_number']); ?>" required>
        <br><br>

        <label>Vehicle Type:</label><br>
        <input type="text" name="vehicle_type"
        value="<?php echo htmlspecialchars($vehicle['vehicle_type']); ?>" required>
        <br><br>

        <label>Price Per Day:</label><br>
        <input type="number" name="price_per_day"
        value="<?php echo htmlspecialchars($vehicle['price_per_day']); ?>"
        min="0.01" step="0.01" required>
        <br><br>

        <label>Status:</label><br>
        <select name="status">
            <option value="Active"
            <?php if ($vehicle['status'] == 'Active') echo 'selected'; ?>>
                Active
            </option>

            <option value="Inactive"
            <?php if ($vehicle['status'] == 'Inactive') echo 'selected'; ?>>
                Inactive
            </option>
        </select>
        <br><br>

        <button type="submit" name="update_vehicle">
            Update Vehicle
        </button>

    </form>

    <br>

    <a href="index.php">Back to Vehicle Records</a>

</body>
</html>