<?php require ('top.php'); ?>

<section id="main">
    <?php
if (isset($_POST['submit'])) {
    $dir = 'arowoyin/banner_dump/';
    $base = basename($_FILES ["banner"]["name"]);
    $banner_link = $dir . $base;
    $file_type = pathinfo($banner_link, PATHINFO_EXTENSION);
    $prog_name = $_POST['title'];
    $phone_number = $_POST['phone'];
    $email = $_POST["email"];
    $prog_url = $_POST['url'];
    $days=ceil($_POST['days']);
    $amount=$_POST['amount'];
    $total=$amount*$days;
    if ($file_type != "jpg" && $file_type != "png" && $file_type != "JPG" && $file_type != "PNG") {
        $uploadOk = 0;
        echo '*<span style="color:red;">Upload an album art with a jpg or png extension</span></br>';
    } else {
        move_uploaded_file($_FILES["banner"]["tmp_name"], $banner_link);
        echo 'your advert has been uploaded. Please proceed to pay';
    $query = 'INSERT INTO `tmp_ad`(`ad_id`, `banner_link`, `email`, `phone_number`, `program_name`, `prog_url`, `file_base`, `expiry_days`) VALUES (NULL,?,?,?,?,?,?,?)';
    $stmt = mysqli_prepare($dbc, $query);
    mysqli_stmt_bind_param($stmt, "sssssss",  $banner_link,$email,$phone_number,$prog_name,   $prog_url,$base,$days);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    echo '<div id="pay">
                                            <form method="POST" action="https://voguepay.com/pay/">
                                            Please proceed to pay.
                                                <input type="hidden" name="v_merchant_id" value="demo" />
                                                <input type="hidden" name="memo" value="payment for promotional song upload" />
                                                <input type="hidden" name="success_url" value="http://www.gospelmusichotspot.com/ad_pay.php?adpay=yes&adname='.$prog_name.'" />
                                                <input type="hidden" name="fail_url" value="http://www.gospelmusichotspot.com/ad_pay.php?adpay=no" />
                                                <input type="hidden" name="notify_url" value="http://www.gospelmusichotspot.com/ad_pay.php?adpay=yes&adname='.$prog_name.'" />
                                                <input type="hidden" name="cur" value="NGN" />
                                                <input type="hidden" name="item_1" value="upload" />
                                                <input type="hidden" name="developer_code" value="599a05bc1e8d3" />
                                                <input type="hidden" name="total" value="'.$total.'" />
                                                <input type="hidden" name="description_1" value="" /><br />
                                                <input type="image" src="https://voguepay.com/images/buttons/make_payment_blue.png" alt="PAY WITH YOUR CREDIT/DEBIT CARD" />
                                            </form>
                                            <i class="fa fa-cc-discover" ></i><i class="fa fa-cc-visa"></i><i class="fa fa-cc-mastercard"></i><i class="fa fa-cc-paypal"></i></br>
                                        </div>';
    }

}
?>
</section>
<?php require ('bottom.php'); ?>
