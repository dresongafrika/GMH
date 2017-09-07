<?php require ('top.php') ?>
<section id="main">
    <?php
        if (isset ($_GET["member_promo"])){

            /**  This is for the public    **/

            $member_promo=$_GET["member_promo"];
            $query = "SELECT artiste_name,phone,email FROM members";
            $stmt = mysqli_query ($dbc,$query);
            while ($row=mysqli_fetch_array($stmt)) {
                if ($member_promo == $row["artiste_name"]) {

                    echo '<form method="post" enctype="multipart/form-data" action="'. htmlspecialchars ($_SERVER["PHP_SELF"]).'">
                    Type in your program name:
                                                    <input type = "text" name = "title" required = "required" >
                    Please upload your advert banner in jpg or png format:
                                                    <input type = "file" name = "banner" required = "required" >
                    Type in the website link for your programme for redirection from our site:
                                                    <input type = "url" name = "url" >
                                                    <input type = "submit" name = "submit" >
                              </form >';
                                                if (isset($_POST['submit'])) {
                                                    $dir = 'arowoyin/';
                                                    $base = basename($_FILES ["banner"]["name"]);
                                                    $banner_link = $dir . $base;
                                                    $file_type = pathinfo($banner_link, PATHINFO_EXTENSION);
                                                    $prog_name = $_POST['title'];
                                                    $phone_number = $row["phone"];
                                                    $email = $row["email"];
                                                    $prog_url = $_POST['url'];
                                                    if ($file_type != "jpg" && $file_type != "png" && $file_type != "JPG" && $file_type != "PNG") {
                                                        $uploadOk = 0;
                                                        echo '*<span style="color:red;">Upload an album art with a jpg or png extension</span></br>';
                                                    } else {
                                                        move_uploaded_file($_FILES["banner"]["tmp_name"], $banner_link);
                                                        echo 'your advert has been uploaded. you can see it on the home page. May the blessing of the Almighty God be upon the programme';
                                                    }
                                                    $query = "INSERT INTO advertisement (ad_id,program_name,banner_link, phone_number,email, prog_url,upload_date) VALUES (NULL,?,?,?,?,?,NOW())";
                                                    $stmt = mysqli_prepare($dbc, $query);
                                                    mysqli_stmt_bind_param($stmt, "sssss", $prog_name, $banner_link, $phone_number, $email, $prog_url);
                                                    mysqli_stmt_execute($stmt);
                                                    mysqli_stmt_close($stmt);
                                                }
                }
            }
        }else{
            echo '<form method="post" enctype="multipart/form-data" action="'. htmlspecialchars ($_SERVER["PHP_SELF"]).'">
            Type in your program name:
                                                    <input type = "text" name = "title" required = "required" >
                Type in your phone number(with country dialing code):
                                                    <input type = "number" name = "phone" required = "required" >
                Type in your email address:
                                                    <input type = "email" name = "email" required = "required" >
                Please upload your advert banner in jpg or png format:
                                                    <input type = "file" name = "banner" required = "required" >
                Type in the website link for your programme for redirection from our site:
                                                    <input type = "url" name = "url" >
                                                    <input type = "submit" name = "submit" >
                              </form >';
                                                if (isset($_POST['submit'])) {
                                                    $dir = 'arowoyin/';
                                                    $base = basename($_FILES ["banner"]["name"]);
                                                    $banner_link = $dir . $base;
                                                    $file_type = pathinfo($banner_link, PATHINFO_EXTENSION);
                                                    $prog_name = $_POST['title'];
                                                    $phone_number = $_POST['phone'];
                                                    $email = $_POST['email'];
                                                    $prog_url = $_POST['url'];
                                                    if ($file_type != "jpg" && $file_type != "png" && $file_type != "JPG" && $file_type != "PNG") {
                                                        $uploadOk = 0;
                                                        echo '*<span style="color:red;">Upload an album art with a jpg or png extension</span></br>';
                                                    } else {
                                                        move_uploaded_file($_FILES["banner"]["tmp_name"], $banner_link);
                                                        echo 'your advert has been uploaded. you can see it on the home page. May the blessing of the Almighty God be upon the programme';
                                                    }
                                                    $query = "INSERT INTO advertisement (ad_id,program_name,banner_link, phone_number,email, prog_url,upload_date) VALUES (NULL,?,?,?,?,?,NOW())";
                                                    $stmt = mysqli_prepare($dbc, $query);
                                                    mysqli_stmt_bind_param($stmt, "sssss", $prog_name, $banner_link, $phone_number, $email, $prog_url);
                                                    mysqli_stmt_execute($stmt);
                                                    mysqli_stmt_close($stmt);
                                                }
                }
    ?>
</section>
<?php require ('bottom.php') ?>
