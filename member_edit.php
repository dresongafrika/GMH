<?php require ('top.php'); ?>
<section id="main">
<?php
if (isset($_GET['name'])){
$query = 'SELECT artiste_name FROM members WHERE artiste_name="'.$_GET['name'].'"';
$stmt = mysqli_query ($dbc,$query);
$row=mysqli_fetch_array($stmt);
$pWord=$born_again=$country=$sex=$dob=$phone=$email=$add=$bio= $fName=$lName= "";
$password_err=$born_again_err=$country_err=$sex_err=$dob_err=$bio_err = $fname_err=$lname_err=$phone_err=$email_err=$address_err=$fb_err=$twitter_err="";
$fNAME=$_POST["first_name"]="";
$lNAME=$_POST["last_name"]="";
$dob=$_POST["dob"]="";
$born_again=$_POST["born_again"]="";
$sex=$_POST["sex"]="";
$country=$_POST["country"]="";
$phone=$_POST["phone"]="";
$email=$_POST["email"]="";
$add=$_POST["address"]="";
$fb=$_POST["facebook"]="";
$twitter=$_POST["twitter"]="";

echo'

    <div class="wrapper">
        <h2>Artiste profile</h2>
        <form enctype="multipart/form-data" action="profile_update.php" method="post">
        <div class="form-group">
            <input type="hidden" name="uname" class="form-control" value="'.$_GET['name'].'">
        </div>
        <div class="form-group">
            <label>First name:<sup>*</sup></label>
            <input type="text" name="first_name" class="form-control" value="'. $fName.'">
            <span class="help-block"> '. $fname_err.'</span>
        </div>
        <div class="form-group">
            <label>Last Name:<sup>*</sup></label>
            <input type="text" name="last_name" class="form-control" value="'. $lName.'">
            <span class="help-block"> '. $lname_err.'</span>
        </div>
        <div class="form-group">
            <label>Date of Birth:<sup>*</sup></label>
            <input type="date" name="dob" class="form-control" value="'. $dob.'">
            <span class="help-block"> '. $dob_err.'</span>
        </div>
        <div class="form-group">
            <label>Date of conversion:<sup>*</sup></label>
            <input type="date" name="born_again" class="form-control" value="'. $born_again.'">
            <span class="help-block"> '. $born_again_err.'</span>
        </div>
        <div class="form-group">
            <label>Sex:<sup>*</sup></label>
            <select name="sex" class="form-control">
                <option name="male" class="form-control">MALE</option>
                <option name="female" class="form-control">FEMALE</option>
            </select>
            <span class="help-block"> '. $sex_err.'</span>
        </div>
        <div class="form-group">
            <label>Country of Origin:<sup>*</sup></label>
            <input type="text" name="country" class="form-control" value="'. $country.'">
            <span class="help-block"> '. $country_err.'</span>
        </div>
        <div class="form-group">
            <label>Tell us about yourself:<sup>*</sup></label>
            <textarea class="form-control" name="bio" rows="4" cols="50" placeholder="Type it this way starting with your name.
                Damilare Ademeso is minister of the gospel devoted to seeing the flames of worship across the nations e.t.c "></textarea></br>
            <span class="help-block"> '. $bio_err.'</span>
        </div>
        <div class="form-group">
            <label>Phone number:<sup>*</sup></label>
            <input type="tel" name="phone" class="form-control" value="'. $phone.'">
            <span class="help-block"> '. $phone_err.'</span>
        </div>
        <div class="form-group">
            <label>Email:<sup>*</sup></label>
            <input type="email" name="email" class="form-control" value="'. $email.'">
            <span class="help-block"> '. $email_err.'</span>
        </div>
        <div class="form-group">
            <label>Physical Address:<sup>*</sup></label>
            <input type="text" name="address" class="form-control" value="'. $add.'">
            <span class="help-block"> '. $address_err.'</span>
        </div>
        <div class="form-group">
            <label>Facebook Url:<sup>*</sup></label>
            <input type="url" name="facebook" class="form-control" value="'. $fb.'">
            <span class="help-block"> '. $fb_err.'</span>
        </div>
        <div class="form-group">
            <label>Twitter url:<sup>*</sup></label>
            <input type="url" name="twitter" class="form-control" value="'. $twitter.'">
            <span class="help-block"> '. $twitter_err.'</span>
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
