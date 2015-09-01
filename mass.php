Gottesdienste eintragen:<br>
(mit ", " getrennt)<br><br>

<form method='post'>
<input type='text' name='dates' placeholder='Daten'/>
<input type='submit' value='submit'/>
</form>
<form method='post'>
<input type='text' name='von' placeholder='von'/>
<input type='text' name='bis' placeholder='bis'/>
<input type='submit' value='submit'/>
</form>

<?php
include_once 'dbconnect.php';
$oDB = new DBconnect();

if(isset($_POST['dates'])){

	$dates = explode(', ', $_POST['dates']);


	foreach ($dates as $date) {
		echo "<br>$date";
	}

	$oDB->saveDates($dates);

}

if(isset($_POST['von'])){
	
	$oDB->saveVonBis($_POST['von'], $_POST['bis']);
	
	echo "<br>" . $_POST['von'];
	echo "<br>" . $_POST['bis'];
	
	
	
}

?>

<p><a style="text-decoration: none; color: blue;" href=".">back</a></p>
