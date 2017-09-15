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
        <?php
        $query1 = 'SELECT profile_pix,artiste_name FROM members WHERE artiste_name="'.$_SESSION['artiste_name'].'"';
        $stmt1 = mysqli_query ($dbc,$query1);
        $result=mysqli_fetch_array($stmt1);
        echo '<img class="profile_pix" src="' . $result["profile_pix"] . '" alt="' . $result["artiste_name"] . ' \'s pix" /></img>';
        ?>
        Here you can edit your biography and upload new songs.
    </div>
    <h4 >Edit your Bio.</h4>

        <?php
            $param_username=$_SESSION['artiste_name'];
            $cwd=getcwd();
            $structure1=$cwd."/members/".$param_username;
            $bio_title=$structure1."/".$param_username;
            $bio_open=fopen("$bio_title.txt","r+");
        echo '<form method="post" enctype="multipart/form-data" action="member_bio_edit.php">
                    <input type="hidden" name="bio_name" value="'.$_SESSION["artiste_name"].'"/>
                    <textarea name="new_bio"  rows="20" cols="100" >';
                   echo fread($bio_open,filesize("$bio_title.txt"));
                   echo '</textarea>
                    <input type="submit" name="submit_bio"/>
                  </form>';
        fclose($bio_open);
        ?>

    <?php
    echo '<h4>'.$param_username.',here is a list of all your songs on our database, click any to promote it on the front page!</h4>';
    $query = 'SELECT song_title FROM members_songs WHERE artiste_name="'.$param_username.'" ORDER BY song_title ASC';
    $stmt = mysqli_query ($dbc,$query);
    echo '<ol>';
    while ($row=mysqli_fetch_array($stmt)) {
        echo '<div class="all_songs">
                    <li><a href="my_songs.php?mem_red_name='.$param_username.'&mem_red_song='.$row["song_title"].'">'. $row["song_title"] .'</a></li>
              </div>';
    }
    echo '</ol>';
    ?>


    <a href="member_upload.php?username=<?php echo $_SESSION["artiste_name"]; ?>"><h1>Click here to upload a new song for free.</h1></a>
    <?php  echo '<a href="promotions.php?member_promo='.$_SESSION["artiste_name"].' "><h1>Click here if you would like to promote any of your unuploaded songs at 50% discount</h1></a>' ?>
    <?php  echo '<a href="adverts.php?member_promo='.$_SESSION["artiste_name"].' "><h1>Would you like to advertise your worship meeting at a discount on our homepage?, If Yes, Click here</h1></a>' ?>

    <h4>Your fans have something to tell you!</h4>
    <?php
    $query = 'SELECT message_link FROM fan_messages WHERE artiste_name="'.$param_username.'" ORDER BY message_date ASC';
    $stmt = mysqli_query ($dbc,$query);
    while ($row=mysqli_fetch_array($stmt)) {
            echo '<div class="fan_messages">';
            $read_message=fopen($row["message_link"].'.txt',"r");
            echo fread($read_message,filesize($row["message_link"].'.txt'));
            fclose($read_message);
            echo '</div>';
        }
    ?>

    <?php echo '<a href="member_edit.php?name='.$_SESSION["artiste_name"].'"><h6>Click here to edit your profile</h6></a>';?>
    <p><a href="member_logout.php" class="btn btn-danger">Sign Out of Your Account</a></p>
   <a href="https://voguepay.com/register/3828-0054426"><img src="https://voguepay.com/images/banners/f.png" width="600" height="60" /></a>
</section>
<?php require ('bottom.php'); ?>