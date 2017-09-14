<?php require ('top.php') ?>
<section id="main">
    <?php
    if (isset ($_GET["member_promo"]) && isset($_GET["song_title"])){


        $aNAME=$_GET["member_promo"];
        $query = "SELECT * FROM members";
        $query1 = "SELECT song_title FROM members_songs";
        $stmt = mysqli_query ($dbc,$query);
        $stmt1 = mysqli_query ($dbc,$query1);
        while ($row=mysqli_fetch_array($stmt) && $result=mysqli_fetch_array($stmt1)){
            if($aNAME==$row["artiste_name"] && $_GET["song_title"]==$result["song_title"]){
                echo'    
                            <form method="post" enctype="multipart/form-data" action="promo_post.php">
                            <input type="hidden" name="name" value="'.$aNAME.'" >
                            Type in the song title:
                            <input type="text" name="title" required="required" >
                            <input type="hidden" name="phone" value="'.$row["phone"].'" >
                            <input type="hidden" name="email" value="'.$row["email"].'" >
                            <input type="hidden" name="bio" value="';
                $cwd=getcwd();
                $bio_dir=$cwd."/members/".$aNAME."/".$aNAME.".txt";
                $bio_open=fopen($bio_dir,'r');
                echo fread($bio_open,filesize($bio_dir));
                fclose($bio_open);
                echo'        "/></br>
                            <input type="hidden" name="mp3" value="'.$result["song_link"].'" >
                            <input type="hidden" name="price" value="8000" >
                            <input type="file" name="cover" value="'.$result["song_link"].'" >
                            <input type="hidden" name="lyrics" value="';
                            $lyric_open=fopen($result["lyric"],'r');
                            echo fread($lyric_open,filesize($result["lyric"]));
                            fclose($lyric_open);
                echo'            " >
                            <input type="submit" value="Upload" name="submit">
                            </form></br>';

            }
        }
    }
 ?>
    <a href="https://voguepay.com/register/3828-0054426"><img src="https://voguepay.com/images/banners/f.png" width="600" height="60" /></a>
</section>
<?php require ('bottom.php') ?>
