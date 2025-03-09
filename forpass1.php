<?php
 session_start();
 if (!isset($_SESSION['user_id'])) {
     header("Location: login.php");
     exit();
 }
 $email = $_SESSION['email'];
 $user_id = $_SESSION['user_id'];
if ($_POST){
    $newpassword=password_hash($_POST['newpassword'], PASSWORD_BCRYPT);
    include('database\db.php');
if(!$conn){
  Echo "Connection fail";
}
$sql = "UPDATE users SET password='$newpassword' WHERE email='$email'"; 
 $result=mysqli_query($conn,$sql);
 if($result){
   echo "password set";
 }
 else{
   echo "password fail";
 }
}
?>