<?php
function msg_send(){
    session_start();
     if (!isset($_SESSION['schedule_id'])) {
      header("Location: dashboard.php");
      exit();
     }
     $user_id = $_SESSION['user_id'];
     $schedule_id = $_SESSION['schedule_id'];
     include('database\db.php');
    $msg="SELECT * FROM `users` WHERE id=$user_id";
    $busdata="SELECT * FROM `bus_schedules` WHERE id=$schedule_id";
    $result=mysqli_query($conn,$msg);
    $result1=mysqli_query($conn,$busdata);
    if($msg2=mysqli_fetch_assoc($result1)){
    if($msg1=mysqli_fetch_assoc($result)){
    $email=$msg1['email'];
    $msg_type="Booking Successfull";
    $msg="Hello \t".$msg1['name']." Your Bus Booking \t". $msg2['origin']."  To  ". $msg2['destination']." Is Successfull Book Enjoy your Journey \t".$msg2['bus_number']." is your Bus Number";
    $eml=mail($email,$msg_type,$msg,"From:ganeshbudhe2022@gmail.com");
    }
    }
    }
     $conn=mysqli_connect('localhost', 'root', '', 'bus_reservation');
     
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $transaction_id = $_POST['transaction_id'];
    $res_id = $_POST['res_id'];
    $sql = "UPDATE reservations SET payment_status='paid' WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $res_id);

    if ($stmt->execute()) {
        echo "<h2>Payment Verified! Your ticket is booked.</h2>";
        msg_send();
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Online Bus Reservation</title>
        </head>
        <body>
        <nav>
            <div class="list">
           <button style="color: black;"><a href="index.html">Home</a></button>
           <button><a href="dashboard.php">dashboard</a></button>
           </div>
        </nav>
        </body>
        </html>
        <?php
    } else {
        echo "<h2>Payment Failed. Please try again.</h2>";
    }
}
?>