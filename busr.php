<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busroute</title>
    <link rel="stylesheet" href="busro.css?v=<?php echo time();?>">
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
    <center><h1>Check Your Bus Route</h1></center>
<div class="inli">
<div class="source">
        <label>BUS NUMBER </label><br>
        <input type="text" id="bnum" name="bn" placeholder="ENTER BUS NUMBER">
        </div>

   
</div>
<div class="submit">
   <center> <button onclick="busno()" name="submit" id="btnsub">Search BusRoute</button>
   </center>
</div>

</form>
<table border="1" cellspacing="0"  id="bustble">
    
    <thead>
  
    <th>Routes</th>
    
</thead>
    


<?php 

include ("nconfigroute.php");
if(isset($_POST['submit'])){
    $bnum=$_POST['bn'];
  
     $sql = "SELECT Source, Destination FROM `busno` WHERE Bus_no ='$bnum'";
    $result = mysqli_query($link, $sql);
    
    if(!$result)
{
    die("Invalid query: " . mysqli_error($link));
}  

$total=mysqli_num_rows($result);
if($total>0){
    
while($rows=mysqli_fetch_assoc($result)){
    echo "<tr id='row'>
    <td>" . $rows['Source'] ."->".$rows['Destination']."</td>
    </tr>";
}  
 }
else{
    echo "<tr >
    <td colspan='3' text-align='center' > 'Results not found'
</td>
</tr>";
}  
}?>


</table>
    </div>

    </div>
  
</body>
</html>