<?php require ('top.php') ?>
    <section id="main">
<?php
if (isset($_GET['adpay']) && isset($_GET['adname'])&& !empty($_GET['adpay']) && isset($_POST['transaction_id'])) {
    $query = 'SELECT * FROM tmp_ad WHERE program_name="'.$_GET['adname'].'"';
    $stmt = mysqli_query($dbc, $query);
    $row=mysqli_fetch_array($stmt);
    $prog_name=$row['program_name'];
    $banner_link=$row['banner_link'];
    $phone_number=$row['phone_number'];
    $email=$row['email'];
    $prog_url=$row['prog_url'];
    $days=$row['expiry_days'];
    $dir = 'arowoyin/';
    $base = $row['file_base'];
    $banner_link_new = $dir . $base;
    rename($banner_link, $banner_link_new);


    $query1 = 'INSERT INTO `advertisement`(`ad_id`, `banner_link`, `email`, `phone_number`, `program_name`, `prog_url`, `upload_date`, `expiry_days`) VALUES (NULL,?,?,?,?,?,NOW(),?)';
    $stmt1 = mysqli_prepare($dbc, $query1);
    mysqli_stmt_bind_param($stmt1, "ssssss",  $banner_link_new, $email,$phone_number, $prog_name, $prog_url, $days);
    mysqli_stmt_execute($stmt1);
    mysqli_stmt_close($stmt1);

    $query4='DELETE FROM tmp_ad WHERE program_name="'.$_GET['adname'].'"';
    $stmt4=mysqli_query($dbc,$query4);


    echo 'your advert has been uploaded. you can see it on the home page. May the blessing of the Almighty be upon the programme';

}else{
    echo 'Please pay to proceed';
}
?>
</section>
<?php require ('bottom.php') ?>
