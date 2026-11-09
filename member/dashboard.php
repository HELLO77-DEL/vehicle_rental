<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'member') {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Member Dashboard</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        h3 {
            font-size: 30px;
        }

        .welcome {
            margin-bottom: 30px;
        }

        .cards {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            width: 50%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fff;
        }

        .card h3 {
            color: #333;
        }

        .card p {
            color: #666;
        }

        a {
            color: #0066cc;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .logout {
            display: inline-block;
            background-color: #cc3333;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 25px;
        }

        .logout:hover {
            background-color: #aa2222;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="container">

        <h1>👥 Member Dashboard</h1>

        <div class="welcome">
            <h3>Welcome, <?php echo htmlspecialchars($_SESSION['fullname']); ?>!</h3>
        </div>

        <div class="cards">

            <div class="card">
                <h3>🚗 Available Vehicles</h3>
                <p>Browse and choose from the vehicles available for rent.</p>
                <a href="../available_vehicle.php">View Vehicles</a>
            </div>

            <div class="card">
                <h3>🧾 My Rentals</h3>
                <p>View your rental records and rental status.</p>
                <a href="my_rentals.php">View My Rentals</a>
            </div>

        </div>

        <a class="logout" href="../logout.php">Logout</a>

    </div>

</body>
</html>