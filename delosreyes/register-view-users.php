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
				<h2>Registered Users</h2>
				<p>
					<?php
						require("mysqli_connect.php");
						$q = "select user_id, fname, lname, email, DATE_FORMAT(registration_date, '%M %d, %Y') AS regdat from users ORDER BY user_id ASC";
						$result = @mysqli_query($dbcon, $q);
						if($result){
							echo '<table style="border-collapse: collapse; border: 2px solid black;">
							<tr style="border: 1px solid black">
							<th style="border: none; padding: 10px;"><strong>Name</strong></th>
							<th style="border: none; padding: 10px;"><strong>Email</strong></th>
							<th style="border: none; padding: 10px;"><strong>Date Registered</strong></th>
							<th colspan="2" style="border: none; padding: 10px;"><strong>Actions</strong></th>
							</tr>';
							while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
								echo '<tr>
								<td style="border: none; padding: 10px;">'.$row['lname'].', '.$row['fname'].'</td>
								<td style="border: none; padding: 10px;">'.$row['email'].'</td>
								<td style="border: none; padding: 10px;">'.$row['regdat'].'</td>
								<td style="border: none; padding: 10px;"><a href="edit_user.php?id='.$row['user_id'].'">Edit</a></td>
								<td style="border: none; padding: 10px;"><a href="delete_user.php?id='.$row['user_id'].'">Delete</a></td>
								</tr>';
								
								
							}
							echo '</table>';
							mysqli_free_result($result);
							
						}else{
							echo '<p class="error">Registered users cannot be retrieved. Contact the system administrator.</p>'; 
                             
						}
						mysqli_close($dbcon);
					 
					?>
				</p>
			</div>
		</center>
		<?php include('footer.php');?>
		</center>
	</body>
</html>