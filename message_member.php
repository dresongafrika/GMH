<?php require ('top.php'); ?>
<section id="main">
<?php
    if(isset($_POST['submit'])){
    $param_username=$_POST['artiste_name'];
    $cwd=getcwd();
    $structure1=$cwd."/members/".$param_username;
    $structure5=$structure1."/fan messages";
    $name=$_POST["name"];
    $number=$_POST["number"];
    $email=$_POST["mail"];
    $date=date("Y-m-d H:i:s");
    $subject=strtoupper($_POST["subject"]);
    $message=$_POST["message"];
    $message_target=$structure5.'/'.$subject.'from'.$name;
    $message_content = fopen($subject. "from" .$name.".txt", "w");
    fwrite($message_content, $subject.PHP_EOL);
    fwrite($message_content, $name.PHP_EOL);
    fwrite($message_content, $number.PHP_EOL);
    fwrite($message_content, $email.PHP_EOL);
    fwrite($message_content, $date.PHP_EOL);
    fwrite($message_content, $message.PHP_EOL);
    fclose($message_content);
    rename($subject ."from". $name.".txt",$message_target.".txt");
    $query='INSERT INTO fan_messages VALUES (NULL,?,?,NOW())';
    $stmt = mysqli_prepare ($dbc,$query);
    mysqli_stmt_bind_param($stmt, "ss",$param_username,$message_target);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    echo '<h4>Thank you!'.$name.'.'.$param_username.'will get back to you if need be.</h4>
    <a href="member_page.php?name='.$param_username.'" >Click here to go back to your favourite artiste_page.</a>';
    }
?>
</section>
<?php require ('bottom.php'); ?>
