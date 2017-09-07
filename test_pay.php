<?php
$name="";
$pass="";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name=$_GET['name'];
   echo' <a href="/member_create.php?pay=yes&username='.$name.'">'.$name.',click here</a>';
}
?>


