<?php require ('top.php'); ?>
<section id="main">
    <?php
        // Define variables and initialize with empty values
        $username = $password = "";
        $username_err = $password_err = "";

        // Processing form data when form is submitted
        if($_SERVER["REQUEST_METHOD"] == "POST"){

            // Check if artiste_name is empty
            if(empty(trim($_POST["artiste_name"]))){
                $username_err = 'Please enter artiste_name.';
            } else{            $username = trim($_POST["artiste_name"]);
            }

            // Check if password is empty
            if(empty(trim($_POST['password']))){
                $password_err = 'Please enter your password.';
            } else{
                $password = trim($_POST['password']);
            }
            // Validate credentials
            if(empty($username_err) && empty($password_err)){
                // Prepare a select statement
                $query = "SELECT admin_name, password FROM admin";
                $stmt = mysqli_query ($dbc,$query);
                while ($row=mysqli_fetch_array($stmt)) {
                    if($username==$row["admin_name"] && $password===$row["password"]) {
                        /* Password is correct, so start a new session and
                    save the artiste_name to the session */
                    session_start();
                    $_SESSION['admin_name'] = $username;
                    header("location: admin.php");
                    // Close statement
                        }
                 }
                mysqli_stmt_close($stmt);
            }

        }
    ?>

    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your admin credentials.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Stage_name:<sup>*</sup></label>
                <input type="text" name="artiste_name" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password:<sup>*</sup></label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
    </div>
</section>
