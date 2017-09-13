<?php require ('top.php'); ?>
<?php
$query='SELECT * FROM members';
$stmt=mysqli_query($dbc,$query);
$row=mysqli_fetch_array($stmt);
if(isset($_GET['username']) && $_GET['username']==$row['artiste_name']){
    if (isset($_POST['submit'])){
        $param_username=$_POST['art_name'];
        $aNAME=$_POST["name"];
        $sNAME=$_POST["title"];
        $album=$_POST["album"];
        $lyrics=$_POST["lyrics"];
        $albumART = basename($_FILES ["cover"]["name"]);
        $songNAME = basename($_FILES["mp3"]["name"]);
        $target_dir = "members/".$param_username."/uploads/";
        $target_file = $target_dir .$songNAME."by".isset($_POST["name"]);
        $uploadOk = 1;
        $songFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        $img_dir = "members/".$param_username."/album art/".$albumART."by".isset($_POST["name"]);
        $img_dirType = pathinfo($img_dir,PATHINFO_EXTENSION);

        // Check file size
        if ($_FILES["mp3"]["size"] > 10000000) {
            $uploadOk = 0;
            echo '</br>*<span style="color:red;">Please ensure that your song is less than 10MB </span></br>';
        }
        // Allow certain file formats
        if($songFileType != "mp3" && $songFileType != "MP3") {
            $uploadOk = 0;
            echo '*<span style="color:red;">Only mp3 files are allowed</span></br>';
        }
        if($img_dirType != "jpg" && $img_dirType != "png" && $img_dirType != "JPG" && $img_dirType != "PNG") {
            $uploadOk = 0;
            echo '*<span style="color:red;">Upload an album art with a jpg or png extension</span></br>';
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo  '*<span style="color:red;">Sorry, your file was not uploaded</span></br>';
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES ["mp3"]["tmp_name"],$target_file) && move_uploaded_file($_FILES ["cover"]["tmp_name"],$img_dir)) {
                echo $sNAME." has been successfully uploaded.</br>";

                /** save lyrics **/

                $message_target='members/'.$_POST['art_name'].'/lyrics/';
                $lyricCONTENT = fopen("$sNAME by $aNAME.txt", "w");
                fwrite($lyricCONTENT, $lyrics);
                fclose($lyricCONTENT);
                rename("$sNAME by $aNAME.txt","$message_target$sNAME by $aNAME.txt");
                /** send data to database  **/

                $query = "SELECT artiste_id FROM members WHERE artiste_name='".$_POST['art_name'];
                $stmt = mysqli_query ($dbc,$query);
                $row=mysqli_fetch_array($stmt);
                $id=$row["artiste_id"];


                $query = "INSERT INTO members_songs VALUES (?,?,?,?,?,?)";
                $link='member_songs.php?mem_red_name='.$_POST['art_name'].'&mem_red_song='.$sNAME;
                $stmt = mysqli_prepare ($dbc,$query);
                mysqli_stmt_bind_param($stmt, "isssss",$id,$_POST['art_name'],$sNAME,$album,$img_dir,$link);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                $query = "SELECT * FROM members_songs WHERE artiste_name='".$_POST['art_name'];
                $stmt = mysqli_query ($dbc,$query);
                $row=mysqli_fetch_array($stmt);
                echo 'Here is the link to your song: <a href="member_songs.php?mem_red_name='.$row["artiste_name"].'&mem_red_song='.$sNAME.'">member_songs.php?mem_red_name='.$row["artiste_name"].'&mem_red_song='.$sNAME.'</a> ';

            } else {
                echo '<span style="color:red;">*Sorry, there was an error uploading your file.</span>';
            }
        }
    }
       echo' <form method="post" enctype="multipart/form-data" action="';echo htmlspecialchars($_SERVER['PHP_SELF']); echo '">
            <input type="hidden" name="art_name" value="'; echo $_GET["artiste_name"];echo '"/>
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
    }
?>


<?php require ('bottom.php'); ?>