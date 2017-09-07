<section id="side">
    <section id="ipolowo">
        <?php
        $query = "SELECT * FROM advertisement";
        $stmt = mysqli_query ($dbc,$query);
        while ($row=mysqli_fetch_array($stmt)){
            echo  '<a href="'.$row["prog_url"].'" target="_blank"><img class="arowoyin" src="'.$row["banner_link"].'" alt="'.$row["program_name"].'" /></a>';
        }
        ?>
        <a href="adverts.php" target="_blank"><img class="arowoyin" src="arowoyin/advertise with us.png" alt="advertise with us" /></a>
    </section>
    <article>
        <blink><h4>Song of the day!</h4></blink>
        <?php
            $query = "SELECT * FROM members_songs";
            $stmt = mysqli_query ($dbc,$query);
            while ($row=mysqli_fetch_array($stmt)) {
                $lyric_target = "members/".$row["artiste_name"]."/lyrics/";
                $sNAME = $row["song_title"];
                $aNAME = $row["artiste_name"];
                echo '<div class="song_week ">';
                echo '<h3 id="song_title">' . $row["song_title"] . 'by' . $row["artiste_name"] . '</h3>';
                    $read_lyrics = fopen("$lyric_target$sNAME by $aNAME.txt", "r");
                    echo fread($read_lyrics, filesize("$lyric_target$sNAME by $aNAME.txt"));
                    echo '<a href="member_songs.php?mem_red_name=' . $row["artiste_name"] .'&&mem_red_song='.$row["song_title"].'" target="_blank" id="download_link">Download/Play online</a>
                      </div>';
                fclose($read_lyrics);
            }
        ?>
    </article>
    <img class="arowo_google" src="" alt="owo tech"/>
</section>
<footer id="footer">
    <ul id="social_icons">
        <li class="social"> <a href=""><i class="fa fa-facebook"></i></a> </li>
        <li class="social"> <a href=""><i class="fa fa-twitter"></i> </a></li>
        <li class="social"> <a href=""><i class="fa fa-instagram"></i> </a></li>
        <li class="social"> <a href=""><i class="fa fa-google-plus-square"></i> </a></li>
        <li class="social"> <a href=""><i class="fa fa-whatsapp"></i> </a></li>
    </ul>
    <p id="copyright">&copy 2017 Website designed @ The Cocoon Network (+2348182818327,+2348136776626)</p>
</footer>
<script type="text/javascript" src="js/gmh.js"></script>
<?php ob_end_flush();
        mysqli_close($dbc);
?>
<a href="admin_login.php">ADMIN</a>
</body>
</html>