<?php
// Strona dla zalogowanych użytkowników pozwalająca na zmianę hasła
//include('display.php');
session_start();
// jeżeli użytkownik nie jest zalogowany to nie ma dostępu do tej strony
if(!isset($_SESSION['logged_user'])) {
	header("Location: index.php");
}
// dodanie paczki z funkcjami interaktywnymi z bazą danych 
include('functions.php');
// zmiana hasła po wciśnięciu przyciku "zmień hasło"
if(isset($_POST['password'])) {
	change_password($_POST['password'],$_POST['password2']);
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
		<div class='header'>
			<div class="row">
				<div class="col-10">
					<h1>Wyposażenie laboratorium</h1>
				</div>	
				<div class="col-2">
					<a href="logout.php">
						<div class="btn btn-primary btn-lg">
							Wyloguj się
						</div>	
					</a>				
				</div>	
			</div>
		</div>
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary rounded">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<a class="navbar-brand" href="#">Menu</a>
				<span class="navbar-toggler-icon"></span>
			</button> 
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item px-3">
						<a class="nav-link" href="userpanel.php">Przeglądaj wyposażenie</a>
					</li>
					<li class="nav-item px-3">
						<a class="nav-link" href="userreport.php">Raport</a>
					</li>
					<li class="nav-item px-3">
						<a class="nav-link" href="useredit.php">Edytuj wyposażenie</a>
					</li>
					<li class="nav-item px-3">
						<a class="nav-link" href="usertags.php">Edytuj tagi</a>
					</li>					
					<li class="nav-item px-3">
						<a class="nav-link" href="userinfo.php">Dodaj użytkownika</a>
					</li>					
					<li class="nav-item px-3">
						<a class="nav-link active" href="userchangepassword.php">Zmień hasło</a>
					</li>
				</ul>
			</div>
		</nav>	
		<div class='title'>
			<h3>Dane zalogowanego użytkownika:</h3>
		</div>
		<?php 
			display_user($_SESSION['logged_user']); 
		?>		
		<form method="post" class="container-md">
			<div class='title'>
				<h3>Ustaw nowe hasło</h3>
			</div>	
			<?php	
				if(isset($_SESSION['changep_suc_message'])){
					echo "<div class='alert alert-success' role='alert'>".$_SESSION['changep_suc_message']."</div>";
					unset($_SESSION['changep_suc_message']);
				} 
			?>	
			<div class="mb-3">
				<label for="login" class="form-label">Hasło</label>
				<input type="password" name="password" class="form-control" id="password">
			</div>
			<div class="mb-3">
				<label for="password" class="form-label">Powtórz hasło</label>
				<input type="password" name="password2" class="form-control" id="password2">
			</div>
			<?php	
				if(isset($_SESSION['changep_fail_message'])){
					echo "<div class='alert alert-danger' role='alert'>".$_SESSION['changep_fail_message']."</div>";
					unset($_SESSION['changep_fail_message']);
				} 
			?>
			<input type="submit" class="btn btn-primary" value="Zmień hasło">	  
		</form>
	</div>
  </body>
</html>