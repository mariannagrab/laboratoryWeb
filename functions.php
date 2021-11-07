<?php 
/**
 * 
 * Funkcje potrzebne do wyświetlania, zmieniania, usuwanie obiektów z bazy danych:
 */
/**
 *
 * Logowanie uzytkownika na stronę 
 *
 * @param    podane przez uzytownika w formularzu $login i $hasło
 * @return      bool
 *
 */
function login_user(string $user=null,string $pass=null):bool{	
	// jeżeli któreś z pól nie jest wypełnione wyświetlony zostanie komunikat 
	if(empty($user) || empty($pass)) {
		$_SESSION['login_message'] = 'Wszystkie pola są wymagane!';
		return false;
	} else {
		require 'connection.php';
		// zabezpieczenie przeciwko wstrzykiwaniu SQL
		$pass = trim($pass);
		$pass = htmlentities($pass, ENT_QUOTES, "UTF-8");
		$user = htmlentities($user, ENT_QUOTES, "UTF-8");
		try{
			// połączenie z bazą
			$dbh = new PDO('mysql:host='.$host.';dbname='.$db_name.';charset=utf8', $db_user, $db_password);
			
			// wyszukiwanie użytkowników o podanym loginie
			$query = $dbh->prepare("SELECT haslo FROM uzytkownicy WHERE login=?");
			$query->execute(array($user));
			$row = $query->fetch();
			
			// zamknięcie połączenia z bazą przez skasowanie obiektu
			$dbh = null;
		}catch(PDOException $e){
			echo '<span style="color:red;">Błąd serwera.</span>';
		}
		// weryfikacja hasła (hasła przechowywane w bazie zostały zahashowane algorytmem Argon2id)
		if(password_verify($pass , $row['haslo'])) {
		  $_SESSION['logged_user'] = $user;
		  return true;
		} else {
			// weryfikacja nieudana: komunikat o nieprawidłowym haśle lub loginie
		  $_SESSION['login_message'] = "Niepoprawny login lub hasło";
		  unset($_SESSION['logged_user']);
		  return false;
		}
	}
}
/**
 *
 * Wyświetlenie tagów z bazy danych w formie przycisków na górnym pasku
 *
 *
 */
function display_tags():void{	
	try{
		require 'connection.php';
		$dbh = new PDO('mysql:host='.$host.';dbname='.$db_name.';charset=utf8', $db_user, $db_password);
		
		// wszystkie tagi	
		$query = "SELECT slowo FROM tag";
		
		$result = $dbh->query($query);
		$rows = $result->fetchAll(PDO::FETCH_ASSOC);
		
		// zamknięcie połączenia z bazą przez skasowanie obiektu
		$dbh = null;
	}catch(PDOException $e){
			echo '<span style="color:red;">Błąd serwera.</span>';
	}	
	// wyświetlanie każdego tagu jako oddzielny przycisk
	foreach ($rows as $row){ ?>
		<input type="submit" name="tag" value="<?=$row['slowo']?>" class="btn btn-outline-dark btn-sm" />

		<?php
	}; 
}
/**
 *
 * Wyświetlenie dostępnych przedmiotów z bazy danych należących do odpowiednich tagów
 *
 * @param    slowo z tabeli tag
 *
 */
