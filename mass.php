Insert masses: 
<form method='post'>
<input type='text' name='dates'/>
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
