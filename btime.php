<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busno</title>
    <link rel="stylesheet" href="bt.css?v=<?php echo time();?>">
    <style>
        body{
            background:url(busimg.jpeg);
            background-repeat: no-repeat;
            width:100%;
            background-size: cover;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="busboard">
<form method="POST" action="">
    <center><h1>Check Bus Timing</h1></center>
<div class="inli">
    <div class="source">
    <label>SOURCE :</label>
    <input type="text" id="sourceid" name="src" placeholder="From">
    </div>

    <div class="destination">
    <label>DESTINATION :</label>
    <input type="text" id="destinationid" name="des" placeholder="To">
    </div>
</div>
<div class="submit">
   <center> <button onclick="busno()" name="submit" id="btnsub">Search Bus Time</button>
   </center>
</div>

</form>
<table border="1" cellspacing="0"  id="bustble">
    
    <thead>
    <th>Bus Number</th>
    <th>Source</th>

    <th>Destination</th>
    
    <th>Arrival Time</th>
</thead>

    


<?php 
include ("config.php");
if(isset($_POST['submit'])){
    $src=$_POST['src'];
    $des=$_POST['des']; 
     $sql = "SELECT Bus_no,Time FROM `busroute` WHERE Source='$src' AND Bus_no IN (SELECT Bus_no FROM `busroute` WHERE Destination='$des')";
    $result = mysqli_query($link, $sql);
    if(!$result)
{
    die("Invalid query: " . mysqli_error($link));
}  

$total=mysqli_num_rows($result);
if($total>0){
while($rows=mysqli_fetch_assoc($result)){
    echo "<tr id='row'>
    <td>" . $rows['Bus_no'] . "</td>
    <td>" . $src . "</td>
    <td>" . $des . "</td>
    <td>" . $rows['Time']. "</td>
    
    </tr>";
}   }
else{
    echo "<tr >
    <td colspan='3' text-align='center' > 'Results not found'
</td>
</tr>";
}  
}?>


</table>

    </div>
    <button>back</button>
    </div>
    
</body>
</html>