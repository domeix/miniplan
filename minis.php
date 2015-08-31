Insert minis:
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
