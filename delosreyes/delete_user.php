<!DOCTYPE html>
<html lang=en>
	<head>
		<title>Delete User - Delos Reyes' Website</title>
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
				<h2>Deleting Record</h2>
				<?php
					if((isset($_GET['id'])) && (is_numeric($_GET['id']))){
						$id = $_GET['id'];
						
						
					} elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))){
						$id = $_POST['id'];
						
					} else {
						echo '
						<form action="index.php" method="get">
						<p>You are not supposed to be here.</p>
						<p><input type="submit" id="submit" name="submit" Value="Go back to Users"></p>';
						
					}
					
					require('mysqli_connect.php');
					if($_SERVER['REQUEST_METHOD'] == 'POST'){
						if($_POST['sure'] == 'Yes'){ //user pressed yes
							$q = "DELETE from users where user_id = $id;"; //delete specific user
							$result = @mysqli_query($dbcon, $q);
							if(mysqli_affected_rows($dbcon) == 1){
								echo '
								<form action="register-view-users.php" method="get">
								<h3>User deleted successfully</h3>
								<p><input type="submit" id="submit" name="submit" Value="Go back to Users"></p>
								';
							}else{
								echo '<h3>Error: Deletion failed, please contact system administrator</h3>';
								
							}
						}else{ // user pressed no
							echo '<h3>User not deleted.</h3>';
							echo '
							<form action="register-view-users.php" method="get">
							<p><input type="submit" id="submit" name="submit" Value="Go back to users page"></p>';
						}
						
					}else{ // display details of user to delete
						$q = "SELECT CONCAT(fname, ' ', lname) from users where user_id = $id;";
						$result = @mysqli_query($dbcon, $q);
						if(mysqli_num_rows($result) == 1){
							$row = mysqli_fetch_array($result, MYSQLI_NUM);
							echo "<h3>Are you sure you want to delete $row[0]?</h3>";
							echo '
							<form action="delete_user.php" method="post">
							<input id="submit-yes" type="submit" name="sure" value="Yes">
							<input id="submit-no" type="submit" name="sure" value="No">
							<input type="hidden" name="id" value="'.$id.'">
							</form>
							';
						}else{ //not valid id
							echo '<h3>ID is not valid or does not exist.</h3>';
							echo '<form action="register-page.php" method="get">
							<p>Would you like to register?</p>
							<p><input type="submit" id="submit" name="submit" Value="Register here"></p>';
						}
					}
					mysqli_close($dbcon);
				?>
			</div>
		</center>
		<?php include('footer.php');?>
		</center>
	</body>
</html>