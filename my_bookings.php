<?php
session_start();
include 'config.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch bookings for the logged-in user
$stmt = $pdo->prepare("
    SELECT reservations.id, rooms.name AS room_name, rooms.location, rooms.capacity,
           reservations.date, reservations.start_time, reservations.end_time
    FROM reservations
    JOIN rooms ON reservations.room_id = rooms.id
    WHERE reservations.user_id = ?
    ORDER BY reservations.date DESC
");
$stmt->execute([$user_id]);
$bookings = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Bookings</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        nav {
            background-color: #111;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
        }
        nav .logo {
            color: #ffcc00;
            font-weight: bold;
            font-size: 24px;
        }
        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
            padding: 8px 14px;
            border-radius: 5px;
        }
        nav ul li a:hover {
            background: #ffcc00;
            color: black;
        }
        h2 {
            text-align: center;
            color: #111;
        }
        table {
            margin: 20px auto;
            width: 90%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background: #ffcc00;
        }
    </style>
</head>
<body>

<nav>
    <div class="logo">NoRoomsForYou</div>
    <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="dashboard.php">Profile</a></li>
        <li><a href="my_bookings.php">My Bookings</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>

<h2>My Booked Rooms</h2>

<?php if (count($bookings) > 0): ?>
    <table>
        <tr>
            <th>Room Name</th>
            <th>Location</th>
            <th>Capacity</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>End Time</th>
        </tr>
        <?php foreach ($bookings as $booking): ?>
        <tr>
            <td><?= htmlspecialchars($booking['room_name']) ?></td>
            <td><?= htmlspecialchars($booking['location']) ?></td>
            <td><?= htmlspecialchars($booking['capacity']) ?></td>
            <td><?= htmlspecialchars($booking['date']) ?></td>
            <td><?= htmlspecialchars($booking['start_time']) ?></td>
            <td><?= htmlspecialchars($booking['end_time']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p style="text-align:center;">You haven't booked any rooms yet.</p>
<?php endif; ?>

</body>
</html>
