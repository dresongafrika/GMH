<?php
if (isset ($_POST['file_name'])) {
    $file = $_POST['file_name'];
    header('content-type:audio/mpeg3');
    header('content-disposition:attachment; filename="' . $file . '"');
    readfile('promotions/promo_uploads/'.$file);
    exit();
}
