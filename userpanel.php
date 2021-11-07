<?php
// strona początkowa dla zalogowanych użytkowników strony (opiekunów) 
// wyświetlane są wszystkie elementy wyposażenia laboratorium 
// oraze menu z funkcjami dostępnymi dla zalogowanych
session_start();
// jeżeli użytkownik nie jest zalogowany to nie ma dostępu do tej strony
if(!isset($_SESSION['logged_user'])) {
	header("Location: index.php");
}
// dodanie paczki z funkcjami interaktywnymi z bazą danych 
include('functions.php');
?>
<!DOCTYPE HTML>
<html lang = "pl">
<head>
<title>Laboratorium</title>
	<meta charset="utf-8" />
	
	<META NAME=KEYWORDS CONTENT="laboratorium,phplab,inwentaryzacja">
	<META NAME=DESCRIPTION CONTENT="Laboratorium">
	<META NAME= "author" CONTENT= "Marianna Grabowska">
	
	<link rel="stylesheet" type="text/css" href="style/print.css" media="print" />
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
						<a class="nav-link active" href="userpanel.php">Przeglądaj wyposażenie</a>
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
						<a class="nav-link" href="userchangepassword.php">Zmień hasło</a>
					</li>
				</ul>
			</div>
		</nav>
		<div id="tags">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div class="container-fluid">
					<a class="navbar-brand" href="#">Lista tagów</a>  
					<form method="post">	
						<input type="submit" name="tag" value="wszystko" class="btn btn-outline-primary btn-sm" />
						<?php display_tags(); ?>
					</form>
				</div>
			</nav>
		</div>		
		<div class="container">
			<div class="row row-cols-3">
				<?php 
					if(isset($_POST['tag'])){
						display_item($_POST['tag']);
					}else{
						display_item('wszystko');
					}
				?>
			</div>
		</div>
  </body>
</html>
