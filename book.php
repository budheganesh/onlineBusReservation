<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include('database\db.php');
$user_id = $_SESSION['user_id'];
$schedule_id = $_GET['schedule_id'];
$_SESSION['schedule_id'] = $schedule_id;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $seat_number = $_POST['jsValue'];
  $print="SELECT * FROM `bus_schedules` WHERE id=$schedule_id";
  $result=mysqli_query($conn,$print);
  if(!$result){
    echo "<p style='color:red;'>Connection _fail...</p>";
  }
  if($row=mysqli_fetch_assoc($result)){
        $price=$row['price'];
        $bus_number=$row['bus_number'];
  }
    // Check if the seat is already booked
    $check_sql = "SELECT * FROM reservations WHERE schedule_id =? AND seat_number = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ii",$schedule_id,$seat_number);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        // Seat is already booked
        echo "<p style='color:red;'>Seat number $seat_number is already taken. Please choose a different seat.</p>";
    } else {
        if($seat_number<=48){
        // Proceed with booking the seat
        $insert_sql = "INSERT INTO reservations (user_id, schedule_id, seat_number,bus_number,price) VALUES (?,?,?,?,?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("iiisi",$user_id,$schedule_id,$seat_number,$bus_number,$price);
        }
        else
        {
         echo "<p style='color:red;'>Please choose a seat between 1 to 48.</p>";
        }
        if ($insert_stmt->execute()) {
            echo "Seat Booked! Pay Now: <a href='payment.php?res_id={$conn->insert_id}'>Proceed to Payment</a>";
            // <td><a href='book.php?schedule_id={$row['id']}'>Book</a></td>

                // header("Location: dashboard.php");
                ?>
                <br>
        <a href="dashboard.php"><input type="button" value="back to dashbord"></a>
          <?php
            exit();
        } else {
            echo "<p style='color:red;'>There was an error booking the seat. Please try again.</p>";
            ?>
        <a href="dashboard.php"><input type="button" value="back to dashbord"></a>
          <?php
        }
    }

       ?>
        <a href="dashboard.php"><input type="button" value="back to dashbord"></a>
    <?php
    $check_stmt->close();
    $insert_stmt->close();
}
$schedule_sql = "SELECT * FROM bus_schedules WHERE id = ?";
$schedule_stmt = $conn->prepare($schedule_sql);
$schedule_stmt->bind_param("i", $schedule_id);
$schedule_stmt->execute();
$schedule_result = $schedule_stmt->get_result()->fetch_assoc();
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Seat</title>
<style>
 body{
    background-color: black;
 }
 h1{
    text-align: center;
    color: peru;
 }
 .outer{
    display: flex;
    /* align-items: center; */
    justify-content: center;
 }
.seat{
    height: 790px;
    width: 300px;
    border: 1px solid yellow;
    border-radius: 15px;
}
button{
    /* border-radius: 50%; */
    height: 50px;
    width: 50px;
    margin-left: 8px;
    margin-top: 8px;
    cursor: pointer;
}
  p{
    display: inline;
    font-size: 40px;
    font-weight: bold;
  }
  .from{
    padding: 0px;
    margin: 0px;
    text-align: center;
  }
  button:hover{
    background-color: green;
  }
  .drive{
    height: 50px;
    width: 50px;
    margin-left: 8px;
    margin-top: 8px;
    cursor: pointer;
  }
