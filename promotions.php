<?php require ('top.php') ?>
<section id="main">
    <?php
        if (isset ($_GET["member_promo"])){

            /**  This is for the public    **/

            $member_promo=$_GET["member_promo"];
            $query = "SELECT * FROM members";
            $stmt = mysqli_query ($dbc,$query);
            while ($row=mysqli_fetch_array($stmt)){
                if($member_promo==$row["artiste_name"]){
                    echo'    
                            <form method="post" enctype="multipart/form-data" action="'. htmlspecialchars ($_SERVER["PHP_SELF"]).'">
                            Type in the song title:
                            <input type="text" name="title" required="required" value="">
                            Select mp3 to upload:
                            <input type="file" name="mp3" required="required" >
                            Select album cover to upload:
                            <input type="file" name="cover" required="required" >
                            Type in the lyrics:
                            <textarea name="lyrics" rows="4" cols="50" placeholder="Type it this way. Please ensure it contains the necessary song parts like choruses, verses and bridge" required="required"></textarea></br>';

                            /** if (isset($_GET["pay"])){
                                if ($_GET["pay"]="yes"){    **/
                                    echo '<input type="submit" value="Upload" name="submit">';
                             /**   }else{
                                    echo "please pay to proceed";
                                }
                            }  **/

                             echo'
                            </form></br>
                            <form method="POST" action="https://voguepay.com/pay/">
                                <input type="hidden" name="v_merchant_id" value="3828-0054426" />
                                <input type="hidden" name="memo" value="payment for promotional song upload" />
                                <input type="hidden" name="success_url" value="https://localhost/gospel-music-hotspot/promotions.php?pay=yes" />
                                <input type="hidden" name="fail_url" value="https://localhost/gospel-music-hotspot/promotions.php?pay=no" />
                                <input type="hidden" name="cur" value="NGN" />
                                <input type="hidden" name="item_1" value="upload" />
                                <input type="hidden" name="developer_code" value="599a05bc1e8d3" />
                                <input type="hidden" name="total" value="5000" />
                                <input type="hidden" name="description_1" value="" /><br />
                                <input type="image" src="https://voguepay.com/images/buttons/make_payment_blue.png" alt="PAY WITH YOUR CREDIT/DEBIT CARD" />
                            </form>
                            <i class="fa fa-cc-discover" ></i><i class="fa fa-cc-visa"></i><i class="fa fa-cc-mastercard"></i><i class="fa fa-cc-paypal"></i></br>';

                            if (isset($_POST["submit"])){

                                $aNAME=$row["artiste_name"];
                                $sNAME=$_POST["title"];
                                $phone=$row["phone"];
                                $email=$row["email"];
                                $lyrics=$_POST["lyrics"];
                                $albumART = basename($_FILES ["cover"]["name"]);
                                $songNAME = basename($_FILES["mp3"]["name"]);
                                $target_dir = "promotions/promo_uploads/";
                                $target_file = $target_dir .$songNAME;
                                $uploadOk = 1;
                                $songFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                                $img_dir = "promotions/album art/".$albumART;
                                $img_dirType = pathinfo($img_dir,PATHINFO_EXTENSION);

                                // Check file size
                                if ($_FILES["mp3"]["size"] > 10000000) {
                                    $uploadOk = 0;
                                    echo '</br>*<span style="color:red;>Please ensure that your song is less than 10MB </span></br>';
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
                                        echo $sNAME.' has been successfully uploaded.</br>';

                                        /** save lyrics  **/

                                        $lyric_target="promotions/lyrics/";
                                        $lyricCONTENT = fopen($sNAME ."by". $aNAME.".txt", "w");
                                        fwrite($lyricCONTENT, $lyrics);
                                        fclose($lyricCONTENT);
                                        rename($sNAME." by". $aNAME.".txt","$lyric_target$sNAME by $aNAME.txt");

                                        /** send data to database  **/

                                        $query = "INSERT INTO music_promotion (artiste_id,artiste_name,phone, email, song_title, album_art, mp3_name, song_link,upload_date) VALUES (NULL,?,?,?,?,?,?,?,NOW())";
                                        $stmt = mysqli_prepare ($dbc,$query);
                                        mysqli_stmt_bind_param($stmt, "sssssss",$aNAME,$phone,$email,$sNAME,$img_dir,$songNAME,$target_file);
                                        mysqli_stmt_execute($stmt);
                                        mysqli_stmt_close($stmt);

                                        $query = "SELECT * FROM music_promotion WHERE artiste_name=".$aNAME;
                                        $stmt = mysqli_query ($dbc,$query);
                                        $row=mysqli_fetch_array($stmt);
                                        echo 'Here is the link to your song: <a href=promo_uploads.php?redirect="'.$row["artiste_name"].'">promo_uploads.php?redirect="'.$row["artiste_name"].'"</a> ';

                                    } else {
                                        echo '<span style="color:red;">*Sorry, there was an error uploading your file.</span>';
                                    }
                                }
                            }


                }
            }

            /**  This is for the public    **/

        }else{
            echo' 
                            <h2>Just released a song? This is for you. With just $27.40 you can promote your song on our front page with a download link for your fans</h2>
                            <form method="post" enctype="multipart/form-data" action="'. htmlspecialchars ($_SERVER["PHP_SELF"]).'">
                            Type in your name as written on your song cover:
                            <input type="text" name="name" required="required" >
                            Type in the song title:
                            <input type="text" name="title" required="required" >
                            Type in your phone number (with country dialing code):
                            <input type="number" name="phone" required="required" >
                            Type in a a valid email address:
                            <input type="email" name="email" required="required" >
                            Tell us about yourself:
                            <textarea name="bio" rows="4" cols="50" placeholder="Type it this way starting with your name.
                            Damilare Ademeso is minister of the gospel devoted to seeing the flames of worship across the nations e.t.c " required="required"></textarea></br>
                            Select mp3 to upload:
                            <input type="file" name="mp3" required="required" >
                            Select album cover to upload:
                            <input type="file" name="cover" required="required" >
                            Type in the lyrics:
                            <textarea name="lyrics" rows="4" cols="50" placeholder="Type it this way. Please ensure it contains the necessary song parts like choruses, verses and bridge" required="required"></textarea></br>';

            /** if (isset($_GET["pay"])){
            if ($_GET["pay"]="yes"){    **/
            echo '<input type="submit" value="Upload" name="submit">';
            /**   }else{
            echo "please pay to proceed";
            }
            }  **/

            echo'
                            </form></br>';
                            $cwd= getcwd();
             echo      '        <form method="POST" action="https://voguepay.com/pay/">
                                <input type="hidden" name="v_merchant_id" value="3828-0054426" />
                                <input type="hidden" name="memo" value="payment for promotional song upload" />
                                <input type="hidden" name="success_url" value="'.$cwd.'"/promotions.php?pay=yes" />
                                <input type="hidden" name="fail_url" value="'.$cwd.'"/promotions.php?pay=no" />
                                <input type="hidden" name="cur" value="NGN" />
                                <input type="hidden" name="item_1" value="upload" />
                                <input type="hidden" name="developer_code" value="599a05bc1e8d3" />
                                <input type="hidden" name="total" value="10000" />
                                <input type="hidden" name="description_1" value="" /><br />
                                <input type="image" src="https://voguepay.com/images/buttons/make_payment_blue.png" alt="PAY WITH YOUR CREDIT/DEBIT CARD" />
                            </form>
                            <i class="fa fa-cc-discover" ></i><i class="fa fa-cc-visa"></i><i class="fa fa-cc-mastercard"></i><i class="fa fa-cc-paypal"></i></br>';

            if (isset($_POST["submit"])){

                $aNAME=$_POST["name"];
                $sNAME=$_POST["title"];
                $phone=$_POST["phone"];
                $email=$_POST["email"];
                $lyrics=$_POST["lyrics"];
                $bio=$_POST["bio"];
                $albumART = basename($_FILES ["cover"]["name"]);
                $songNAME = basename($_FILES["mp3"]["name"]);
                $target_dir = "promotions/promo_uploads/";
                $target_file = $target_dir .$songNAME;
                $uploadOk = 1;
                $songFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                $img_dir = "promotions/album art/".$albumART;
                $img_dirType = pathinfo($img_dir,PATHINFO_EXTENSION);

                // Check file size
                if ($_FILES["mp3"]["size"] > 10000000) {
                    $uploadOk = 0;
                    echo '</br>*<span style="color:red;>Please ensure that your song is less than 10MB </span></br>';
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
                        echo $sNAME.' has been successfully uploaded.</br>';
;

                        /** save lyrics and bio  **/

                        $bio_target="promotions/biographies/";
                        $lyric_target="promotions/lyrics/";
                        $bioCONTENT = fopen("$aNAME.txt", "w");
                        $lyricCONTENT = fopen("$sNAME by $aNAME.txt", "w");
                        fwrite($bioCONTENT, $bio);
                        fwrite($lyricCONTENT, $lyrics);
                        fclose($bioCONTENT);
                        fclose($lyricCONTENT);
                        rename("$aNAME.txt","$bio_target$aNAME.txt");
                        rename("$sNAME by $aNAME.txt","$lyric_target$sNAME by $aNAME.txt");

                        /** send data to database  **/

                        $query = "INSERT INTO music_promotion (artiste_id,artiste_name,phone, email, song_title, album_art, mp3_name, song_link,upload_date) VALUES (NULL,?,?,?,?,?,?,?,NOW())";
                        $stmt = mysqli_prepare ($dbc,$query);
                        mysqli_stmt_bind_param($stmt, "sssssss",$aNAME,$phone,$email,$sNAME,$img_dir,$songNAME,$target_file);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);

                                echo 'Here is the link to your song: <a href="promo_uploads.php?redirect=" ' . $aNAME . ' ">promo_uploads.php?redirect="' . $aNAME . '"</a> ';
                    } else {
                        echo '<span style="color:red;">*Sorry, there was an error uploading your file.</span>';
                    }
                }
            }
        }


    ?>
    </br><a href="https://voguepay.com/register/3828-0054426"><img src="https://voguepay.com/images/banners/f.png" width="600" height="60" /></a>
</section>
<?php require ('bottom.php') ?>
