
	
<?php
session_start();
if(empty($_SESSION['login_user']))
{
	header('Location: login.php');
}else{
	echo $_SESSION['login_user'];
}
?>

<meta http-equiv = "refresh" content = "0; url = <?php echo $path_site;?>login.php" />
