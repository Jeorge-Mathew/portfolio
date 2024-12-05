    <?php
$dbcon = mysqli_connect('localhost', 'jdelosreyes', 'jdelosreyes', 'members_delosreyes')
OR die('Could not connect to the MySQL server.'. mysqli_connect_error());
mysqli_set_charset($dbcon, 'utf8');
?>