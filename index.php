<?php require ('top.php') ?>
<section id="main">
    <h4>NEW RELEASE!(Scroll down for more downloads)</h4>
    <?php
    $query = "SELECT * FROM music_promotion ORDER BY artiste_id DESC ";
    $stmt = mysqli_query ($dbc,$query);
    while ($row=mysqli_fetch_array($stmt)){
        echo	'<div class="album_art" >
                     <figure class=" album">
                        <img class="pix" src="'.$row["album_art"].'" alt="'.$row["song_title"].' by '.$row["artiste_name"].'" />
                        <figcaption id="caption">'.$row["song_title"].'</br>by</br> '.$row["artiste_name"].'.</figcaption>
                     </figure class=" album">
                     <a href="promo_uploads.php?redirect='.$row["artiste_name"].'&title='.$row["song_title"].'" target="_blank" id="download_link">Download/Play online</a>
                  </div>';
    }
    ?>
</section>

<?php require ('bottom.php') ?>



