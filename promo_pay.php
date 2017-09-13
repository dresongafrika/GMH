<?php
if (isset($_GET['pay']) && isset($_GET['name']) && isset($_POST['transaction_id'])) {
    $query = 'SELECT * FROM tmp_promo WHERE program-name="'.$_GET['name'].'"';
    $stmt = mysqli_query($dbc, $query);
    $row=mysqli_fetch_array($stmt);
    $aNAME=$_GET['name'];
    $sNAME=$_POST["song_title"];
    $phone=$row["phone"];
    $email=$row["email"];
    $albumART=$row['album_art'];
    $lyrics=$_POST["lyrics"];
    $new_bio="promotions/biographies/".$aNAME;
    $new_lyric="promotions/lyrics/".$aNAME;
    $target_dir = "promotions/promo_uploads/";
    $target_file_new = $target_dir .$sNAME;
    $img_dir_new = "promotions/album art/".$albumART;
    rename($row['song_link'], $target_file_new);
    rename($row['img_dir'], $img_dir_new);
    rename($row['tmp_bio'],$new_bio);
    rename($row['tmp_lyric'],$new_lyric);

    $query = "INSERT INTO music_promotions (artiste_id,artiste_name,phone, email, song_title, album_art, mp3_name, song_link,upload_date) VALUES (NULL,?,?,?,?,?,?,?,NOW())";
    $stmt = mysqli_prepare ($dbc,$query);
    mysqli_stmt_bind_param($stmt, "sssssss",$aNAME,$phone,$email,$sNAME,$img_dir_new,$sNAME,$target_file_new);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);


    $query = 'SELECT * FROM music_promotion WHERE artiste_name="'.$aNAME.'"';
    $stmt = mysqli_query ($dbc,$query);
    $row=mysqli_fetch_array($stmt);
    echo 'Here is the link to your song: <a href=promo_uploads.php?redirect="'.$row["artiste_name"].'">promo_uploads.php?redirect="'.$row["artiste_name"].'"</a> ';


}else{
    echo 'Please pay to proceed';
}
?>