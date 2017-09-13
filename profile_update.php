<?php require('top.php');?>
<?php

if(isset($_POST["submit"])){
$edit_name=$_POST["uname"];

$born_again=$country=$sex=$dob=$phone=$email=$add=$bio= $fName=$lName= "";
$born_again_err=$country_err=$sex_err=$dob_err=$bio_err = $fname_err=$lname_err=$phone_err=$email_err=$address_err=$fb_err=$twitter_err="";
$fNAME=$_POST["first_name"]="";
$lNAME=$_POST["last_name"]="";
$dob=$_POST["dob"]="";
$born_again=$_POST["born_again"]="";
$sex=$_POST["sex"]="";
$country=$_POST["country"]="";
$phone=$_POST["phone"]="";
$email=$_POST["email"]="";
$add=$_POST["address"]="";
$fb=$_POST["facebook"]="";
$twitter=$_POST["twitter"]="";
$query = 'UPDATE members SET first_name=?,last_name=?,dob=?,born_again=?,sex=?,country=?,phone=?,email=?,address=?,fb_link=?,twitter_link=? WHERE artiste_name="'.$edit_name.'"';
$stmt = mysqli_prepare ($dbc,$query);
mysqli_stmt_bind_param($stmt, "sssssssssss",$fNAME,$lNAME,$dob,$born_again,$sex,$country,$phone,$email,$add,$fb,$twitter);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

$cwd=getcwd();
$structure1=$cwd."/members/".$edit_name;
$bio_title=$structure1."/".$edit_name;
$bio=trim($_POST['bio']);
$bio_open=fopen("$bio_title.txt","w");
fwrite($bio_open, $bio);
fclose($bio_open);

$_SESSION['artiste_name']=$edit_name;
header("location: member.php");

}
?>
<?php require ('bottom.php'); ?>
