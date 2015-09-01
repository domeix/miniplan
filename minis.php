Minis eintragen:<br>
(mit ", " getrennt)<br><br>
<form method='post'>
<input type='text' name='minis'/>
<input type='submit' value='submit'/>
</form>

<?php
include_once 'dbconnect.php';
$oDB = new DBconnect();

if(isset($_POST['minis'])){
	
	$minis = explode(', ', $_POST['minis']);
	
	
	foreach ($minis as $mini) {
		echo "<br>$mini";
	}
	
	$oDB->saveMinis($minis);
	
}

?>

<p><a style="text-decoration: none; color: blue;" href=".">back</a></p>