function display_item(string $tag=null):void{

	// połączenie w celu pobrania produktów z bazy danych
	try{
		require "connection.php";
		$dbh = new PDO('mysql:host='.$host.';dbname='.$db_name.';charset=utf8', $db_user, $db_password);
		
		// jeżeli został wciśnięty tag 'wszystko' to nie ograniczamy rezultatu z tabeli element
		if($tag=='wszystko'){
			$query = "SELECT id,nazwa,model,fotografia,opis,url,liczba_sztuk FROM element";
		}else{
			$query = "SELECT id,nazwa,model,fotografia,opis,url,liczba_sztuk FROM element WHERE id IN (SELECT element_id FROM element_tag WHERE tag_id IN (SELECT id FROM tag WHERE slowo IN ('".$tag."')))";
		}
		
		$result = $dbh->query($query);
		$rows = $result->fetchAll(PDO::FETCH_ASSOC);
		
		// zamknięcie połączenia z bazą przez skasowanie obiektu
		$dbh = null;
	}catch(PDOException $e){
		echo '<span style="color:red;">Błąd serwera.</span>';
	}
	
	// wyświetlanie każdego elementu wyposażenia
	foreach ($rows as $row){ ?>
		<div class='container col-sm-4'>
			<div class="image">
				<img src="images/<?= $row["fotografia"]?>.jpg" class="border border-primary rounded" width="200" height="250">
			</div>
			<div class='nazwa'><?=$row['nazwa']?></div>
			<div class='model'>Model: <?=$row['model']?></div>
			<div class='opis'>Opis: <?=$row['opis']?></div>
			<a href="<?=$row['url']?>">Strona producenta</a>
			<div class='liczba_sztuk'>Liczba sztuk: <?= $row['liczba_sztuk']?></div>
		</div>
		<?php
	}; 
};
/**
 *
 * Wyświetlenie pozostałych informacji o zalogowanym użytkowniku
 *
 * @param    login zalogowanego użytkownika
 *
 */
function display_user(string $input=null):void{
require "connection.php";
	if(is_null($input)){
		return;
	}
	// połączenie w celu pobrania produktów z bazy danych
	try{
		$dbh = new PDO('mysql:host='.$host.';dbname='.$db_name.';charset=utf8', $db_user, $db_password);
		$query = "SELECT id,login,imie,nazwisko,email,haslo FROM uzytkownicy WHERE login = '".$input."' LIMIT 1";		
		$result = $dbh->query($query)->fetch();		
		// zamknięcie połączenia z bazą przez skasowanie obiektu
		$dbh = null;
	}catch(PDOException $e){
		echo '<span style="color:red;">Błąd serwera.</span>';
	}
	?>
		<div class='col-sm-4'>							
			<div class='userinfo'>Login:   	<?=$result['login']?></div>			
			<div class='userinfo'>Imię:    	<?=$result['imie']?></div>
			<div class='userinfo'>Nazwisko: <?=$result['nazwisko']?></div>
			<div class='userinfo'>Email:    <?=$result['email']?></div>									
		</div>
	<?php
	 
};
/**
 *
 * Zmiana hasła w bazie danych dla zalogowanego użytkownika + walidacja czy hasła są takie same
 *
 * @param    $pass $pass2 z formularza
 *
 */
function change_password(string $pass=null,string $pass2=null):void{
require "connection.php";
	
	// jeżeli któreś z pól nie jest wypełnione wyświetlony zostanie komunikat 
	if($pass != $pass2) {
		$_SESSION['error_message'] = 'Hasła powinny być takie same';
	} else {
		
		// zabezpieczenie przeciwko wstrzykiwaniu SQL
		$pass = trim($pass);
		$pass = htmlentities($pass, ENT_QUOTES, "UTF-8");
		$pass = password_hash($pass, PASSWORD_DEFAULT);

		// połączenie z bazą
		$dbh = new PDO('mysql:host='.$host.';dbname='.$db_name.';charset=utf8', $db_user, $db_password);
		$query = "UPDATE uzytkownicy SET haslo=:password WHERE login = :login";
		// prepare statement
		$statement = $dbh->prepare($query);
		$statement->bindParam(':password',$pass);
		$statement->bindParam(':login',$_SESSION['logged_user']);
		// gdy execute zwraca true tabela została zupdatowana, użytkownikowi zostanie wyświetlony komunikat
		if ($statement->execute()) {
			$_SESSION['changep_suc_message'] = 'Hasło zostało zmienione';
		}else{
			$_SESSION['changep_fail_message'] = 'Hasło nie zostało zmienione, spróbuj później';
		}		
	}
};
/**
 *
 * Wyświetlenie dostępnych elementów w laboratorium gotowych do edycji, wraz z przyciskami usuń i zmień
 *
 *
 */
