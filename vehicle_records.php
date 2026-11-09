<?php

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

require_once "db.php";

$sql = "SELECT * FROM vehicles ORDER BY id DESC";
$stmt = $pdo->query($sql);

$vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Vehicle Records</title>
</head>
<body>

    <h1>Vehicle Records</h1>

    <a href="add_vehicle.php">Add New Vehicle</a>

    <br><br>

    <table border="1" cellpadding="8">

        <tr>
            <th>ID</th>
            <th>Vehicle Name</th>
            <th>Plate Number</th>
            <th>Vehicle Type</th>
            <th>Price Per Day</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php foreach ($vehicles as $vehicle) { ?>

        <tr>

            <td><?php echo htmlspecialchars($vehicle['id']); ?></td>

            <td><?php echo htmlspecialchars($vehicle['vehicle_name']); ?></td>

            <td><?php echo htmlspecialchars($vehicle['plate_number']); ?></td>

            <td><?php echo htmlspecialchars($vehicle['vehicle_type']); ?></td>

            <td>₱<?php echo htmlspecialchars($vehicle['price_per_day']); ?></td>

            <td><?php echo htmlspecialchars($vehicle['status']); ?></td>

            <td>
    <a href="edit_vehicle.php?id=<?php echo $vehicle['id']; ?>">
        Edit
    </a>

    |

    <a href="delete_vehicle.php?id=<?php echo $vehicle['id']; ?>"
       onclick="return confirm('Are you sure you want to delete this vehicle?')">
        Delete
    </a>
</td>

        </tr>

        <?php } ?>

    </table>

    <br>

    <a href="index.php">Back to Main Menu</a>

</body>
</html>