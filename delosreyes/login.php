<!DOCTYPE html>
<html lang=en>
	<head>
		<title>Delos Reyes' Website</title>
		<link rel="stylesheet" type="text/css" href="css/include.css">
		<meta charset=utf-8>
	</head>
	<body>
		<div id="container">
		<center>
		<?php include('nav.php');?>
		<?php include('header.php');?>
		<?php include('info-col.php');?>
			<div id="content">
                        <?php
                            if($_SERVER['REQUEST_METHOD'] == 'GET') {
                                $errors = array(); //initialize error array
                                //if email is filled...
                                if(empty($_GET['email'])){
                                    $errors[] = 'Please enter your email address.';
                                } else {
                                    $e = trim($_GET['email']);
                                }
                                
                                //if both passwords are the same...
                                if(empty($_GET['psword'])){
                                    $errors[] = 'Please enter your password.'
								} else {
                                    $p = trim($_GET['psword']);
									$p_hashed = password_hash($p, PASSWORD_DEFAULT);
                                }

                                //All textboxes are filled or no errors:
                                if(empty($errors)) {
                                
                                    require ('mysqli_connect.php'); // Connect to the db.
									
                                    // Make the query:
                                    $q = "SELECT email, psword FROM users WHERE psword = $p AND email = $e";//this password ($p) is NOT encrypted. find a way to secure this password
                                    
									$result = @mysqli_query ($dbcon, $q); // Run the query.
                                    if ($result) { // If it ran OK.
                                    header ("location: member_page.php"); 
                                    exit();	
                                    } else { // If it did not run OK.
                                        //Public message:
                                        echo '<h2>System Error</h2>
                                        <p class="error">Login error.</p>'; 
                                        // Debugging message:
                                        echo '<p>' . mysqli_error($dbcon) . '</p>';
                                    }
                                    mysqli_close($dbcon); // Close the database connection.
                                    // Include the footer and quit the script:
                                    include ('footer.php');
                                    exit();
                                    
                                    
                                
                                } else {
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


                        <h2>Login</h2>
                            <form action="login.php" method="get">
                                <center>
                                    <table>
                                        <tr>
                                        <p><label class="label" for="email"><td align="right">Email Address:  </td></label>
                                        <td align="left"><input type="email" id="email" name="email" size="30" maxlength="50" value="<?php if(isset($_POST['email'])) echo $_POST['email']?>"></td>
                                        </p></tr>

                                        <tr>
                                        <p><label class="label" for="psword"><td align="right">Password:  </td></label>
                                        <td align="left"><input type="password" id="psword" name="psword" size="30" maxlength="20" value="<?php if(isset($_POST['psword'])) echo $_POST['psword']?>"></td>
                                        </p></tr>
									</table>
                                    <p><input type="submit" id="submit" name="submit" Value="Login"></p>
                                    
                                </center>
                            </form>
                   </div>
		</center>
		<?php include('footer.php');?>
		</center>
	</body>
</html>