function display_edit_item():void{ 
	require 'connection.php';
	try{
		$dbh = new PDO('mysql:host='.$host.';dbname='.$db_name.';charset=utf8', $db_user, $db_password);		
		// zapytanie o wszystkie dostępne elementy wyposażenia
		$query = "SELECT id,nazwa ,model,fotografia ,opis ,url, liczba_sztuk FROM element";		
		$result = $dbh->query($query);
		$rows = $result->fetchAll();
		// zamknięcie połączenia z bazą przez skasowanie obiektu
		$dbh = null;				
	}catch(PDOException $e){
		echo '<span style="color:red;">Błąd serwera.</span>';
	}
	foreach ($rows as $row){ ?>
		<form method="post">
			<tr>
				<td  style="width: 50px;">
					<input type="text" class="form-control" value="<?=$row['id']?>" readonly>
				</td>
				<input type="hidden" name="hidden_id" value="<?=$row['id']?>" />
				<td  style="width: 250px;">
					<input class="form-control" type="text" name="nazwa" value="<?=$row['nazwa']?>">
				</td>
				<td>
					<input class="form-control form-control" type="text" style="width: 80px;" name="model" value="<?=$row['model']?>">
				</td>
				<td>
					<input class="form-control form-control" type="text" style="width: 100px;"name="fotografia" value="<?=$row['fotografia']?>">
				</td>		
				<td>
					<input class="form-control form-control" type="text" style="width: 50px;" name="liczba_sztuk" value="<?=$row['liczba_sztuk']?>">
				</td>
			</tr>
			<tr>
				<td></td>
				<td>Opis:</td>
				<td colspan="3"><input class="form-control form-control" type="text" name="opis" value="<?=$row['opis']?>"></td>
			</tr>
			<tr class="border_bottom">
				<td></td>
				<td>Url:</td>
				<td colspan="3">
					<input class="form-control form-control" type="text" name="url" value="<?=$row['url']?>">
				</td>
				<td>
					<input type="submit" name="add" value="Zmień" class="btn btn-secondary btn-sm" />
				</td>
				<td>
					<input type="submit" name="delete" value="Usuń" class="btn btn-danger btn-sm" />
				</td>
			</tr>		
		</form>
		<?php
	};	
}
/**
 *
 * Wyświetlenie dostępnych tagów z bazy danych w formie listy select option
 *
 *
 */
function choose_tag():void{ 
	require 'connection.php';
	// połączenie w celu pobrania produktów z bazy danych
	try{
		$dbh = new PDO('mysql:host='.$host.';dbname='.$db_name.';charset=utf8', $db_user, $db_password);
		
		// zapytanie o wszystkie dostępne tagi
		$query = "SELECT id,slowo FROM tag";
		
		$result = $dbh->query($query);
		$rows = $result->fetchAll();
		// zamknięcie połączenia z bazą przez skasowanie obiektu
		$dbh = null;				
	}catch(PDOException $e){
		echo '<span style="color:red;">Błąd serwera.</span>';
	}
	foreach ($rows as $row){
		echo '<option ';  
		// jeżeli wartość z option będzie wybrana powinna zostać w polu (selected=true)

		if (filter_input(INPUT_POST, 'tags', FILTER_SANITIZE_STRING) == $row['id']) { 
			echo 'selected="true" '; 
		}; 
		echo 'value="'.$row['id'].'">'.$row['slowo']."</option>";	
	}
}
/**
 *
 * Wyświetlenie dostępnych elementów wyposażenia w tabeli 
 * wraz z przyciskami usuwającymi i dodającymi tag zaczynając od tych co mają tag_id 
 *
 * @param    $tag_id id z tabeli tag
 *
 */
