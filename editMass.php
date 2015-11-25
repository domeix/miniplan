<title>Godi bearbeiten</title>
<?php
include_once 'dbconnect.php';
$oDB = new DBconnect();

$godis = $oDB->getDates();
if(isset($_POST['choosegodi'])) {
	$choosen = $_POST['choosegodi'];
} else {
	$choosen = -1;
}
?>

<form method="post">
<select name='choosegodi' onchange='this.form.submit()'>
<?php foreach ($godis as $godi) {
	echo "<option value='" . $godi->id . "'";
	if($choosen == $godi->id) {
		echo "selected";
	}
	echo ">". $godi->date . "</option>";
}?>
</select>
<!-- <input type='submit' name='choose' value='Godi bearbeiten'> -->
</form>

<?php
if(isset($_POST['choosegodi'])) {
	$godi = $oDB->getGodi($_POST['choosegodi']);
?>
<form method="post">
<input type='hidden' name='massid' value='<?php echo $godi->id; ?>'>
<table>
<tr>
<td>Datum:</td>
<td><input type='text' name='datum' value='<?php echo $godi->date; ?>'></td>
</tr><tr>
<td>Kommentar:</td>
<td><input type='text' name='comment' value='<?php echo $godi->comment; ?>'></td>
</tr>
<tr><td>
<input type='submit' name='edit' value='&auml;ndern'>
</td></tr>
</table>
</form>
<?php
}

if(isset($_POST['edit'])) {
	if($oDB->editGodi($_POST['massid'],$_POST['datum'],$_POST['comment'])) {
		echo $_POST['massid'].$_POST['datum'].$_POST['comment']." ge&auml;ndert";
	} else {
		echo "Fehler beim Speichern.";
	}
}

?>
<p><a style="text-decoration: none; color: blue;" href=".">zur&uuml;ck</a></p>
