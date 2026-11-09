<?php
session_start();
require_once "../db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'member') {
    header("Location: ../login.php");
    exit();
}

$fullname = $_SESSION['fullname'];

$stmt = $pdo->prepare("
    SELECT * FROM rentals
    WHERE customer_name = ?
    ORDER BY id DESC
");

$stmt->execute([$fullname]);
$rentals = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Rentals</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        .container {
            width: 90%;
            margin: 30px auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #333;
            color: white;
        }

        .back {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #333;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .back:hover {
            background-color: #555;
        }

        .empty {
            text-align: center;
            padding: 20px;
        }
    </style>
</head>

<body>

<div class="container">

    <a href="dashboard.php" class="back">Back to Dashboard</a>

<h2>My Rentals</h2>

    <p>Welcome, <?php echo htmlspecialchars($fullname); ?>!</p>

    <?php if (count($rentals) > 0): ?>

        <table>
            <tr>
                <th>Rental ID</th>
                <th>Vehicle ID</th>
                <th>Rental Date</th>
                <th>Return Date</th>
                <th>Total Days</th>
                <th>Total Price</th>
                <th>Status</th>
            </tr>

            <?php foreach ($rentals as $rental): ?>

                <tr>
                    <td><?php echo htmlspecialchars($rental['id']); ?></td>

                    <td><?php echo htmlspecialchars($rental['vehicle_id']); ?></td>

                    <td><?php echo htmlspecialchars($rental['rental_date']); ?></td>

                    <td><?php echo htmlspecialchars($rental['return_date']); ?></td>

                    <td><?php echo htmlspecialchars($rental['total_days']); ?></td>

                    <td>₱<?php echo number_format((float)$rental['total_price'], 2); ?></td>

                    <td><?php echo htmlspecialchars($rental['rental_status']); ?></td>
                </tr>

            <?php endforeach; ?>

        </table>

    <?php else: ?>

        <p class="empty">You currently have no rental records.</p>

    <?php endif; ?>


</div>

</body>
</html>