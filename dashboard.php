<?php
session_start();
include 'config.php';

// Temporary session mock
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = 1;
}

$user_id = $_SESSION['user_id'];
$username = "Guest";

// Fetch user data
$stmt = $pdo->prepare("SELECT username FROM users WHERE id = ?");
$stmt->execute([$user_id]);
if ($row = $stmt->fetch()) {
    $username = $row['username'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Room Booking</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        nav {
            background-color: #111;
            padding: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        nav .logo {
            color: #ffcc00;
            font-size: 24px;
            font-weight: bold;
            float: left;
        }

        nav ul {
            list-style: none;
            float: right;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-left: 20px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 5px;
            transition: background 0.3s, color 0.3s;
        }

        nav ul li a:hover {
            background-color: #ffcc00;
            color: black;
        }

        .centered-box {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 70vh;
        }

        .user-info {
            background-color: #f9f9f9;
            padding: 20px 30px;
            border-left: 6px solid #ffcc00;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        h1 {
            color: #222;
        }

        p {
            font-size: 16px;
            color: #666;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 6px 10px rgba(0,0,0,0.1);
            border-radius: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        table th {
            background-color: #ddd;
        }

        footer {
            text-align: center;
            padding: 20px;
            color: #aaa;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo">NoRoomsForYou</div>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="my_bookings.php">My Bookings</a></li>
            <li><a href="dashboard.php">Profile</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
        <div style="clear: both;"></div>
    </nav>

    <!-- Centered User Info -->
    <div class="centered-box">
        <div class="user-info">
            <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
            <p>User ID: <strong><?php echo htmlspecialchars($user_id); ?></strong></p>
        </div>
    </div>

    <!-- Other Dashboard Content -->
    

    <footer>
        &copy; 2025 Room Reservation System
    </footer>
</body>
</html>
