<form method="post">
<input type='submit' name='reset' value='reset Godis'>
</form>


<?php
include_once 'dbconnect.php';
$oDB = new DBconnect();

if(isset($_POST['reset'])) {
	echo 'Godis zurueckgesetzt';
	$oDB->resetGodis();
	
	
}