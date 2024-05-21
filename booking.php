<?php 
require 'db.php';
session_start();

// Function to check if a seat is already chosen
function isSeatChosen($seatNumber) {
    if(isset($_SESSION['chosen_seats']) && in_array($seatNumber, $_SESSION['chosen_seats'])) {
        return true;
    }
    return false;
}

$availableSeats = range(1, 40); 

if (isset($_SESSION['chosen_seats'])) {
   // echo "You have already chosen seat number(s): " . implode(', ', $_SESSION['chosen_seats']);
} else {
    $_SESSION['chosen_seats'] = array();
}

if(isset($_POST["submit"])){
    $name=$_POST["name"];
    $email=$_POST["email"];
    $des=$_POST["des"];
    $date=$_POST["da"];
    $number=$_POST["no"];
    $selectedSeatNumber = $_POST["seat_number"];
    if (in_array($selectedSeatNumber, $availableSeats) && !isSeatChosen($selectedSeatNumber)) {
        $_SESSION['chosen_seats'][] = $selectedSeatNumber; 
    } else {
        //echo "Seat number $selectedSeatNumber is not available or already chosen.";
    }

    $checkQuery = "SELECT * FROM savedata WHERE seatno = '$selectedSeatNumber'";
    $checkResult = mysqli_query($conn, $checkQuery);
    if (mysqli_num_rows($checkResult) > 0) {
        echo "Seat number $selectedSeatNumber is already chosen in the database.";
    } else {
        $query = "INSERT INTO savedata (name, email, destination, date, num, seatno) VALUES ('$name', '$email', '$des', '$date', '$number', '$selectedSeatNumber')";
        if(mysqli_query($conn, $query)) {
            echo "<script>alert('Data inserted successfully');</script>";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>

    <style>
         body {
            font-family: Arial, sans-serif;
  
        }
        form{
            
        max-width: 600px;
        padding: 80px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border: 2px solid black;
        background-color: #f2f2f2;
   font: 200px;
           
        }
        input{
            font-size:30px;
            margin-bottom:20px;
        
        }
        label{
            font-size: 30px;

        }
        select{
            font-size:30px;
            margin-bottom:20px;   
        }
        button{
            padding:20px;
            font-size: 30px;
            border-radius:30px;
        }
    </style>
</head>
<body>
<center>
    <h1>Welcome To Bus Booking </h1>
    <form action="" method="post" id="form">
            <center>
        <label for="name">Name</label>
        <input type="text" name="name" id="name"> <br><br>
        <label for="email">Email</label>
        <input type="email" name="email" id="email"><br><br>
        <label for="des">Destination</label>
        <select name="des" id="des">
            <option value="">Select destination</option>
            <option value="Adimalaipatti">Adimalaipatti</option>
            <option value="Agraharapulaveri">Agraharapulaveri</option>
            <option value="Neykkarappatti">Neykkarappatti</option>
        </select><br><br>
        <label for="da">Date Of destination</label>
        <input type="date" name="da" id="da"><br><br>
        <label for="no">Bus number</label>
        <input type="text" name="no" id="no"><br><br>
        <label for="seat_number">Select a Seat Number:</label>
        <select name="seat_number" id="seat_number">
        <?php
            foreach ($availableSeats as $seat) {
                if (!isSeatChosen($seat)) {
                    echo "<option value=\"$seat\">$seat</option>";
                }
            }
            ?>
        </select>
        <br><br>
        <button type="submit" name="submit">Submit</button>
        </center>
    </form>
    </center>
</body>
</html>
