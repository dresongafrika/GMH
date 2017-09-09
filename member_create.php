<?php require ('top.php'); mysqli_report(MYSQLI_REPORT_ALL);?>
<section id="main">
<?php
if(!isset($_GET['pay'])  || !isset($_GET['i']) || empty($_GET['i']) || !isset($_POST['transaction_id'])) {
    header("location: membership.php");
    exit;
}

    $identifier = $_GET['i'];
    $query = "SELECT * FROM members WHERE identifier ='$identifier' LIMIT 1";
    $stmt = mysqli_query($dbc, $query);
    if($stmt && mysqli_num_rows($stmt) > 0){
    $result = mysqli_fetch_array($stmt,MYSQLI_ASSOC);
    $uName = $result['artiste_name'];
    $id = $result['artiste_id'];
    $transaction_id = $_POST['transaction_id'];

    // Check input errors before inserting in database
    // Prepare an insert statement
    $query = "UPDATE members SET transaction_id = ?,membership_date = NOW() ,expiry_date = NOW()  WHERE artiste_id = '$id'";
    $stmt = mysqli_prepare($dbc, $query);
    mysqli_stmt_bind_param($stmt,'s', $transaction_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

// Set parameters
    $param_username = $uName;
    // Bind variables to the prepared statement as parameters
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


    // Attempt to execute the prepared statement
    echo '
        <a href="member_edit.php?name=' . $param_username . '"><h6>welcome ' . $param_username . '! Your transaction id is ' . $transaction_id . ' Click here to set up your profile</h6></a>';
    }        
?>
</section>
<?php require ('bottom.php'); ?>
