<?php require ('top.php'); ?>
<section id = "main" >

<?php
if (isset($_GET["member_promo"])) {
echo '<p > Please type in your password to continue.</p >
        <form action = "adverts.php" method = "post" >
                <input type = "hidden" name = "artiste_name" class="form-control" value = "'.$_GET["member_promo"].'" >
<div class="form-group" >
    <label > Password:<sup >*</sup ></label >
    <input type = "password" name = "password" class="form-control" >
</div >
<div class="form-group" >
    <input type = "submit" name="submit" class="btn btn-primary" value = "Submit" >
</div >';
}
?>
</section >

