<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 40px;
            background-color: white;
            color: black;
        }

        .container {
            width: 90%;
            margin: auto;
            padding: 30px;
            border: 1px solid black;
        }

        h1 {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .welcome {
            margin-bottom: 30px;
        }

        hr {
            border: 0;
            border-top: 1px solid black;
        }

        h2 {
            margin-top: 30px;
        }

        h3 {
            font-size: 25px;
        }

        .menu {
            display: flex;
            gap: 25px;
            margin-top: 20px;
        }

        .menu a {
            flex: 1;
            padding: 30px 15px;
            border: 1px solid black;
            color: black;
            background-color: white;
            text-decoration: none;
            text-align: center;
        }

        .menu a:hover {
            background-color: #eeeeee;
        }

        .menu h3 {
            margin-top: 0;
        }

        .menu p {
            margin-bottom: 0;
        }

        .logout {
            display: inline-block;
            margin-top: 30px;
            padding: 10px 25px;
            border: 1px solid black;
            color: black;
            background-color: white;
            text-decoration: none;
        }

        .logout:hover {
            background-color: #eeeeee;
        }

    </style>
</head>

<body>

    <div class="container">

        <h1>👤 Admin Dashboard</h1>

        <div class="welcome">
            <p>Welcome, <?php echo htmlspecialchars($_SESSION['fullname']); ?>!</p>
        </div>

        <hr>

        <h2>Vehicle Management</h2>

        <div class="menu">

            <a href="../add_vehicle.php">
                <h3>✚ 🚗 Add Vehicle</h3>
                <p>Add a new vehicle to the system.</p>
            </a>

            <a href="../vehicle_records.php">
                <h3>🛠️ Manage Vehicles</h3>
                <p>View, edit, and delete vehicle records.</p>
            </a>

            <a href="../available_vehicle.php">
                <h3>✅ Available Vehicles</h3>
                <p>View all active vehicles.</p>
            </a>

        </div>

        <a class="logout" href="../logout.php">Logout</a>

    </div>

</body>
</html>