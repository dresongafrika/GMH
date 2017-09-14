<?php require ('top.php') ?>
<section id="main">
<h2>You want to reach us? We are eager to hear from you too</h2>
<form action="<?php echo htmlspecialchars ($_SERVER["PHP_SELF"]);?>" method="GET" enctype="text/plain">
    Name:<br>
    <input type="text" name="name" placeholder="your name" required="required"><br>
    Phone number:<br>
    <input type="tel" name="number" placeholder="your number preceded by country code" required="required"><br>
    E-mail:<br>
    <input type="email" name="mail" placeholder="youremail@website.com" required="required"><br>
    Subject:<br>
    <input type="text" name="subject" placeholder="your name" required="required"><br>
    Your message:<br>
    <textarea name="message" rows="4" cols="50" placeholder="Your message goes here" required="required"></textarea><br>
    <input type="submit" value="SEND MESSAGE" name="submit">
</form>
<?php
if(isset($_GET['submit'])){
    $name=$_GET["name"];
    $number=$_GET["number"];
    $email=$_GET["mail"];
    $subject=$_GET["subject"];
    $date=date("Y-m-d H:i:s");
    $message=$_GET["message"];
    $message_target="messages/".$subject." from ".$name.".txt";
    $message_content = fopen($subject. "from" .$name.".txt", "w");
    $new_subject="$subject from $name.txt";
    fwrite($message_content, $subject.PHP_EOL);
    fwrite($message_content, $name.PHP_EOL);
    fwrite($message_content, $number.PHP_EOL);
    fwrite($message_content, $email.PHP_EOL);
    fwrite($message_content, $date.PHP_EOL);
    fwrite($message_content, $message.PHP_EOL);
    fclose($message_content);
    rename($subject. "from" .$name.".txt",$message_target);
    $query='INSERT INTO contact_us (message_date,guest_name,message_link) VALUES (NOW(),?,?)';
    $stmt = mysqli_prepare ($dbc,$query);
    mysqli_stmt_bind_param($stmt, "ss",$name,$message_target);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    echo '<h4>'.ucfirst($name).',thank you for contacting us. We will get back to you if need be</h4>';
}
?>
</section>
<?php require ('bottom.php') ?>
