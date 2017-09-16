<?php require ('top.php') ?>
<section id="main">
    <?php
        if (isset ($_POST["submit"])){

            /**  This is for MEMBERS    **/

            $query = "SELECT artiste_name,phone,password,email FROM members WHERE artiste_name='".$_POST["artiste_name"]."'";
            $stmt = mysqli_query ($dbc,$query);
            $row=mysqli_fetch_array($stmt);
            if (password_verify($_POST["password"],$row["password"])) {
                echo '<form method="post" enctype="multipart/form-data" action="adverts_post.php">
                    Type in your program name:
                                                    <input type = "text" name = "title" required = "required" />
                                                    <input type = "hidden" name = "phone" value="' . $row["phone"] . '"/>
                                                    <input type = "hidden" name = "email" value="' . $row["email"] . '"/>
                    Please upload your advert banner in jpg or png format:
                                                    <input type = "file" name = "banner" required = "required" >
                                                    For how many days would you want this advert to run?
                                                    <input type = "number" name = "days" required = "required" >
                                                    <input type = "hidden" name = "amount" value="2500" >
                    Type in the website link for your programme for redirection from our site:
                                                    <input type = "url" name = "url" >
                                                    <input type = "submit" name = "submit" >
                              </form >';
            }else{
                echo 'invalid credentials';
            }
        }else{
            echo '<form method="post" enctype="multipart/form-data" action="adverts_post.php">
            Type in your program name:
                                                    <input type = "text" name = "title" required = "required" >
                Type in your phone number(with country dialing code):
                                                    <input type = "number" name = "phone" required = "required" >
                Type in your email address:
                                                    <input type = "email" name = "email" required = "required" >
                Please upload your advert banner in jpg or png format:
                                                    <input type = "file" name = "banner" required = "required" >
                                                    For how many days would you want this advert to run?
                                                    <input type = "number" name = "days" required = "required" >
                                                    <input type = "hidden" name = "amount" value="5000" >
                Type in the website link for your programme for redirection from our site:
                                                    <input type = "url" name = "url" >
                                                    <input type = "submit" name = "submit" >
                              </form >';
                }
    ?>
</section>
<?php require ('bottom.php') ?>
