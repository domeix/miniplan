<form method="post">
<input type='submit' name='resetGD' value='reset Godis'>
</form>
<form method="post">
<input type='submit' name='resetAB' value='reset Abwesenheiten'>
</form>


<?php
include_once 'dbconnect.php';
$oDB = new DBconnect();

if(isset($_POST['resetGD'])) {
	echo 'Godis zurueckgesetzt';
	$oDB->resetGodis();
}

if(isset($_POST['resetAB'])) {
	echo 'Abwesenheiten zurueckgesetzt';
	$oDB->resetAbsent();
}
?>

<p><a style="text-decoration: none; color: blue;" href=".">back</a></p>
