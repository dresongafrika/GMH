<?php require ('top.php') ?>
<section id="main">
    <?php
    if (isset ($_GET["member_promo"]) && isset($_GET["song_title"])){
        $aNAME=$_GET["member_promo"];
        $query = 'SELECT * FROM members WHERE artiste_name="'.$_GET["member_promo"].'"';
        $query1 = 'SELECT * FROM members_songs WHERE artiste_name="'.$_GET["member_promo"].'" AND song_title="'.$_GET["song_title"].'"';
        $stmt = mysqli_query ($dbc,$query);
        $stmt1 = mysqli_query ($dbc,$query1);
        $row=mysqli_fetch_array($stmt);
        $result=mysqli_fetch_array($stmt1);
                echo'    
                            <form method="post" enctype="multipart/form-data" action="promo_post.php">
                            <input type="hidden" name="name" value="'.$aNAME.'" >
                            <input type="hidden" name="title" value="'.$result["song_title"].'" >
                            <input type="hidden" name="phone" value="'.$row["phone"].'" >
                            <input type="hidden" name="email" value="'.$row["email"].'" >
                            <input type="hidden" name="mp3_name" value="'.$result["mp3_name"].'" >
                            <input type="hidden" name="img_base" value="'.$result["img_base"].'" >
                            <input type="hidden" name="bio" value="';
                $cwd=getcwd();
                $bio_dir=$cwd."/members/".$aNAME."/".$aNAME.".txt";
                $bio_open=fopen($bio_dir,'r');
                echo fread($bio_open,filesize($bio_dir));
                fclose($bio_open);
                echo' "/> </br>
                            <input type="hidden" name="mp3" value="'.$result["mp3_base"].'" >
                            <input type="hidden" name="price" value="8000" >
                            <input type="hidden" name="cover" value="'.$result["album_art"].'" >
                            <input type="hidden" name="lyrics" value="';

                            $lyric_open=fopen($result["lyric"],'r');

                            echo fread($lyric_open,filesize($result["lyric"]));
                            fclose($lyric_open);
                echo'" >
                            <input type="submit" value="PROMOTE '.$result["song_title"].' NOW" name="submit">
                            </form></br>';

    }

    ?>
    <a href="https://voguepay.com/register/3828-0054426"><img src="https://voguepay.com/images/banners/f.png" width="600" height="60" /></a>
</section>
<?php require ('bottom.php') ?>
