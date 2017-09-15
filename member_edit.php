<?php require ('top.php'); ?>
<section id="main">
<?php
if (isset($_GET['name'])){
$query = 'SELECT * FROM members WHERE artiste_name="'.$_GET['name'].'"';
$stmt = mysqli_query ($dbc,$query);
$row=mysqli_fetch_array($stmt);
echo'

    <div class="wrapper">
        <h2>Artiste profile</h2>
        <form enctype="multipart/form-data" action="member_edit_pass.php" method="POST">
        <div class="form-group">
            <input type="hidden" name="uname" class="form-control" value="'.$_GET['name'].'">
        </div>
        <div class="form-group">
            <label>Type in your registered password:<sup>*</sup></label>
            <input type="password" name="password" class="form-control" >
        </div>
        <div class="form-group"> 
            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
            <input type="reset" name="reset" class="btn btn-default" value="Reset">
        </div>
    </form>
</div>';
}
?>
</section>
<?php require ('bottom.php') ?>
