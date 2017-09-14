<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="org:url" content=""/>
    <meta property="org:type" content="website"/>
    <meta property="org:title" content="Gospel Music Hotspot"/>
    <meta property="org:description" content=""/>
    <meta property="org:image" content=""/>
    <title>Gospel Music Hotspot</title>
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js">
    </script>
    <![endif]-->
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="shortcut icon" type="image/png" href="logo/gmh.png"/>
    <link rel="stylesheet" href="css/gmh.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
</head>
<body >
<div id="fb-root"></div>
<script type="text/javascript">(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.10";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<?php ob_start();
session_start();?>
<div id="container_head">
    <div id="head">
        <a href="index.php"><img id="logo" src="logo/gmh.png" alt="logo"/></a>
        <h1 id="website_name">GOSPEL MUSIC HOTSPOT</h1>
        <h5 id="website_motto">Discography and biography of your favourite gospel musicians</h5>
    </div>
    <!--this is the menu page-->
    <nav id="menu">
        <li class="menu"><a href="index.php" target="_self">HOME</a></li>
        <li class="menu"><a href="promotions.php" target="_self">MUSIC PROMOTION</a></li>
        <li class="menu"><a href="membership.php" target="_self">MEMBERSHIP</a></li>
        <li class="menu"><a href="adverts.php" target="_self">ADVERT PLACEMENT</a></li>
        <li class="menu"><a href="contact_us.php" target="_self">CONTACT US</a></li>
    </nav>
    <div id="nav_container" onmouseover="mOver(this)" onmouseout="mOut(this)">
        <nav id="navigator" ><i class="fa fa-navicon"/></i></nav>
        <nav id="menu_new_nav">
            <li class="new_nav"><a href="index.php" target="_self">HOME</a></li>
            <li class="new_nav"><a href="promotions.php" target="_self">MUSIC PROMOTION</a></li>
            <li class="new_nav"><a href="membership.php" target="_self">MEMBERSHIP</a></li>
            <li class="new_nav"><a href="adverts.php" target="_self">ADVERT PLACEMENT</a></li>
            <li class="new_nav"><a href="contact_us.php" target="_self">CONTACT US</a></li>
        </nav>
    </div>
</div>
<div id="radio_container">
    <b id="radio_indicator">Click play to listen to 24hr GMH radio!</b>
    <audio id="radio" controls="controls">
        <?php
        require_once ('db/config.php');
        $query = "SELECT * FROM members_songs";
        $stmt = mysqli_query ($dbc,$query);
        while ($row=mysqli_fetch_array($stmt)){
            echo ' Now playing!' .$row["song_title"]. 'by'. $row["artiste_name"].
            '<source type="audio/mp3" src="'.$row["song_link"].'" />
                            Your browser does not support the audio element.';
        }
        ?>
    </audio>
</div>

   <?php
   if($_SERVER["PHP_SELF"]!=="/member.php" && $_SERVER["PHP_SELF"]!=="/member_login.php"){
       echo '<a href="member_login.php"><b id="member_other_pages">Are you a member?Click here to log in.</b></a>';
   }
   ?>

<form id="fav_search">
        <label >Check out your favourite artiste.</label>
            <select id="artistes_menu" onchange="if (this.value) window.location.href=this.value;">
                <option value="index.php" selected="selected"> Select your favourite artiste below</option>
            <?php
            $query1 = 'SELECT artiste_name FROM members ORDER BY artiste_name ASC ';
            $stmt1 = mysqli_query ($dbc,$query1);
            while ($result=mysqli_fetch_array($stmt1)){
                echo '<option name="artiste_select" value="member_page.php?name='.$result["artiste_name"].'">'.$result["artiste_name"].'</option>';
            }
            ?>
            </select>

</form>
