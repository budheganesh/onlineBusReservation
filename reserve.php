<?php
 session_start();
 if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
 }
 include('database\db.php');
 $schedule_id = $_GET['schedule_id'];
 $user_id = $_SESSION['user_id'];
 $seat_number = $_POST['seat_number'];
 $stmt = $conn->prepare("INSERT INTO reservations (user_id, schedule_id, seat_number) VALUES (?, ?,
 ?)");
 $stmt->bind_param("iii", $user_id, $schedule_id, $seat_number);
 $stmt->execute();
 echo "Reservation successful!";
 $stmt->close();
 $conn->close();
 ?>