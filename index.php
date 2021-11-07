<?php
// Strona startowa - index.php
// wyświetla wszystkie elementy wyposażenia laboratorium
// strona dostępna dla niezalogowanych gości

session_start();
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
					<a href="loginpage.php">
						<div class="btn btn-primary btn-lg">
							Zaloguj się
						</div>	
					</a>				
				</div>	
			</div>
		</div>	
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
					// wyświetlanie elementów wyposażenia po wybraniu tagu
					if(isset($_POST['tag'])){
						display_item($_POST['tag']);
					// defaultowo wszystkie elementy są wyświetlane
					}else{
						display_item('wszystko');
					}
				?>
			</div>
		</div>
	</div>
  </body>
</html>