<?php require('top.php');?>
<section id="main">
    <?php

    if(isset($_POST["submit"])){

        $edit_name=$_POST["uname"];


        $albumART = basename($_FILES ["pix"]["name"]);
        $img_dir = "members/".$edit_name."/".$albumART;
        $img_dirType = pathinfo($albumART,PATHINFO_EXTENSION);
        $uploadOk = 1;

        if($img_dirType != "jpg" && $img_dirType != "png" && $img_dirType != "JPG" && $img_dirType != "PNG") {
            $uploadOk = 0;
            echo '*<span style="color:red;">Please upload a profile picture with a jpg or png extension to proceed</span></br>';
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk !== 0) {
            move_uploaded_file($_FILES ["pix"]["tmp_name"], $img_dir);

            $fNAME=$_POST["first_name"];
            $lNAME=$_POST["last_name"];
            $dob=$_POST["dob"];
            $born_again=$_POST["born_again"];
            $sex=$_POST["sex"];
            $country=$_POST["country"];
            $phone=$_POST["phone"];
            $email=$_POST["email"];
            $add=$_POST["address"];
            $fb=$_POST["facebook"];
            $twitter=$_POST["twitter"];

            $query = 'UPDATE members SET first_name=?,last_name=?,dob=?,born_again=?,sex=?,country=?,phone=?,email=?,address=?,fb_link=?,twitter_link=?,profile_pix=? WHERE artiste_name="'.$edit_name.'"';
            $stmt = mysqli_prepare ($dbc,$query);
            mysqli_stmt_bind_param($stmt, "ssssssssssss",$fNAME,$lNAME,$dob,$born_again,$sex,$country,$phone,$email,$add,$fb,$twitter,$img_dir);
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
    }
    ?>
</section>
<?php require ('bottom.php'); ?>
