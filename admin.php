<?php require ('top.php'); ?>
<section id="main">
<h4>MESSAGES!</h4>
<?php
$query = "SELECT message_link FROM contact_us ORDER BY message_date ASC" ;
$stmt = mysqli_query ($dbc,$query);
while ($row=mysqli_fetch_array($stmt)) {
    echo '<div id="contact_us">';
    $read_message=fopen($row["message_link"],"r");
    echo fread($read_message,filesize($row["message_link"]));
    fclose($read_message);
    echo '</div>';
}
?>
</section>
<?php require ('bottom.php'); ?>

