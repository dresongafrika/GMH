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
        $mp3=$_POST["mp3"];
        $cover=$_POST["cover"];
        $mp3_name=$_POST["mp3_name"];
        $img_base=$_POST["img_base"];
    $target_dir = "promotions/promo_dump/";
    $target_file = $target_dir .$aNAME.$mp3;
    $img_dir = "promotions/album art dump/".$aNAME.$img_base;
        copy($mp3_name,$target_file);
        copy($cover,$img_dir);




            /** save lyrics and bio  **/
            $bio_target="promotions/biographies_dump/";
            $lyric_target="promotions/lyrics_dump/";
            $bioCONTENT = fopen($aNAME.".txt", "w");
            $lyricCONTENT = fopen($sNAME. " by " .$aNAME.".txt", "w");
            $tmp_bio=$bio_target.$aNAME.".txt";
            $tmp_lyric=$lyric_target.$sNAME. " by ". $aNAME.".txt";
            fwrite($bioCONTENT, $bio);
            fwrite($lyricCONTENT, $lyrics);
            fclose($bioCONTENT);
            fclose($lyricCONTENT);
            rename($aNAME.".txt",$tmp_bio);
            rename($sNAME. " by " .$aNAME.".txt",$tmp_lyric);

            /** send data to database  **/

            $query = "INSERT INTO `tmp_promo`(`artiste_id`, `album_art`, `artiste_name`, `email`, `mp3_name`, `phone`, `song_link`, `song_title`,`tmp_bio`,`tmp_lyric`,`img_base`) VALUES (NULL,?,?,?,?,?,?,?,?,?,?)";
            $stmt = mysqli_prepare ($dbc,$query);
            mysqli_stmt_bind_param($stmt, "ssssssssss",$img_dir,$aNAME,$email,$mp3,$phone,$target_file,$sNAME,$tmp_bio,$tmp_lyric,$img_base);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

             echo $sNAME.' has been successfully saved. Please proceed to pay!</br>';
                    echo      '        <form method="POST" action="https://voguepay.com/pay/">
                <input type="hidden" name="v_merchant_id" value="demo" />
                <input type="hidden" name="memo" value="payment for promotional song upload" />
                <input type="hidden" name="success_url" value="http://www.gospelmusichotspot.com/promo_pay.php?pay=yes&name='.$aNAME.'&title='.$sNAME.'" />
                <input type="hidden" name="fail_url" value="http://www.gospelmusichotspot.com/promo_pay.php?pay=no" />
                <input type="hidden" name="notify_url" value="http://www.gospelmusichotspot.com/promo_pay.php?pay=yes&name='.$aNAME.'&title='.$sNAME.'"/>
                <input type="hidden" name="cur" value="NGN" />
                <input type="hidden" name="item_1" value="upload" />
                <input type="hidden" name="developer_code" value="599a05bc1e8d3" />
                <input type="hidden" name="total" value="'.$price.'" />
                <input type="hidden" name="description_1" value="" /><br />
                <input type="image" src="https://voguepay.com/images/buttons/make_payment_blue.png" alt="PAY WITH YOUR CREDIT/DEBIT CARD" />
            </form>
            <i class="fa fa-cc-discover" ></i><i class="fa fa-cc-visa"></i><i class="fa fa-cc-mastercard"></i><i class="fa fa-cc-paypal"></i></br>';
    }
?>
    <a href="https://voguepay.com/register/3828-0054426"><img src="https://voguepay.com/images/banners/f.png" width="600" height="60" /></a>
</section>
<?php require ('bottom.php'); ?>