function display_item_tag_edit(int $tag_id=null) :void{
require 'connection.php';
	try{
		$dbh = new PDO('mysql:host='.$host.';dbname='.$db_name.';charset=utf8', $db_user, $db_password);
		
		// zapytanie o wszystkie dostępne elementy wyposażenia początkowo wyświetlając te z wybranym tagiem
		$query = "SELECT id,nazwa,opis FROM element ORDER BY (id IN (SELECT element_id FROM element_tag WHERE tag_id IN (".$tag_id."))) DESC";		
		$result = $dbh->query($query);
		$rows = $result->fetchAll();
		// zamknięcie połączenia z bazą przez skasowanie obiektu
		$dbh = null;				
	}catch(PDOException $e){
		echo '<span style="color:red;">Błąd serwera.</span>';
	}
	//counter
	$count = 1;
	$counttagentries = count_tag($tag_id);
	foreach ($rows as $row){ ?>
		<form method="post">
			<tr>
				<td>
					<input type="text" class="form-control form-control" style="width: 50px;" name="id" value="<?=$row['id']?>" readonly>
				</td>		
				<td><p><?=$row['nazwa']?></p></td>
				<td><p><?=$row['opis']?></p>
				</td>	
		<?php 
			if($count > $counttagentries){ 
		?>
				<td><input type="submit" name="add" value="Dodaj tag" class="btn btn-secondary btn-sm" /></td>
		<?php 
			}else{ 
		?>
				<td><input type="submit" name="delete" value="Usuń tag" class="btn btn-danger btn-sm" /></td>
		<?php 
			} 
		?>
			</tr>		
		</form>
		<?php
		$count +=1;
	};
}
/**
 *
 * Ile jest elementów wyposażenia z tagiem tag_id
 *
 * @param    $tag_id id z tabeli tag
 * @return   liczba elementów
 *
 */
function count_tag(int $tag_id):int{
require 'connection.php';
	try{
		$dbh = new PDO('mysql:host='.$host.';dbname='.$db_name.';charset=utf8', $db_user, $db_password);
		$query = "SELECT COUNT(*) FROM element_tag WHERE tag_id IN (".$tag_id.")";		
		$result = $dbh->query($query);
		$nrows = $result->fetchColumn();
		$dbh = null;				
	}catch(PDOException $e){
		echo '<span style="color:red;">Błąd serwera.</span>';
	}
	return $nrows;
}
/**
 *
 * update, zmiana parametrów (nazwa, model, opis, url, fot, liczby dostępnych sztuk) elementu wyposażenia w bazie danych
 *
 */
function upsert_in_db():void{
	require 'connection.php';
	// sprawdzenie czy nowo ustawiona liczba sztuk jest większa niż zero, gdy jest = 0 element powinien być usunięty
	if(intval($_POST['liczba_sztuk']) <= 0){
		$_SESSION['upsert_message'] = 'Liczba sztuk powinna być większa niż zero';
		return;
	}
	try{			
		$dbh = new PDO('mysql:host='.$host.';dbname='.$db_name.';charset=utf8', $db_user, $db_password);			
		// update tabeli element
		$query = "UPDATE element SET nazwa =:nazwa, model =:model, opis =:opis , url =:url, liczba_sztuk =:liczba_sztuk WHERE id=:id";
		$statement = $dbh->prepare($query);
		// sukces - funkcja execute zwraca true
		if($statement->execute(array(':nazwa' => $_POST['nazwa'],':model' => $_POST['model'],':opis' => $_POST['opis'],':url' => $_POST['url'],':liczba_sztuk' => $_POST['liczba_sztuk'],':id' => $_POST['hidden_id']))){			
			$_SESSION['upsert_suc_message'] = 'Zmieniono wiersz!';			
		}else{
			$_SESSION['upsert_fail_message'] = 'Nie udało się zmienić wiersza';
		}
		$dbh = null;
		}
	catch(PDOException $e){
		echo '<span style="color:red;">Błąd serwera.</span>';
	}
}
/**
 *
 * Dodanie tagu do elementu wyposażenia (update tabeli element_tag)
 *
 * @param    id elementu, id tagu
 *
 */
