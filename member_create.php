<?php require ('top.php');?>
<section id="main">
<?php
if(!isset($_GET['p'])  || !isset($_GET['u']) || empty($_GET['u']) || !isset($_POST['transaction_id'])) {
    header("location: membership.php");
    exit;
}

    $uName = $_GET['u'];
    $query = 'SELECT artiste_name,password FROM tmp_member WHERE artiste_name ="'.$uName.'"';
    $stmt = mysqli_query($dbc, $query);
    $row=mysqli_fetch_array($stmt);
    $oruko=$row['artiste_name'];
    $ikoko=$row['password'];

    $transaction_id = $_POST['transaction_id'];

    // Check input errors before inserting in database
    // Prepare an insert statement
    $query='INSERT INTO members (artiste_id,artiste_name,password,transaction_id,membership_date,expiry_date) VALUES (NULL,?,?,?,NOW(),NOW())';
    $stmt = mysqli_prepare($dbc, $query);
    mysqli_stmt_bind_param($stmt,'sss', $oruko,$ikoko,$transaction_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $query='DELETE FROM tmp_member WHERE artiste_name = "'.$oruko.'"';
    $stmt=mysqli_query($dbc,$query);

// Set parameters
    $param_username = $uName;
    $cwd = getcwd();
    $structure1 = $cwd . "/members/" . $param_username;
    $structure2 = $structure1 . "/uploads";
    $structure3 = $structure1 . "/lyrics";
    $structure4 = $structure1 . "/album art";
    $structure5 = $structure1 . "/fan messages";
    if(!file_exists($structure1)) mkdir($structure1, 0777, true);
    if(!file_exists($structure2)) mkdir($structure2, 0777, true);
    if(!file_exists($structure3)) mkdir($structure3, 0777, true);
    if(!file_exists($structure4)) mkdir($structure4, 0777, true);
    if(!file_exists($structure5)) mkdir($structure5, 0777, true);


    echo '
        <a href="member_edit.php?name=' . $param_username . '"><h6>welcome ' . $param_username . '! Your transaction id is ' . $transaction_id . ' Click here to set up your profile</h6></a>';
?>
</section>
<?php require ('bottom.php'); ?>
