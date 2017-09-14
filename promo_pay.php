<?php require ('top.php'); ?>

<section id="main">
<?php
if (isset($_GET['pay']) && isset($_GET['name']) && isset($_POST['transaction_id'])) {
    $query = 'SELECT * FROM tmp_promo WHERE artiste_name="'.$_GET['name'].'"';
    $stmt = mysqli_query($dbc, $query);
    $row=mysqli_fetch_array($stmt);
    $aNAME=$_GET['name'];
    $sNAME=$row["song_title"];
    $phone=$row["phone"];
    $email=$row["email"];
    $albumART=$row['img_base'];
    $new_bio="promotions/biographies/".$aNAME.".txt";
    $new_lyric="promotions/lyrics/".$sNAME."by" .$aNAME.".txt";
    $target_dir = "promotions/promo_uploads/";
    $target_file_new = $target_dir.$aNAME .$row['mp3_name'];
    $img_dir_new = "promotions/album art/".$aNAME.$albumART;
    rename($row['song_link'], $target_file_new);
    rename($row['album_art'], $img_dir_new);
    rename($row['tmp_bio'],$new_bio);
    rename($row['tmp_lyric'],$new_lyric);

    $query2 = "INSERT INTO `music_promotion`(`img_base`,`album_art`, `artiste_id`, `artiste_name`, `email`, `mp3_name`, `phone`, `song_link`, `song_title`, `transaction_id`, `upload_date`) VALUES (?,?,NULL,?,?,?,?,?,?,?,NOW())";
    $stmt2 = mysqli_prepare ($dbc,$query2);
    mysqli_stmt_bind_param($stmt2, "sssssssss",$albumART,$img_dir_new,$aNAME,$email,$row['mp3_name'],$phone,$target_file_new,$sNAME,$_POST['transaction_id']);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_close($stmt2);


    $query3 = 'SELECT * FROM music_promotion WHERE artiste_name="'.$aNAME.'"';
    $stmt3 = mysqli_query ($dbc,$query3);
    $row3=mysqli_fetch_array($stmt3);
    echo 'Here is the link to your song: <a href="promo_uploads.php?redirect='.$row3["artiste_name"].'">promo_uploads.php?redirect='.$row3["artiste_name"].'</a> ';


}else{
    echo 'Please pay to proceed';
}
?>
</section>
<?php require ('bottom.php');