function add_tag(int $element_id,int $tag_id):void{
	require 'connection.php';	
	try{			
			$dbh = new PDO('mysql:host='.$host.';dbname='.$db_name.';charset=utf8', $db_user, $db_password);
			
			// nowe połączenie tagu z elementem - insert tabeli element_tag
			$query = "INSERT INTO element_tag (element_id, tag_id) VALUES (:element_id, :tag_id)";		
			$statement = $dbh->prepare($query);
			
			// sukces - funkcja execute zwraca true
			if($statement->execute(array(':element_id' => $element_id,':tag_id' => $tag_id))){			
				$_SESSION['tag_suc_message'] = 'Dodano tag!';
			}else{
				$_SESSION['tag_fail_message'] = 'Dodanie tagu się nie udało';
			}
			$dbh = null;
		}
	catch(PDOException $e){
		echo '<span style="color:red;">Błąd serwera.</span>';
	}
}
/**
 *
 * Usunięcie tagu z elementu wyposażenia (delete na tabeli element_tag)
 *
 * @param    id elementu, id tagu do usunięcia
 *
 */
function delete_tag(int $element_id,int $tag_id):void{
	require 'connection.php';	
	try{			
			$dbh = new PDO('mysql:host='.$host.';dbname='.$db_name.';charset=utf8', $db_user, $db_password);
			$query = "DELETE FROM element_tag WHERE element_id=:element_id AND tag_id = :tag_id";			
			$statement = $dbh->prepare($query);
			if($statement->execute(array(':element_id' => $element_id,':tag_id' => $tag_id))){			
				$_SESSION['tag_suc_message'] = 'Usunięto tag!';
			}else{
				$_SESSION['tag_fail_message'] = 'Usunięcie tagu się nie udało';
			}
			$dbh = null;
		}
	catch(PDOException $e){
		echo '<span style="color:red;">Błąd serwera.</span>';
	}
}
/**
 *
 * Usunięcie elementu wyposażenia z tabeli element, element_tag, wypożyczenia
 *
 *
 */
function delete_in_db():void{
	try{
		require 'connection.php';
		
		$dbh = new PDO('mysql:host='.$host.';dbname='.$db_name.';charset=utf8', $db_user, $db_password);
		
		// usuwanie z tabeli element
		$query = "DELETE FROM element WHERE id=:id";
		$statement = $dbh->prepare($query);
		$statement->execute(array(':id' => $_POST['hidden_id']));
		if(($statement->rowCount())>0){
			$_SESSION['upsert_suc_message'] = 'Poprawnie usunięto element z bazy.';
		}else{
			$_SESSION['upsert_fail_message'] = 'Nie udało się usunąć elementu, spróbuj później.';
		}		
		// usuwanie z tabeli element_tag
		$query2 = "DELETE FROM element_tag WHERE element_id=:id";
		$statement2 = $dbh->prepare($query2);
		$statement2->execute(array(':id' => $_POST['hidden_id']));
		
		// usuwanie z tabeli wypozyczenia
		$query3 = "DELETE FROM wypozyczenia WHERE element_id=:id";
		$statement3 = $dbh->prepare($query3);
		$statement3->execute(array(':id' => $_POST['hidden_id']));
		
		$dbh = null;		
		
	}catch(PDOException $e){
		echo '<span style="color:red;">Błąd serwera.</span>';
	}
}
/**
 *
 * Wyświetlenie wypożyczeń w tabeli
 *
 */
function display_rent():void{
	try{
		require 'connection.php';
		
		$dbh = new PDO('mysql:host='.$host.';dbname='.$db_name.';charset=utf8', $db_user, $db_password);
		// połączenie tabeli uzytkownicy, wypozyczenia, element
		$query = "SELECT
			uzytkownicy.imie,
			uzytkownicy.nazwisko,
			element.nazwa,
			wypozyczenia.ilosc
				FROM uzytkownicy
			JOIN wypozyczenia
				ON wypozyczenia.uzytkownik_id = uzytkownicy.id
			JOIN element
				ON element.id = wypozyczenia.element_id";
		$result = $dbh->query($query);
		$rows = $result->fetchAll();
		$dbh = null;		
		
	}catch(PDOException $e){
		echo '<span style="color:red;">Błąd serwera.</span>';
	} 
	foreach ($rows as $row){ ?>
		 <tr>
			<td><p><?=$row['imie']?></p></td>		
			<td><p><?=$row['nazwisko']?></p></td>
			<td><p><?=$row['nazwa']?></p></td>	
			<td><p><?=$row['ilosc']?></p></td>	
		</tr>
		<?php 
	}
}
/**
 *
 * Wyświetlenie elementów wyposażenia w tabeli do raportu
 *
 */
