<?php require ('top.php') ?>
    <section id="main">
<?php
    if (isset ($_GET["name"])){
            $member=$_GET["name"];
            $query = "SELECT * FROM members";
            $stmt = mysqli_query ($dbc,$query);
            while ($row=mysqli_fetch_array($stmt)) {
                if ($member == $row["artiste_name"]){
                    if ($row["sex"]=="MALE"){
                        echo "Welcome to ".$row['artiste_name']."'s page.</br>
                        Here you can find everything you need to know about ".$row['artiste_name'].", download all his songs and lyrics.</br>
                        <h5>BIOGRAPHY</h5></br>";
                        echo '
                        Full Name: '.$row["first_name"].' '.$row["last_name"].'</br>
                        Sex: '.$row["sex"].'</br>
                        Year of conversion: '.$row["born_again"].'</br>
                        About'.$row["first_name"].':</br>';
                        $param_username = $row["artiste_name"];
                        $structure1=$cwd."/members/".$param_username;
                        $bio_title=$structure1."/".$param_username;
                        $read_bio = fopen("$bio_title.txt", "r");
                        echo fread($read_bio,filesize("$bio_title.txt"));
                        fclose($read_bio);echo '</br>
                        <h5>DISCOGRAPHY</h5></br>
                        Below is a list of songs by'.$row["first_name"].' Click to download/Listen online:</br>';
                        $query = "SELECT * FROM members_songs";
                        $stmt = mysqli_query ($dbc,$query);
                        while ($row=mysqli_fetch_array($stmt)) {
                            echo '<a href="'.$row["song_link"].'">'.$row["song_title"].'</a>';
                        }
                            echo ' If you want to invite'.$row["artiste_name"].' for a programme or send him a personal message? Fill below form.
                            <form action="'.htmlspecialchars ($_SERVER["PHP_SELF"]).'" method="GET" enctype="text/plain">
                                Name:<br>
                                <input type="text" name="name" placeholder="your name" required="required"><br>
                                Phone number:<br>
                                <input type="number" name="number" placeholder="your number preceded by country code" required="required"><br>
                                            E-mail:<br>
                                <input type="text" name="mail" placeholder="youremail@website.com" required="required"><br>
                                            Subject:<br>
                                <input type="text" name="subject" placeholder="your name" required="required"><br>
                                            Your message:<br>
                                <textarea name="message" rows="4" cols="50" placeholder="Your message goes here" required="required"></textarea><br>
                                <input type="submit" value="SEND MESSAGE" name="submit">
                            </form>';
                            if(isset($_GET['submit'])){
                                $cwd=getcwd();
                                $structure1=$cwd."/members/".$param_username;
                                $structure5=$structure1."/fan messages";

                                $name=$_GET["name"];
                                $number=$_GET["number"];
                                $email=$_GET["mail"];
                                $subject=$_GET["subject"];
                                $message=$_GET["message"];
                                $message_target=$structure5;
                                $message_content = fopen("$subject from $name.txt", "w");
                                $new_subject="$subject from $name.txt";
                                fwrite($message_content, $subject.PHP_EOL);
                                fwrite($message_content, $name.PHP_EOL);
                                fwrite($message_content, $number.PHP_EOL);
                                fwrite($message_content, $email.PHP_EOL);
                                fwrite($message_content, $message.PHP_EOL);
                                fclose($message_content);
                                rename("$subject from $name.txt","$message_target$new_subject");
                                echo '<h4>Thank you!'.$row["artiste_name"].'will get back to you if need be.</h4>';
                            }
                        }
                    }else{
                    echo "Welcome to ".$row['artiste_name']."'s page.</br>
                    Here you can find everything you need to know about ".$row['artiste_name'].", download all her songs and lyrics.</br>
                    <h5>BIOGRAPHY</h5></br>";
                    echo '
                    Full Name: '.$row["first_name"].' '.$row["last_name"].'</br>
                    Sex: '.$row["sex"].'</br>
                    Year of conversion: '.$row["born_again"].'</br>
                    About'.$row["first_name"].':</br>';
                    $param_username = $row["artiste_name"];
                    $structure1=$cwd."/members/".$param_username;
                    $bio_title=$structure1."/".$param_username;
                    $read_bio = fopen("$bio_title.txt", "r");
                    echo fread($read_bio,filesize("$bio_title.txt"));
                    fclose($read_bio);echo '</br>
                    <h5>DISCOGRAPHY</h5></br>
                    Below is a list of songs by'.$row["first_name"].' You can click to download:</br>';
                    $query = "SELECT * FROM members_songs";
                    $stmt = mysqli_query ($dbc,$query);
                    while ($row=mysqli_fetch_array($stmt)) {
                        echo '<a href="'.$row["song_link"].'">'.$row["song_title"].'</a>';
                    }
                    echo ' If you want to invite'.$row["artiste_name"].' for a programme or send him a personal message? Fill below form.
                            <form action="'.htmlspecialchars ($_SERVER["PHP_SELF"]).'" method="GET" enctype="text/plain">
                                Name:<br>
                                <input type="text" name="name" placeholder="your name" required="required"><br>
                                Phone number:<br>
                                <input type="number" name="number" placeholder="your number preceded by country code" required="required"><br>
                                            E-mail:<br>
                                <input type="text" name="mail" placeholder="youremail@website.com" required="required"><br>
                                            Subject:<br>
                                <input type="text" name="subject" placeholder="your name" required="required"><br>
                                            Your message:<br>
                                <textarea name="message" rows="4" cols="50" placeholder="Your message goes here" required="required"></textarea><br>
                                <input type="submit" value="SEND MESSAGE" name="submit">
                            </form>';
                    if(isset($_POST['submit'])){
                        $cwd=getcwd();
                        $structure1=$cwd."/members/".$param_username;
                        $structure5=$structure1."/fan messages";
                        $name=$_POST["name"];
                        $number=$_POST["number"];
                        $email=$_POST["mail"];
                        $date=date("Y-m-d H:i:s");
                        $subject=$_POST["subject"];
                        $message=$_POST["message"];
                        $message_target=$structure5.'/'.$subject.'from'.$name;
                        $message_content = fopen("$subject from $name.txt", "w");
                        fwrite($message_content, $subject.PHP_EOL);
                        fwrite($message_content, $name.PHP_EOL);
                        fwrite($message_content, $number.PHP_EOL);
                        fwrite($message_content, $email.PHP_EOL);
                        fwrite($message_content, $date.PHP_EOL);
                        fwrite($message_content, $message.PHP_EOL);
                        fclose($message_content);
                        rename($subject ."from". $name.".txt",$message_target.".txt");
                            $query='INSERT INTO fan_messages VALUES ('.$row["artiste_name"].',?,NOW())';
                            $stmt = mysqli_prepare ($dbc,$query);
                            mysqli_stmt_bind_param($stmt, "s",$message_target);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);
                        echo '<h4>Thank you!'.$name.'.'.$row["artiste_name"].'will get back to you if need be.</h4>';
                    }

                }
            }
    }
?>
    </section>
<?php require ('bottom.php'); ?>