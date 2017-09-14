<?php require ('top.php'); ?>
<section id="main">
<?php
$param_username=$_GET['username'];
echo '  <form method="post" enctype="multipart/form-data" action="member_upload_done.php">
        <input type="hidden" name="art_name" value="'.$param_username.'"/>
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
    </form>';

?>
</section>

<?php require ('bottom.php'); ?>