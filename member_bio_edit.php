<?php
if (isset($_POST["submit_bio"])){
    $param_username=$_POST['bio_name'];
    $cwd=getcwd();
    $structure1=$cwd."/members/".$param_username;
    $bio_title=$structure1."/".$param_username;
    $bio_open=fopen("$bio_title.txt","w");
    $new_bio=$_POST["new_bio"];
    fwrite($bio_open,$new_bio);
    fclose($bio_open);
    $_SESSION['artiste_name']=$param_username;
    header('location:member.php');
}
