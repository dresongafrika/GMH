<?php require ('top.php') ?>
    <section id="main">
<?php
    if (isset ($_GET["name"])){
            $member=$_GET["name"];
            $query = 'SELECT * FROM members WHERE artiste_name="'.$member.'"';
            $stmt = mysqli_query ($dbc,$query);
            $row=mysqli_fetch_array($stmt);
                    if ($row["sex"]=="MALE"){
                        echo "<b>Welcome to ".$row['artiste_name']."'s page.</b></br>
                        Here you can find everything you need to know about ".$row['artiste_name'].", download all his songs and lyrics.</br>
                        <h5>BIOGRAPHY</h5></br>";
                        echo '
                        Full Name: '.$row["first_name"].' '.$row["last_name"].'</br>
                        Sex: '.$row["sex"].'</br>
                        Year of conversion: '.$row["born_again"].'</br>
                        <h5>ABOUT '.strtoupper($row["artiste_name"]).':</h5></br>';
                        $param_username = $row["artiste_name"];
                        $cwd=getcwd();
                        $structure1=$cwd."/members/".$param_username;
                        $bio_title=$structure1."/".$param_username;
                        $read_bio = fopen("$bio_title.txt", "r");
                        echo '<div id="member_bio_read">'.fread($read_bio,filesize("$bio_title.txt")).'</div></br>';
                        fclose($read_bio);
                        echo '
                        facebook url: <a target="_blank" href="'.$row["fb_link"].'">'.$row["fb_link"].'</a></br>
                        twitter url: <a target="_blank" href="'.$row["twitter_link"].'">'.$row["twitter_link"].'</a></br>
                        <h5>DISCOGRAPHY</h5></br>
                        Below is a list of all songs by '.$row["artiste_name"].'. Click to download/Listen online:</br>';
                        $query1 = 'SELECT * FROM members_songs WHERE artiste_name="'.$row["artiste_name"].'"';
                        $stmt1 = mysqli_query ($dbc,$query1);
                        echo '<ol>';
                        while ($result=mysqli_fetch_array($stmt1)) {
                            echo '<li><a href="'.$result["song_link"].'">'.$result["song_title"].' from the album '.$result["album_name"].'.</a></li>';
                        }
                        echo '</ol>';
                            echo ' If you want to invite'.$result["artiste_name"].' for a programme or send him a personal message? Fill below form.
                            <form action="message_member.php" method="POST" enctype="text/plain">
                                Name:<br>
                                <input type="text" name="name" placeholder="your name" required="required"><br>
                                Phone number:<br>
                                <input type="number" name="number" placeholder="your number preceded by country code" required="required"><br>
                                            E-mail:<br>
                                <input type="email" name="mail" placeholder="youremail@website.com" required="required"><br>
                                            Subject:<br>
                                <input type="text" name="subject" placeholder="your name" required="required"><br>
                                <input type="hidden" name="artiste_name"  value="'.$result["artiste_name"].'"><br>
                                            Your message:<br>
                                <textarea name="message" rows="4" cols="50" placeholder="Your message goes here" required="required"></textarea><br>
                                <input type="submit" value="SEND MESSAGE" name="submit">
                            </form>';
                    }else{
                    echo "<b>Welcome to ".$row['artiste_name']."'s page.</b></br>
                    Here you can find everything you need to know about ".$row['artiste_name'].", download all her songs and lyrics.</br>
                    <h5>BIOGRAPHY</h5></br>";
                        echo '
                    Full Name: '.$row["first_name"].' '.$row["last_name"].'</br>
                    Sex: '.$row["sex"].'</br>
                    Year of conversion: '.$row["born_again"].'</br>
                    <h5>ABOUT '.strtoupper($row["artiste_name"]).':</h5></br>';
                        $param_username = $row["artiste_name"];
                        $cwd=getcwd();
                        $structure1=$cwd."/members/".$param_username;
                        $bio_title=$structure1."/".$param_username;
                        $read_bio = fopen("$bio_title.txt", "r");
                        echo '<div id="member_bio_read">'.fread($read_bio,filesize("$bio_title.txt")).'</div></br>';
                        fclose($read_bio);
                        echo '
                        facebook url: <a target="_blank" href="'.$row["fb_link"].'">'.$row["fb_link"].'</a></br>
                        twitter url: <a target="_blank" href="'.$row["twitter_link"].'">'.$row["twitter_link"].'</a></br>
                    <h5>DISCOGRAPHY</h5></br>
                    Below is a list of songs by '.$row["artiste_name"].'. Click to download/Listen online:</br>';
                        $query1 = 'SELECT * FROM members_songs WHERE artiste_name="'.$row["artiste_name"].'"';
                        $stmt1 = mysqli_query ($dbc,$query1);
                        while ($result=mysqli_fetch_array($stmt1)) {
                            echo '<a href="'.$result["song_link"].'">'.$result["song_title"].'</a>';
                        }
                        echo ' If you want to invite'.$result["artiste_name"].' for a programme or send him a personal message? Fill below form.
                            <form action="message_member.php" method="POST" enctype="text/plain">
                                Name:<br>
                                <input type="text" name="name" placeholder="your name" required="required"><br>
                                Phone number:<br>
                                <input type="number" name="number" placeholder="your number preceded by country code" required="required"><br>
                                            E-mail:<br>
                                <input type="email" name="mail" placeholder="youremail@website.com" required="required"><br>
                                            Subject:<br>
                                <input type="text" name="subject" placeholder="your name" required="required"><br>
                                <input type="hidden" name="artiste_name"  value="'.$result["artiste_name"].'"><br>
                                            Your message:<br>
                                <textarea name="message" rows="4" cols="50" placeholder="Your message goes here" required="required"></textarea><br>
                                <input type="submit" value="SEND MESSAGE" name="submit">
                            </form>';

                    }
    }
?>
    </section>
<?php require ('bottom.php'); ?>