<?php require ('top.php') ?>
<section id="main">
    <?php
            echo' 
                            <h2>Just released a song? This is for you. With just $27.40 you can promote your song on our front page with a download link for your fans</h2>
                            <form method="post" enctype="multipart/form-data" action="promo_post.php">
                            Type in your name as written on your song cover:
                            <input type="text" name="name" required="required" >
                            Type in the song title:
                            <input type="text" name="title" required="required" >
                            Type in your phone number (with country dialing code):
                            <input type="number" name="phone" required="required" >
                            Type in a a valid email address:
                            <input type="email" name="email" required="required" >
                            <input type="hidden" name="price" value="10000" >
                            Tell us about yourself:
                            <textarea name="bio" rows="4" cols="50" placeholder="Type it this way starting with your name.
                            Damilare Ademeso is minister of the gospel devoted to seeing the flames of worship across the nations e.t.c " required="required"></textarea></br>
                            Select mp3 to upload:
                            <input type="file" name="mp3" required="required" >
                            Select album cover to upload:
                            <input type="file" name="cover" required="required" >
                            Type in the lyrics:
                            <textarea name="lyrics" rows="4" cols="50" placeholder="Type it this way. Please ensure it contains the necessary song parts like choruses, verses and bridge" required="required"></textarea></br>

                            <input type="submit" value="Upload" name="submit">
                            </form></br>';


    ?>
   <a href="https://voguepay.com/register/3828-0054426"><img src="https://voguepay.com/images/banners/f.png" width="600" height="60" /></a>
</section>
<?php require ('bottom.php') ?>
