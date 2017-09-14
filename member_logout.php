
<?php
require ('top.php');

$_SESSION = array();

session_destroy();


header('location:index.php');

// Unset all of the session variables

// Destroy the session.

// Redirect to login page
exit;
?>