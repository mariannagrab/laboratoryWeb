<?php
// wylogowanie i przekierowanie do strony startowej
session_start();

if(isset($_SESSION['logged_user'])) {
	unset($_SESSION['logged_user']);	
}
header("Location: index.php");
die();
?>