function display_items_report():void{
	try{
		require 'connection.php';		
		$dbh = new PDO('mysql:host='.$host.';dbname='.$db_name.';charset=utf8', $db_user, $db_password);		
		$query = "SELECT id,nazwa,model, liczba_sztuk FROM element";
		$result = $dbh->query($query);
		$rows = $result->fetchAll();
		$dbh = null;		
		
	}catch(PDOException $e){
		echo '<span style="color:red;">Błąd serwera.</span>';
	} 
	foreach ($rows as $row){ ?>
		 <tr>
		<td><p><?=$row['id']?></p></td>		
		<td><p><?=$row['nazwa']?></p></td>
		<td><p><?=$row['model']?></p></td>	
		<td><p><?=$row['liczba_sztuk']?></p></td>	
		</tr>
		<?php 
	}
}
/**
 *
 * Walidacja pola formularza login przy dodawaniu użytkownika 
 * @return   bool (true jeżeli nowy login jest poprawny)
 *
 */
function validate_login(string $login=null):bool{
	try{
		require 'connection.php';		
		$dbh = new PDO('mysql:host='.$host.';dbname='.$db_name.';charset=utf8', $db_user, $db_password);
		$query = "SELECT count(*) FROM uzytkownicy WHERE login = '".$login."'";
		$result = $dbh->query($query);
		$nrows = $result->fetchColumn();
		$dbh = null;		
		
	}catch(PDOException $e){
		echo '<span style="color:red;">Błąd serwera.</span>';
	} 
	return ($nrows == 0);
}
/**
 *
 * Dodanie nowego użytkownika do bazy danych
 *
 */
function add_user(string $login, string $imie, string $nazwisko, string $email, string $haslo, int $status):void{
	try{
		require 'connection.php';
		
		$dbh = new PDO('mysql:host='.$host.';dbname='.$db_name.';charset=utf8', $db_user, $db_password);
		// zabezpieczenie przed SQL injection
		$login = trim($login);		
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		$imie = trim($imie);
		$imie = htmlentities($imie, ENT_QUOTES, "UTF-8");
		$nazwisko = trim($nazwisko);
		$nazwisko = htmlentities($nazwisko, ENT_QUOTES, "UTF-8");
		$email = trim($email);
		$email = htmlentities($email, ENT_QUOTES, "UTF-8");		
		$haslo = trim($haslo);
		$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");	
		$haslo = password_hash($haslo, PASSWORD_DEFAULT);
		// dodanie w tabeli uzytkownicy
		$query = "INSERT INTO uzytkownicy (`id`, `login`, `imie`, `nazwisko`, `email`, `haslo`, `status`) VALUES (NULL,:login,:imie,:nazwisko,:email,:haslo,:status)";
		$statement = $dbh->prepare($query);
		$statement->execute(array(':login' => $login,':imie' => $imie,':nazwisko' => $nazwisko,':email' => $email,':haslo' => $haslo,':status' => $status));
		// sukces - udało się dodać nowego użytkownika do bazy
		if(($statement->rowCount())>0){
			$_SESSION['add_suc_message'] = 'Poprawnie dodano użytkownika do bazy danych';
		}else{
			$_SESSION['add_message'] = 'Nie udało się dodać użytkownika spróbuj później.';
		}
		$dbh = null;		
		
	}catch(PDOException $e){
		echo '<span style="color:red;">Błąd serwera.</span>';
	} 
}
?>