</style>
</head>
<body>
<h1>Book Seat for</h1> <h1 style="color: red;"></h1>
    <div class="outer">
    <div class="seat">
     <p >=></p>
    <input type="button" class="drive" onclick="alert('This seat is Driver side Please choose different seat');" style="background-color:red; margin-left: 187px;">
    <br>
    <br>
    <input type="button" class="drive" onclick="alert('This seat is Driver side Please choose different seat');" style="background-color:red;">
    <button value="1" class="btn1" onclick="seatbook(this)">1</button>
    <button value="2" class="btn2" onclick="seatbook(this)" style="margin-left: 50px;">2</button>
    <button value="3" class="btn3" onclick="seatbook(this)">3</button>
    <button value="7" class="btn7" onclick="seatbook(this)">7</button>
    <button value="6" class="btn6" onclick="seatbook(this)">6</button>
    <button value="5" class="btn5" onclick="seatbook(this)" style="margin-left: 50px;">5</button>
    <button value="4" class="btn4" onclick="seatbook(this)">4</button>
    <button value="8" class="btn8" onclick="seatbook(this)">8</button>
    <button value="9" class="btn9" onclick="seatbook(this)">9</button>
    <button value="10" class="btn10" onclick="seatbook(this)" style="margin-left: 50px;">10</button>
    <button value="11" class="btn11" onclick="seatbook(this)">11</button>
    <button value="15" class="btn15" onclick="seatbook(this)">15</button>
    <button value="14" class="btn14" onclick="seatbook(this)">14</button>
    <button value="13" class="btn13" onclick="seatbook(this)" style="margin-left: 50px;">13</button>
    <button value="12" class="btn12" onclick="seatbook(this)">12</button>

    <button value="16" class="btn16" onclick="seatbook(this)">16</button>
    <button value="17" class="btn17" onclick="seatbook(this)">17</button>
    <button value="18" class="btn18" onclick="seatbook(this)" style="margin-left: 50px;">18</button>
    <button value="19" class="btn19" onclick="seatbook(this)">19</button>

    <button value="23" class="btn23" onclick="seatbook(this)">23</button>
    <button value="22" class="btn22" onclick="seatbook(this)">22</button>
    <button value="21" class="btn21" onclick="seatbook(this)" style="margin-left: 50px;">21</button>
    <button value="20" class="btn20" onclick="seatbook(this)">20</button>

    <button value="24" class="btn24" onclick="seatbook(this)">24</button>
    <button value="25" class="btn25" onclick="seatbook(this)">25</button>
    <button value="26" class="btn26" onclick="seatbook(this)" style="margin-left: 50px;">26</button>
    <button value="27" class="btn27" onclick="seatbook(this)">27</button>
    <button value="31" class="btn31" onclick="seatbook(this)">31</button>
    <button value="30" class="btn30" onclick="seatbook(this)">30</button>
    <button value="29" class="btn29" onclick="seatbook(this)" style="margin-left: 50px;">29</button>
    <button value="28" class="btn28" onclick="seatbook(this)">28</button>
    <button value="32" class="btn32" onclick="seatbook(this)">32</button>
    <button value="33" class="btn33" onclick="seatbook(this)">33</button>
    <button value="34" class="btn34" onclick="seatbook(this)" style="margin-left: 50px;">34</button>
    <button value="35" class="btn35" onclick="seatbook(this)">35</button>
    <button value="39" class="btn39" onclick="seatbook(this)">39</button>
    <button value="38" class="btn38" onclick="seatbook(this)">38</button>
    <button value="37" class="btn37" onclick="seatbook(this)" style="margin-left: 50px;">37</button>
    <button value="36" class="btn36" onclick="seatbook(this)">36</button>
    <button value="40" class="btn40" onclick="seatbook(this)">40</button>
    <button value="41" class="btn41" onclick="seatbook(this)">41</button>
    <button value="42" class="btn42" onclick="seatbook(this)" style="margin-left: 50px;">42</button>
    <button value="43" class="btn43" onclick="seatbook(this)">43</button>


    <button value="48" class="btn48" onclick="seatbook(this)" style="height: 45px; width:45px">48</button>
    <button value="47" class="btn47" onclick="seatbook(this)" style="height: 45px; width:45px">47</button>
    <button value="46" class="btn46" onclick="seatbook(this)" style="height: 45px; width:45px">46</button>
    <button value="45" class="btn45" onclick="seatbook(this)" style="height: 45px; width:45px">45</button>
    <button value="44" class="btn44"  style="height: 45px; width:45px">44</button>
    </div>
    <div class="form">
    <form id="myForm" method="POST">
        <input type="hidden" name="jsValue" id="jsValue">
        <button type="submit" style="padding-left: 3px;">Submit</button>
    </form>
    </div>
    </div>
    
    <script>
        function seatbook(btn){
           btn1=btn.innerText;
           console.log(btn1);
           
           document.getElementById("jsValue").value =(btn1);
           
        }
    </script>
    <?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
    $_SESSION['schedule_id'] = $schedule_id;
    $conn=mysqli_connect("localhost","root","","bus_reservation");
     if(!$conn){
      echo "Connection fail";
     }
     $print="SELECT * FROM `reservations` WHERE schedule_id=$schedule_id";
     $result=mysqli_query($conn,$print);
     while($row=mysqli_fetch_assoc($result)){
      echo $row['seat_number'];
      echo "<br>";
      // if($row['seat_number']==)
      
     for($i=1;$i<=48;$i++)
      if($row['seat_number']==$i)
     {
      ?>
      <script>
        var i="<?php echo $i;?>";
      console.log(i);
       
      var bb=document.querySelector(".btn"+i);
      bb.style.backgroundColor="pink";
      bb.style.color="red";
      bb.style.filter="blur(1px)";
      bb.addEventListener("focus",function(){
        this.disabled=true;
      })
      </script>
      <?php
     } 
     }
    ?>
</body>
</html>