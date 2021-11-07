<?php
// strona logowania dla opiekunów laboratorium 
session_start();

// dodanie paczki z funkcjami interaktywnymi z bazą danych 
include('functions.php');

if(isset($_POST['login'])) {
	if(login_user($_POST['login'],$_POST['password'])){
		// weryfikacja udana: przekierowanie do panelu opiekuna
		header('location:userpanel.php');
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
					 <a href="index.php" class="logo">
						<h1>Wyposażenie laboratorium</h1>
					</a>
				</div>
			</div>
		</div>
		<div class="row">	
			<form method="post" class="container-md">			
				<h3>Zaloguj się</h3>
				<div class="mb-3">
					<label for="login" class="form-label">Login</label>
					<input type="login" name="login" class="form-control" id="login"/>
				</div>
				<div class="mb-3">
					<label for="password" class="form-label">Hasło</label>
					<input type="password" name="password" class="form-control" id="password">
				</div>
				<?php	
					if(isset($_SESSION['login_message'])){
						echo "<div class='alert alert-danger' role='alert'>".$_SESSION['login_message']."</div>";
						unset($_SESSION['login_message']);
					} 
				?>
				<input type="submit" class="btn btn-primary" value="Zaloguj się">		  
			</form>
		</div>
	</div>
</body>
</html>
