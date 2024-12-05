<doctype html>
    <html lang="en">
        <head>
            <title>Registration Page | Delos Reyes' Website</title>
            <meta charset="utf-8">
            <link rel="stylesheet" type="text/css" href="css/include.css">
        </head>
        <body>
            <div id="container">
            <center>
                <?php include('nav.php');?>
                <?php include('header.php');?>
                <?php include('info-col.php');?>
                   <div id="content">
                        <?php
                            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $errors = array(); //initialize error array
                                //if first name is filled...
                                if(empty($_POST['fname'])){
                                    $errors[] = 'Please enter your first name.';
                                }else{
                                    $fn = trim($_POST['fname']);
                                }
                                
                                //if last name is filled...
                                if(empty($_POST['lname'])){
                                    $errors[] = 'Please enter your last name.';
                                }else{
                                    $ln = trim($_POST['lname']);
                                }
                                
                                //if email is filled...
                                if(empty($_POST['email'])){
                                    $errors[] = 'Please enter your email address.';
                                }else{
                                    $e = trim($_POST['email']);
                                }
                                
                                //if both passwords are the same...
                                if(!empty($_POST['psword1'])){
                                    if($_POST['psword1'] != $_POST['psword2']){
                                        $errors[] = 'Your passwords do not match.';
                                    }else{
                                        $p = trim($_POST['psword1']);
										$p_hashed = password_hash($p, PASSWORD_DEFAULT);
                                    }
                                }else{
                                    $errors[] = 'Please enter your password.';
                                }

                                //All textboxes are filled or no errors:
                                if(empty($errors)) {
                                // Register the user in the database...
                                    require ('mysqli_connect.php'); // Connect to the db.
									
                                    // Make the query:
                                    $q = "INSERT INTO users (fname, lname, email, psword, registration_date) VALUES ('$fn', '$ln', '$e', '$p', NOW())";		//this password ($p) is NOT encrypted. find a way to secure this password
                                    
									$result = @mysqli_query ($dbcon, $q); // Run the query.
                                    if ($result) { // If it ran OK.
                                    header ("location: register-thanks.php"); 
                                    exit();	
                                    } else { // If it did not run OK.
                                        //Public message:
                                        echo '<h2>System Error</h2>
                                        <p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
                                        // Debugging message:
                                        echo '<p>' . mysqli_error($dbcon) . '</p>';
                                    }
                                    mysqli_close($dbcon); // Close the database connection.
                                    // Include the footer and quit the script:
                                    include ('footer.php');
                                    exit();
                                    
                                    
                                
                                }else{
                                    echo '<h2>Error found.</h2>
                                    <p>The following error(s) occured:<br/>
                                    ';
                                    foreach($errors as $msg){
                                        echo "- $msg<br/>";
                                    }
                                    echo '</p><h4>Please try again.</h4><br/><br/>';
                                }
                            }
                        ?>


                        <h2>Register</h2>
                            <form action="register-page.php" method="post">
                                <center>
                                    <table>
                                        <tr>
                                        <p><label class="label" for="fname"><td align="right">First Name:  </td></label>
                                        <td align="left"><input type="text" id="fname" name="fname" size="30" maxlength="40" value="<?php if(isset($_POST['fname'])) echo $_POST['fname']?>"></td>
                                        </p></tr>
                                        
                                        <tr>
                                        <p><label class="label" for="lname"><td align="right">Last Name:  </td></label>
                                        <td align="left"><input type="text" id="lname" name="lname" size="30" maxlength="40" value="<?php if(isset($_POST['lname'])) echo $_POST['lname']?>"></td>
                                        </p></tr>

                                        <tr>
                                        <p><label class="label" for="email"><td align="right">Email Address:  </td></label>
                                        <td align="left"><input type="email" id="email" name="email" size="30" maxlength="50" value="<?php if(isset($_POST['email'])) echo $_POST['email']?>"></td>
                                        </p></tr>

                                        <tr>
                                        <p><label class="label" for="psword1"><td align="right">Password:  </td></label>
                                        <td align="left"><input type="password" id="psword1" name="psword1" size="30" maxlength="20" value="<?php if(isset($_POST['psword1'])) echo $_POST['psword1']?>"></td>
                                        </p></tr>

                                        <tr>
                                        <p><label class="label" for="psword2"><td align="right">Confirm Password:  </td></label>
                                        <td align="left"><input type="password" id="psword2" name="psword2" size="30" maxlength="20" value="<?php if(isset($_POST['psword2'])) echo $_POST['psword2']?>"></td>
                                        </p></tr>

                                        </table>
                                    <p><input type="submit" id="submit" name="submit" Value="Register"></p>
                                    
                                </center>
                            </form>
                   </div>
            </center>       
            </div>
            <center>
            <?php include('footer.php');?>
            </center>      
        </body>    
    </html>
</doctype>