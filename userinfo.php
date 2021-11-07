<?php
// strona dostępna tylko dla zalogowanych opiekunów
// pozwala na dodanie nowego użytkownika do bazy
session_start();
// dodanie paczki z funkcjami interaktywnymi z bazą danych 
include('functions.php');
// jeżeli użytkownik nie jest zalogowany to nie ma dostępu do tej strony
if(!isset($_SESSION['logged_user'])) {
	header("Location: index.php");
}
// walidacja pól formularza przy dodawaniu nowego użytkownika
if(isset($_POST['login'])){
	// walidacja loginu (czy się nie powtarza)
	if(!validate_login($_POST['login'])){
		// komunikat wyświetlany jest użytkownikowi strony gdy należy poprawić pola formularza
		$_SESSION['add_message'] = 'Login już istnieje w bazie danych!';
	// walidacja email
	}elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
		$_SESSION['add_message'] = 'Wprowadź prawidłowy email';
	// login ani hasło nie powinno byc puste	
	}elseif(empty($_POST['login'])){
		$_SESSION['add_message'] = 'Login nie może być pusty!';
	}elseif(empty($_POST['password'])){
		$_SESSION['add_message'] = 'Hasło nie może być puste';
	// dodanie do bazy 
	}else{
		add_user($_POST['login'],$_POST['name'],$_POST['lastname'],$_POST['email'],$_POST['password'],filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING));
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
						<a class="nav-link active" href="userinfo.php">Dodaj użytkownika</a>
					</li>					
					<li class="nav-item px-3">
						<a class="nav-link" href="userchangepassword.php">Zmień hasło</a>
					</li>
				</ul>
			</div>
		</nav>
		<?php
			// wiadomość dla użytkownika na górze strony gdy operacja powiedzie się sukcesem
			if(isset($_SESSION['add_suc_message'])){
				echo "<div class='alert alert-success' role='alert'>".$_SESSION['add_suc_message']."</div>";
				unset($_SESSION['add_suc_message']);
			} 
		?>
		<h3>Zarejestruj nowego użytkownika</h3>
		<form method="post">		
			<div class="mb-3">
				<label for="login" class="form-label">Login</label>
				<input type="login" name="login" class="form-control" id="login">
			</div>
			<div class="mb-3">
				<label for="name" class="form-label">Imię</label>
				<input type="name" name="name" class="form-control" id="name">
			</div>
			<div class="mb-3">
				<label for="lastname" class="form-label">Nazwisko</label>
				<input type="lastname" name="lastname" class="form-control" id="lastname">
			</div>	  
			<div class="mb-3">
				<label for="email" class="form-label">E-mail</label>
				<input type="email" name="email" class="form-control" id="email">
			</div>
			<div class="mb-3">
				<label for="password" class="form-label">Hasło</label>
				<input type="password" name="password" class="form-control" id="password">
			</div>
			<div class="mb-3">
				<label for="password" class="form-label">Rodzaj użytkownika</label>
				<select class="form-select" name="user" aria-label="Rodzaj użytkownika">
					<option value=1>student</option>
					<option value=2>opiekun</option>
				<select>
			</div>
			<?php	
				// wiadomość dla użytkownika gdy operacja się nie powiedzie
				if(isset($_SESSION['add_err_message'])){
					echo "<div class='alert alert-danger' role='alert'>".$_SESSION['add_err_message']."</div>";
					unset($_SESSION['add_err_message']);
				} 
			?>
			<div class="mb-3">
				<input type="submit" class="btn btn-primary btn-lg" value="Dodaj">
			</div>
		</form>
	</div>
  </body>
</html>