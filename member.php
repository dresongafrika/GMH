<?php
require ("top.php");
?>
<section id="main">
    <?php
    // Initialize the session
    //If the redirection is coming from member edit.
    // If session variable is not set it will redirect to login page
    if(!isset($_SESSION['artiste_name']) || empty($_SESSION['artiste_name'])){
        header("location: member_login.php");
        exit;
    }
    ?>

    <div class="page-header">
        <h1>Hi, <b><?php echo $_SESSION['artiste_name']; ?></b>. Welcome to your page.</h1>
        Here you can edit your biography and upload new songs.
    </div>
    <h4 >Edit your Bio.</h4>

        <?php
            $cwd=getcwd();
            $param_username=$_SESSION['artiste_name'];
            $structure1=$cwd."/members/".$param_username;
            $bio_title=$structure1."/".$param_username;
            $bio_open=fopen("$bio_title.txt","r+");
        echo '<form method="post" enctype="multipart/form-data" action="'. htmlspecialchars ($_SERVER["PHP_SELF"]).'">
                    <textarea id="new_bio"  rows="20" cols="100" >';
                   echo fread($bio_open,filesize("$bio_title.txt"));
                   echo '</textarea>
                    <input type="submit" name="submit_bio"/>
                  </form>';
            if (isset($_POST["submit_bio"])){
                if(isset($_POST["new_bio"])){
                $new_bio=$_POST["new_bio"];
                echo fwrite($bio_open,$new_bio);
                }
            }
        fclose($bio_open);
        ?>

    <h4>Upload a new song.</h4>
    <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars ($_SERVER["PHP_SELF"]);?>">
        Type in the song title:
        <input type="text" name="title" required="required" >
        Type in the album title if it is part of an album:
        <input type="text" name="album" >
        Select mp3 to upload:
        <input type="file" name="mp3" required="required" >
        Select album cover to upload:
        <input type="file" name="cover" required="required" >
        Type in the lyrics:
        <textarea name="lyrics" rows="4" cols="50" placeholder="Type it this way. Please ensure it contains the necessary song parts like choruses, verses and bridge" required="required"></textarea></br>
        <input type="submit" value="Upload" name="submit">
    </form>
    <?php
    if (isset($_POST['submit'])){
        $param_username=$_SESSION['artiste_name'];
        $aNAME=$_POST["name"];
        $sNAME=$_POST["title"];
        $album=$_POST["album"];
        $lyrics=$_POST["lyrics"];
        $albumART = basename($_FILES ["cover"]["name"]);
        $songNAME = basename($_FILES["mp3"]["name"]);
        $target_dir = "members/".$param_username."/uploads/";
        $target_file = $target_dir .$songNAME."by".isset($_POST["name"]);
        $uploadOk = 1;
        $songFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        $img_dir = "members/".$param_username."/album art/".$albumART."by".isset($_POST["name"]);
        $img_dirType = pathinfo($img_dir,PATHINFO_EXTENSION);

        // Check file size
        if ($_FILES["mp3"]["size"] > 10000000) {
            $uploadOk = 0;
            echo '</br>*<span style="color:red;">Please ensure that your song is less than 10MB </span></br>';
        }
        // Allow certain file formats
        if($songFileType != "mp3" && $songFileType != "MP3") {
            $uploadOk = 0;
            echo '*<span style="color:red;">Only mp3 files are allowed</span></br>';
        }
        if($img_dirType != "jpg" && $img_dirType != "png" && $img_dirType != "JPG" && $img_dirType != "PNG") {
            $uploadOk = 0;
            echo '*<span style="color:red;">Upload an album art with a jpg or png extension</span></br>';
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo  '*<span style="color:red;">Sorry, your file was not uploaded</span></br>';
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES ["mp3"]["tmp_name"],$target_file) && move_uploaded_file($_FILES ["cover"]["tmp_name"],$img_dir)) {
                echo $sNAME." has been successfully uploaded.</br>";

                /** save lyrics **/

                $message_target='members/'.$_SESSION['artiste_name'].'/lyrics/';
                $lyricCONTENT = fopen("$sNAME by $aNAME.txt", "w");
                fwrite($lyricCONTENT, $lyrics);
                fclose($lyricCONTENT);
                rename("$sNAME by $aNAME.txt","$message_target$sNAME by $aNAME.txt");
                /** send data to database  **/

                $query = "SELECT artiste_id FROM members WHERE artiste_name='".$_SESSION['artiste_name'];
                $stmt = mysqli_query ($dbc,$query);
                $row=mysqli_fetch_array($stmt);
                $id=$row["artiste_id"];


                $query = "INSERT INTO members_songs VALUES (?,?,?,?,?,?)";
                $link='member_songs.php?mem_red_name='.$_SESSION['artiste_name'].'&mem_red_song='.$sNAME;
                $stmt = mysqli_prepare ($dbc,$query);
                mysqli_stmt_bind_param($stmt, "isssss",$id,$_SESSION['artiste_name'],$sNAME,$album,$img_dir,$link);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                $query = "SELECT * FROM members_songs WHERE artiste_name='".$_SESSION['artiste_name'];
                $stmt = mysqli_query ($dbc,$query);
                $row=mysqli_fetch_array($stmt);
                echo 'Here is the link to your song: <a href="member_songs.php?mem_red_name='.$row["artiste_name"].'&mem_red_song='.$sNAME.'">member_songs.php?mem_red_name='.$row["artiste_name"].'&mem_red_song='.$sNAME.'</a> ';

            } else {
                echo '<span style="color:red;">*Sorry, there was an error uploading your file.</span>';
            }
        }
    }
    ?>
    <?php  echo '<a href="promotions.php?member_promo=" '.$_SESSION["artiste_name"].' "><h6>Click here if you would like to promote any of your songs at 50% discount</h6></a>' ?>
    <?php  echo '<a href="index.php?member_promo=" '.$_SESSION["artiste_name"].' "><h6>Would you like to advertise your worship meeting at a discount, If Yes. Click here</h6></a>' ?>

    <h4>Your fans have something to tell you!</h4>
    <?php
    $query = "SELECT message_link FROM fan_messsages WHERE artiste_name=".$_SESSION['artiste_name']."ORDER BY message_date ASC" ;
    $stmt = mysqli_query ($dbc,$query);
    while ($row=mysqli_fetch_array($stmt)) {
            echo '<div class="fan_messages">';
            $read_message=fopen($row["message_link"].'.txt',"r");
            echo fread($read_message,filesize($row["message_link"].'.txt'));
            fclose($read_message);
            echo '</div>';
        }
    ?>




    <?php echo '<a href="member_edit.php?name='.$_SESSION["artiste_name"].'><h6>Click here to edit your profile</h6></a>';?>
    <p><a href="member_logout.php" class="btn btn-danger">Sign Out of Your Account</a></p>
    </br><a href="https://voguepay.com/register/3828-0054426"><img src="https://voguepay.com/images/banners/f.png" width="600" height="60" /></a>
</section>
<?php require ('bottom.php'); ?>