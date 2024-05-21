<?php
$link = mysqli_connect('localhost','root','','busdet');
if(!$link){
    die('failed to connect'.mysqli_connect_error());
}
?>