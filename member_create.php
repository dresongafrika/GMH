<?php require ('top.php'); ?>
<section id="main">
<?php
$query = "SELECT artiste_name FROM members";
$stmt = mysqli_query ($dbc,$query);
        $uName=$_GET['username'];

        // Check input errors before inserting in database
        // Prepare an insert statement
        $query = "INSERT INTO members (membership_date,expiry_date) VALUES (NOW(),NOW());";
        $stmt = mysqli_prepare($dbc, $query);
            // Set parameters
            $param_username = $uName;
            // Bind variables to the prepared statement as parameters
            $cwd=getcwd();
            $structure1=$cwd."/members/".$param_username;
            $structure2=$structure1."/uploads";
            $structure3=$structure1."/lyrics";
            $structure4=$structure1."/album art";
            $structure5=$structure1."/fan messages";
            mkdir($structure1,0777,true);
            mkdir($structure2,0777,true);
            mkdir($structure3,0777,true);
            mkdir($structure4,0777,true);
            mkdir($structure5,0777,true);


            // Attempt to execute the prepared statement
                echo '
                <a href="member_edit.php?name='.$param_username.'"><h6>welcome '.$param_username.'! Click here to set up your profile</h6></a>';
?>
</section>
<?php require ('bottom.php'); ?>
