<title>Verteilung</title>

<?php
include_once 'dbconnect.php';
$oDB = new DBconnect(); ?>
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
<th>|</th>
<th>alle</th>
<th>|</th>
<th>Summe</th>

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
		if($oDB->isAbsent($mini->name, $mass->date)) {
			echo "<td>--</td>";
		} else {
			echo "<td>
			<input type='checkbox' name='" . $mass->id . "-" . $mini->name . "' onclick='increment(this, \"" . $mini->name . "\", \"" . $mass->id . "\")'>
			</td>";
		}

	}
	echo "<td>|</td><td>
		<input type='checkbox' name='" . $mass->id . "-alle'>
		</td>
		<td>|</td><td>
		<p id='sum_" . $mass->id . "'>0</p>
		</td> </tr>";

endforeach;?>

<tr><td colspan = 3 >Summe:</td>
<?php
foreach($minis as $mini) {
	echo "<td><p id='sum_" . $mini->name . "'>0</p></td>";
}
?>
</tr>


</table>
<input type='submit' value='save setting' name='save'>
</form>

<?php

if(isset($_POST['save'])) {

	$req = $_REQUEST;

	unset($req['save']);

	$oDB->resetMinis();

	foreach (array_keys($req) as $param) {
		$parArr = explode("-", $param);
		$oDB->setMini($parArr[1], $parArr[0]);

	}

	echo "<a href='./showPlan.php'>Plan anzeigen</a>";

}

?>


<p><a style="text-decoration: none; color: blue;" href=".">back</a> without saving</p>


<script type="text/javascript">
	function increment(checkbox, name, massid) {

		var plusminus;
		if(checkbox.checked) {
			plusminus = 1;
		} else {
			plusminus = -1;
		}

		var id = "sum_" + name;
		document.getElementById(id).innerHTML = parseInt(document.getElementById(id).innerHTML) + plusminus;

		var id = "sum_" + massid;
		document.getElementById(id).innerHTML = parseInt(document.getElementById(id).innerHTML) + plusminus;


	}

</script>

