<?php
// strona logowania dla administratorów księgarni internetowej
session_start();
require 'connection.php';

if(isset($_POST['login'])) {

	$user = $_POST['login'];
	$pass = $_POST['password'];
	
	// jeżeli któreś z pól nie jest wypełnione wyświetlony zostanie komunikat 
	if(empty($user) || empty($pass)) {
		$_SESSION['admin_message'] = 'Wszystkie pola są wymagane!';
	} else {
		$password = password_hash($pass, PASSWORD_DEFAULT);
		$db = mysqli_connect('localhost', 'root', '', 'laboratorium');
		$query = "INSERT INTO uzytkownicy (login, haslo) 
  			  VALUES('$user', '$password')";
		mysqli_query($db, $query);
	}
}

?>
<!DOCTYPE HTML>
<html lang = "pl">
<head>
<title>Laboratorium</title>
	<meta charset="utf-8" />
	
	<META NAME=KEYWORDS CONTENT="laboratorium,phplab,inwentaryzacja">
	<META NAME=DESCRIPTION CONTENT="Laboratorium">
	<META NAME= "author" CONTENT= "Marianna Grabowska">
	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="stylesheet" href="style/main.css">
</head>
<body>
	<div class="container-md">
		<div id="header">
		<div class="row">
			<div class="col-10">
					 <a href="index.php" class="logo">Wyposażenie laboratorium</a>
			</div>
			</div>
		</div>
		
	
	<div class="row">
	<form method="post" class="container-md">	
	
	
	  <div class="mb-3">
		<label for="login" class="form-label">Login</label>
		<input type="login" name="login" class="form-control" id="login">
	  </div>
	  <div class="mb-3">
		<label for="password" class="form-label">Hasło</label>
		<input type="password" name="password" class="form-control" id="password">
	  </div>
	  <?php	
	if(isset($_SESSION['admin_message'])){
		echo "<div><p style='color:red'>".$_SESSION['admin_message']."</p></div>";
		unset($_SESSION['admin_message']);
	} 
	?>
	  <input type="submit" class="btn btn-primary" value="Zaloguj się">
	  
	</form>
	</div>
</div>
  </body>
</html>
