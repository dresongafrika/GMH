<?php require ('top.php') ?>
<section id="main">
<?php
    if (isset ($_GET['redirect'])){
        $redirect = $_GET['redirect'];
        $query = "SELECT * FROM music_promotion WHERE artiste_name='".$redirect."'";
        $stmt = mysqli_query ($dbc,$query);
        $row=mysqli_fetch_array($stmt);
        $bio_target="promotions/biographies/";
        $lyric_target="promotions/lyrics/";
        $sNAME=$row["song_title"];
        $aNAME=$row["artiste_name"];
        echo '<h2>'.$row["song_title"]. ' by ' .$row["artiste_name"].'</h2>';
        echo '<h3>BIO</h3>';
        echo '<div id="bio_cont" >';
        $read_bio = fopen("$bio_target$aNAME.txt", "r");
        echo fread($read_bio,filesize("$bio_target$aNAME.txt"));
        fclose($read_bio);
        echo '</div>';
        echo '</br><img class="promo_cover" src="' . $row["album_art"] . '"alt="' . $row["song_title"] . ' by ' . $row["artiste_name"] . '" /></img>';
        echo '</br><audio controls="controls" autoplay="autoplay">
                    <source src="' . $row["song_link"] . '" type="audio/mp3"/>
                    Your browser does not support the audio element.
                </audio></br>';
        echo '<h3>Lyrics</h3></br>';
        echo '<div id="lyric_cont">';
        $read_lyrics = fopen("$lyric_target$sNAME by $aNAME.txt", "r");
        echo fread($read_lyrics,filesize("$lyric_target$sNAME by $aNAME.txt"));
        fclose($read_lyrics);
        echo '</div>';
    }
    ?>
</section>
<?php require ('bottom.php') ?>
