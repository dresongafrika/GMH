<?php require ('top.php') ?>
<section id="main">
    <?php
        if (isset ($_GET['mem_red_name']) && isset($_GET['mem_red_song'])){
            $artiste_name = $_GET['mem_red_name'];
            $song_title = $_GET['mem_red_song'];
            $query = 'SELECT * FROM members_songs WHERE artiste_name="'.$artiste_name.'"AND song_title="'.$song_title.'"';
            $stmt = mysqli_query ($dbc,$query);
            $row=mysqli_fetch_array($stmt);
            $bio_target='members/'.$artiste_name.'/biographies/';
            $lyric_target='members/'.$artiste_name.'/lyrics/';
            $sNAME=$row["song_title"];
            $aNAME=$row["artiste_name"];
            if(!empty($row["album_name"])){
                echo '<h2>'.$row["song_title"]. ' by ' .$row["artiste_name"].'</h2> from the album '.$row["album_name"];
                echo '<h3>BIO</h3>';
                $cwd=getcwd();
                $param_username = $row["artiste_name"];
                $structure1=$cwd."/members/".$param_username;
                $bio_title=$structure1."/".$param_username;
                $read_bio = fopen($bio_title.".txt", "r");
                echo fread($read_bio,filesize($bio_title.".txt"));
                fclose($read_bio);
                echo '<img class="promo_cover" src="' . $row["album_art"] . '" alt="' . $row["song_title"] . '" by "' . $row["artiste_name"] . '" /></img>';
                echo '<audio controls="controls" autoplay="autoplay">
                            <source src="' . $row["song_link"] . '" type="audio/mp3"/>
                            Your browser does not support the audio element.
                        </audio></br>';
                echo '<h3>Lyrics</h3></br>';
                $read_lyrics = fopen($lyric_target.$sNAME. " by " .$aNAME.".txt", "r");
                echo fread($read_lyrics,filesize($lyric_target.$sNAME. " by " .$aNAME.".txt"));
                fclose($read_lyrics);
                echo '<form action="force_download.php" method="post">
                <input type="hidden" name="file_name" value="'.$row["song_link"].'"/>
                <input type="submit" value="DOWNLOAD NOW"/>
              </form>';

            }else{
                echo '<h2>'.$row["song_title"]. ' by ' .$row["artiste_name"].'</h2>';
                echo '<h3>BIO</h3>';
                $cwd=getcwd();
                $param_username = $row["artiste_name"];
                $structure1=$cwd."/members/".$param_username;
                $bio_title=$structure1."/".$param_username;
                $read_bio = fopen("$bio_title.txt", "r");
                echo fread($read_bio,filesize("$bio_title.txt"));
                fclose($read_bio);
                echo '<img class="promo_cover" src="' . $row["album_art"] . '" alt="' . $row["song_title"] . '" by "' . $row["artiste_name"] . '" /></img>';
                echo '<audio controls="controls" autoplay="autoplay">
                        <source src="' . $row["song_link"] . '" type="audio/mp3"/>
                        Your browser does not support the audio element.
                        </audio></br>';
                echo '<h3>Lyrics</h3></br>';
                $read_lyrics = fopen("$lyric_target$sNAME by $aNAME.txt", "r");
                echo fread($read_lyrics,filesize("$lyric_target$sNAME by $aNAME.txt"));
                fclose($read_lyrics);
                echo '<form action="force_download.php" method="post">
                <input type="hidden" name="file_name" value="'.$row["song_link"].'"/>
                <input type="submit" value="DOWNLOAD NOW"/>
              </form>';
            }
            echo'       <div class="fb-share-button" data-href="http://www.gospelmusichotspot.com/member_songs.php?redirect='.$artiste_name.'" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.gospelmusichotspot.com%2Fmember.php%3Fredirect%3Djaphet&amp;src=sdkpreparse">Share</a></div>';
        }

    ?>

</section>
<?php require ('bottom.php') ?>
