<?php
include 'config.php';
session_start();

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please login to book a room.'); window.location.href='login.php';</script>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $room_id = $_POST['room'];
    $date = $_POST['date'];
    $start_time = $_POST['start'];
    $end_time = $_POST['end'];

    // Check if the room is already booked for the selected time slot
    $stmt = $pdo->prepare("
        SELECT * FROM reservations 
        WHERE room_id = ? AND date = ? 
        AND (
            (start_time < ? AND end_time > ?)  
            OR
            (start_time < ? AND end_time > ?)  
            OR
            (start_time >= ? AND end_time <= ?) 
        )
    ");
    $stmt->execute([
        $room_id, $date,
        $end_time, $start_time,
        $end_time, $start_time,
        $start_time, $end_time
    ]);

    if ($stmt->rowCount() > 0) {
        echo "<script>alert('Room is already booked for the selected time slot.'); window.history.back();</script>";
    } else {
        $insert = $pdo->prepare("INSERT INTO reservations (user_id, room_id, date, start_time, end_time) VALUES (?, ?, ?, ?, ?)");
        $insert->execute([$user_id, $room_id, $date, $start_time, $end_time]);

        echo "<script>alert('Room booked successfully!'); window.location.href='dashboard.php';</script>";
    }
}
?>
