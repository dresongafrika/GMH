<?php
if (isset($_GET['adpay']) && isset($_GET['adname'])&& !empty($_GET['adpay']) && isset($_POST['transaction_id'])) {
    $query = 'SELECT * FROM tmp_ad WHERE program-name="'.$_GET['adname'].'"';
    $stmt = mysqli_query($dbc, $query);
    $row=mysqli_fetch_array($stmt);
    $prog_name=$row['program_name'];
    $banner_link=$row['banner_link'];
    $phone_number=$row['phone_number'];
    $email=$row['email'];
    $prog_url=$row['prog_url'];

    $dir = 'arowoyin/';
    $base = $row['file_base'];
    $banner_link_new = $dir . $base;
    rename($banner_link, $banner_link_new);


    $query1 = "INSERT INTO advertisements (ad_id,program_name,banner_link, phone_number,email, prog_url,upload_date) VALUES (NULL,?,?,?,?,?,NOW())";
    $stmt1 = mysqli_prepare($dbc, $query1);
    mysqli_stmt_bind_param($stmt1, "sssss", $prog_name, $banner_link_new, $phone_number, $email, $prog_url);
    mysqli_stmt_execute($stmt1);
    mysqli_stmt_close($stmt1);

    echo 'your advert has been uploaded. you can see it on the home page. May the blessing of the Almighty be upon the programme';

}else{
    echo 'Please pay to proceed';
}
?>