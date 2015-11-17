<title>Gottesdienste eintragen</title>

Gottesdienste eintragen:<br>
("1.2.-Kommentar, 2.2., 3.3.-kein Kommentar")<br>
(zuerst zur&uuml;cksetzen!)<br><br>

<form method='post'>
<input type='text' name='dates' placeholder='Daten'/>
<input type='submit' value='submit'/>
</form>
Datum f&uuml;r &Uuml;berschrift:<br>
<form method='post'>
<input type='text' name='von' placeholder='von'/>
<input type='text' name='bis' placeholder='bis'/>
<input type='submit' value='submit'/>
</form>

<?php
include_once 'dbconnect.php';
$oDB = new DBconnect();

if(isset($_POST['dates'])){

	$dates = explode(',', $_POST['dates']);

	$datesTrim = array();
	$comments = array();

	foreach ($dates as $date) {
		$mass = explode('-', $date);
		echo "<br>$date";
		$datesTrim[] = trim($mass[0]);
		$comment = "";
		if(isset($mass[1])) {
			$comment = trim($mass[1]);
		}
		$comments[] = $comment;
	}

	$oDB->saveDates($datesTrim, $comments);

}

if(isset($_POST['von'])){

	$oDB->saveVonBis($_POST['von'], $_POST['bis']);

	echo "<br>" . $_POST['von'];
	echo "<br>" . $_POST['bis'];



}

?>

<p><a style="text-decoration: none; color: blue;" href=".">back</a></p>
