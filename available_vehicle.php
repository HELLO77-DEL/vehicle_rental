<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once "db.php";

$sql = "SELECT * FROM vehicles WHERE status = 'Active'";
$stmt = $pdo->query($sql);
$vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Available Vehicles</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            color: black;
            background-color: white;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #eeeeee;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 8px 15px;
            border: 1px solid black;
            color: black;
            text-decoration: none;
        }

        a:hover {
            background-color: #eeeeee;
        }
    </style>
</head>

<body>

    <h1>Available Vehicles</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Vehicle Name</th>
            <th>Plate Number</th>
            <th>Vehicle Type</th>
            <th>Price Per Day</th>
            <th>Status</th>
        </tr>

        <?php foreach ($vehicles as $vehicle) { ?>
        <tr>
            <td><?php echo htmlspecialchars($vehicle['id']); ?></td>
            <td><?php echo htmlspecialchars($vehicle['vehicle_name']); ?></td>
            <td><?php echo htmlspecialchars($vehicle['plate_number']); ?></td>
            <td><?php echo htmlspecialchars($vehicle['vehicle_type']); ?></td>
            <td>₱<?php echo htmlspecialchars($vehicle['price_per_day']); ?></td>
            <td><?php echo htmlspecialchars($vehicle['status']); ?></td>
        </tr>
        <?php } ?>

        <?php if (count($vehicles) == 0) { ?>
        <tr>
            <td colspan="6">No available vehicles found.</td>
        </tr>
        <?php } ?>

    </table>

    <?php if ($_SESSION['role'] == 'admin') { ?>
        <a href="admin/dashboard.php">Back to Dashboard</a>
    <?php } else { ?>
        <a href="member/dashboard.php">Back to Dashboard</a>
    <?php } ?>

</body>
</html>