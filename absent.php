<?php
include_once 'dbconnect.php';
$oDB = new DBconnect();

$miniNames = $oDB->getMiniNames();
?>

Set minis absent:
<form method='post'>
<select name='mininame'>
<?php 
foreach ($miniNames as $name) {
	echo "<option>$name</option>";
}
?>
</select>

<input type='text' name='dates'/>
<input type='submit' value='submit'/>
</form>


<?php
if (isset($_POST['dates'])) {
	$oDB->setMiniAbsent($_POST['mininame'], $_POST['dates']);	
}








