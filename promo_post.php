<?php require ('top.php'); ?>
<section id="main">
<?php
    if (isset($_POST["submit"])){

    $aNAME=$_POST["name"];
    $sNAME=$_POST["title"];
    $phone=$_POST["phone"];
    $email=$_POST["email"];
    $price=$_POST["price"];
    $lyrics=$_POST["lyrics"];
    $bio=$_POST["bio"];
    $albumART = basename($_FILES ["cover"]["name"]);
    $songNAME = basename($_FILES["mp3"]["name"]);
    $target_dir = "promotions/promo_dump/";
    $target_file = $target_dir .$songNAME;
    $uploadOk = 1;
    $songFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $img_dir = "promotions/album art dump/".$albumART;
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
        echo $sNAME.' has been successfully saved. Please proceed to pay!</br>';


            /** save lyrics and bio  **/

            $bio_target="promotions/biographies_dump/";
            $lyric_target="promotions/lyrics_dump/";
            $bioCONTENT = fopen("$aNAME.txt", "w");
            $lyricCONTENT = fopen("$sNAME by $aNAME.txt", "w");
            $tmp_bio=$bio_target.$aNAME.".txt";
            $tmp_lyric=$lyric_target.$sNAME. "by". $aNAME.".txt";
            fwrite($bioCONTENT, $bio);
            fwrite($lyricCONTENT, $lyrics);
            fclose($bioCONTENT);
            fclose($lyricCONTENT);
            rename("$aNAME.txt",$tmp_bio);
            rename("$sNAME by $aNAME.txt",$tmp_lyric);

            /** send data to database  **/

            $query = "INSERT INTO `tmp_promo`(`artiste_id`, `album_art`, `artiste_name`, `email`, `mp3_name`, `phone`, `song_link`, `song_title`,`tmp_bio`,`tmp_lyric`,`img_base`) VALUES (NULL,?,?,?,?,?,?,?,?,?,?)";
            $stmt = mysqli_prepare ($dbc,$query);
            mysqli_stmt_bind_param($stmt, "ssssssssss",$img_dir,$aNAME,$email,$songNAME,$phone,$target_file,$sNAME,$tmp_bio,$tmp_lyric,$albumART);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

                    echo      '        <form method="POST" action="https://voguepay.com/pay/">
                <input type="hidden" name="v_merchant_id" value="demo" />
                <input type="hidden" name="memo" value="payment for promotional song upload" />
                <input type="hidden" name="success_url" value="http://www.gospelmusichotspot.com/promo_pay.php?pay=yes&name='.$aNAME.'" />
                <input type="hidden" name="fail_url" value="http://www.gospelmusichotspot.com/promo_pay.php?pay=no" />
                <input type="hidden" name="notify_url" value="http://www.gospelmusichotspot.com/promo_pay.php?pay=yes&name='.$aNAME.'"/>
                <input type="hidden" name="cur" value="NGN" />
                <input type="hidden" name="item_1" value="upload" />
                <input type="hidden" name="developer_code" value="599a05bc1e8d3" />
                <input type="hidden" name="total" value="'.$price.'" />
                <input type="hidden" name="description_1" value="" /><br />
                <input type="image" src="https://voguepay.com/images/buttons/make_payment_blue.png" alt="PAY WITH YOUR CREDIT/DEBIT CARD" />
            </form>
            <i class="fa fa-cc-discover" ></i><i class="fa fa-cc-visa"></i><i class="fa fa-cc-mastercard"></i><i class="fa fa-cc-paypal"></i></br>';
        }
    }
    }
?>
    <a href="https://voguepay.com/register/3828-0054426"><img src="https://voguepay.com/images/banners/f.png" width="600" height="60" /></a>
</section>
<?php require ('bottom.php'); ?>

