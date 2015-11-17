<?php
include_once 'dbconnect.php';
$oDB = new DBconnect();

if(isset($_POST['save'])) {

	$req = $_REQUEST;

	unset($req['save']);

	$oDB->resetAbsent();

	foreach (array_keys($req) as $param) {
		$parArr = explode("-", $param);
		$oDB->setMiniAbsentOn($parArr[1], $parArr[0]);
	}

	// 	echo "<a href='./showPlan.php'>Plan anzeigen</a>";

}

?>
<head><title>Abwesenheiten</title></head>
<form method='post'>
<table>
<tr>
<!-- >th>id</th-->
<th>Datum</th>
<th>Kommentar</th>
<th>|</th>

<?php
$minis = $oDB->getMinis();

$nMinis = 0;

foreach($minis as $mini) {
	echo "<th>"
		. $mini->name
		. "</th>";

	$nMinis++;

}
?>
</tr>
<?php
$masses = $oDB->getDates();

foreach($masses as $mass):
	echo "<tr>"
// 			<td>" . $mass->id . "</td>
			. "<td>" . $mass->date . "</td>
			<td>" . $mass->comment . "</td>
			<td>|</td>";
	foreach($minis as $mini) {
		echo "<td>
		<input type='checkbox' name='" . $mass->id . "-" . $mini->name . "' ";
		if($oDB->isAbsent($mini->name, $mass->date)) {
			echo "checked";
		}
		echo ">
		</td>";



	}


endforeach;?>

</table>
<input type='submit' value='Abwesenheiten speichern' name='save'>
</form>


<p><a style="text-decoration: none; color: blue;" href=".">back</a> without saving</p>


