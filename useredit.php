<?php
// Strona dostępna dla zalogowanych użytkowników pozwalająca na edycję wyposażenia w laboratorium (usuwanie, zmiana)
session_start();
// jeżeli użytkownik nie jest zalogowany to nie ma dostępu do tej strony
if(!isset($_SESSION['logged_user'])) {
	header("Location: index.php");
}
// dodanie paczki z funkcjami interaktywnymi z bazą danych 
include('functions.php');
// wywołanie funkcji zmieniająca rekord w bazie danych po wciśnięciu "Zmień"
if(isset($_POST['add'])){
	upsert_in_db();
}
// wywołanie funkcji usuwającej rekord z bazy danych po wciśnięciu "Usuń"
if(isset($_POST['delete'])){
	delete_in_db();
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
	<link rel="stylesheet" type="text/css" href="style/main.css">

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
						<a class="nav-link active" href="useredit.php">Edytuj wyposażenie</a>
					</li>
					<li class="nav-item px-3">
						<a class="nav-link" href="usertags.php">Edytuj tagi</a>
					</li>					
					<li class="nav-item px-3">
						<a class="nav-link" href="userinfo.php">Dodaj użytkownika</a>
					</li>					
					<li class="nav-item px-3">
						<a class="nav-link" href="userchangepassword.php">Zmień hasło</a>
					</li>
				</ul>
			</div>
		</nav>
		<?php 
			// wiadomość dla użytkownika gdy operacja się uda
			if(isset($_SESSION['upsert_suc_message'])){
				echo "<div class='alert alert-success' role='alert'>".$_SESSION['upsert_suc_message']."</div>";
				unset($_SESSION['upsert_suc_message']);
			};
			// wiadomość dla użytkownika gdy operacja się nie uda
			if(isset($_SESSION['upsert_fail_message'])){
				echo "<div class='alert alert-danger' role='alert'>".$_SESSION['upsert_fail_message']."</div>";
				unset($_SESSION['upsert_fail_message']);
			};
		?>
		<div>
			<table class="table table-sm">
				<thead>
					<tr>
						<th>Id</th>
						<th>Nazwa</th>
						<th>Model</th>
						<th>Fotografia</th>			
						<th>Liczba sztuk</th>			
						<th>Zmień</th>
						<th>Usuń</th>
					</tr>
				</thead>
				<tbody>
				<?php	
				display_edit_item(); 
				?>
				</tbody>
			</table>
		</div>
	</div>	
</body>
</html>