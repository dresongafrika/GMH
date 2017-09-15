<?php require ('top.php'); ?>
<?php
if (isset($_POST['submit'])) {
    $query1 = 'SELECT * FROM `members` WHERE `artiste_name`="' . $_POST['uname'] . '"';
    $stmt1 = mysqli_query($dbc, $query1);
    $row = mysqli_fetch_array($stmt1);
    if (password_verify($_POST['password'], $row['password'])) {
        echo '

    <div class="wrapper">
        <h2>Artiste profile</h2>
        <form enctype="multipart/form-data" action="profile_update.php" method="POST">
        <div class="form-group">
            <input type="hidden" name="uname" class="form-control" value="' . $_POST['uname'] . '">
        </div>
        <div class="form-group">
            <label>First name:<sup>*</sup></label>
            <input type="text" name="first_name" class="form-control" value="' . $row['first_name'] . '">
        </div>
        <div class="form-group">
            <label>Last Name:<sup>*</sup></label>
            <input type="text" name="last_name" class="form-control" value="' . $row['last_name'] . '">
        </div>
        <div class="form-group">
            <label>Date of Birth:<sup>*</sup></label>
            <input type="date" name="dob" class="form-control" value="' . $row['dob'] . '">
        </div>
        <div class="form-group">
            <label>Upload a profile pix:<sup>*</sup></label>
            <input type="file" name="pix" class="form-control" value="' . $row['profile_pix'] . '">
        </div>
        <div class="form-group">
            <label>Date of conversion:<sup>*</sup></label>
            <input type="date" name="born_again" class="form-control" value="' . $row['born_again'] . '">
        </div>
        <div class="form-group">
            <label>Sex:<sup>*</sup></label>
            <select name="sex" class="form-control" >
                <option name="male" class="form-control">MALE</option>
                <option name="female" class="form-control">FEMALE</option>
            </select>
        </div>
        <div class="form-group">
            <label>Country of Origin:<sup>*</sup></label>
            <input type="text" name="country" class="form-control" value="' . $row['country'] . '">
        </div>
        <div class="form-group">
            <label>Tell us about yourself:<sup>*</sup></label>';
        $param_username = $_POST['uname'];
        $cwd = getcwd();
        $structure1 = $cwd . "/members/" . $param_username;
        $bio_title = $structure1 . "/" . $param_username;
        $bio_open = fopen("$bio_title.txt", "r+");
        echo '           <textarea class="form-control" name="bio" rows="4" cols="50" placeholder="Type it this way starting with your name.
                Damilare Ademeso is minister of the gospel devoted to seeing the flames of worship across the nations e.t.c ">';
        echo fread($bio_open, filesize("$bio_title.txt"));
        fclose($bio_open);

        echo '                
</textarea></br>
        </div>
        <div class="form-group">
            <label>Phone number:<sup>*</sup></label>
            <input type="tel" name="phone" class="form-control" value="' . $row['phone'] . '">
        </div>
        <div class="form-group">
            <label>Email:<sup>*</sup></label>
            <input type="email" name="email" class="form-control" value="' . $row['email'] . '">
        </div>
        <div class="form-group">
            <label>Physical Address:<sup>*</sup></label>
            <input type="text" name="address" class="form-control" value="' . $row['address'] . '">
        </div>
        <div class="form-group">
            <label>Facebook Url:<sup>*</sup></label>
            <input type="url" name="facebook" class="form-control" value="' . $row['fb_link'] . '">
        </div>
        <div class="form-group">
            <label>Twitter url:<sup>*</sup></label>
            <input type="url" name="twitter" class="form-control" value="' . $row['twitter_link'] . '">
        </div>
        <div class="form-group"> 
            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
            <input type="reset" name="reset" class="btn btn-default" value="Reset">
        </div>
    </form>
</div>';


    }
}