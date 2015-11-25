<?php
include_once 'dbconnect.php';
$oDB = new DBconnect();
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


<title>Verteilung</title>
<link rel="stylesheet" href="css/mini.css">
<body>

<form method='post'>
<table>
<tr>
<!-- >th>id</th-->
<th>Datum</th>
<th>Kommentar</th>
<th>|</th>

<?php
$minisSum = array();
$minis = $oDB->getMinis();

$nMinis = 0;

foreach($minis as $mini) {
	echo "<th>"
		. $mini->name
		. "</th>";

	$nMinis++;

	$minisSum[$mini->name] = 0;
}
?>
<th>|</th>
<th>alle</th>
<th>|</th>
<th>Summe</th>
<th>|</th>
<th> Datum</th>

</tr>
<?php
$masses = $oDB->getDates();


foreach($masses as $mass):
	$summe = 0;
	$setMinis = $oDB->getMinisOfMass($mass->id);
// var_dump($setMinis);
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
			<input type='checkbox' name='" . $mass->id . "-" . $mini->name . "' onclick='increment(this, \"" . $mini->name . "\", \"" . $mass->id . "\") '";

			if(in_array($mini->name, $setMinis)) {
				echo "checked";
				$minisSum[$mini->name]++;
				$summe++;
			}

			echo ">
			</td>";
		}

	}
	echo "<td>|</td><td>
		<input type='checkbox' name='" . $mass->id . "-alle' onclick='showalle(this, \"" . $mass->id . "\")'";
		if(in_array("alle", $setMinis)) {
			echo "checked";
			$summe = 6;
		}
		echo ">
		</td>
		<td>|</td><td>
		<p class='anzahlKlasse$summe' id='sum_" . $mass->id . "'>$summe</p>
		</td> <td>|</td> <td>" . $mass->date . "</td> </tr>";

endforeach;?>

<tr><td colspan = 2 >Summe:</td><td>|</td>
<?php
foreach($minis as $mini) {
	echo "<td><p class='summenKlasse" . $minisSum[$mini->name] . "' id='sum_" . $mini->name . "'>" . $minisSum[$mini->name] . "</p></td>";
}
?>
<td>|</td><td colspan = 5 />
</tr>

<tr>
<!-- >th>id</th-->
<th><th>
<th>|</th>
<?php foreach($minis as $mini) {
	echo "<th>"
		. $mini->name
		. "</th>";

	$nMinis++;

	$minisSum[$mini->name] = 0;
}
?>
<th>|</th>

</tr>


</table>
<input type='submit' value='save setting' name='save'>
</form>



<p><a style="text-decoration: none; color: blue;" href=".">back</a> without saving</p>

</body>

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
		document.getElementById(id).className = 'summenKlasse' + parseInt(document.getElementById(id).innerHTML);

		var id = "sum_" + massid;
		document.getElementById(id).innerHTML = parseInt(document.getElementById(id).innerHTML) + plusminus;
		document.getElementById(id).className = 'anzahlKlasse' + parseInt(document.getElementById(id).innerHTML);
	}


	function showalle(checkbox, massid) {
		var id = "sum_" + massid;
		if(checkbox.checked) {
			document.getElementById(id).className = 'anzahlKlasse6';
		} else {
			document.getElementById(id).className = 'anzahlKlasse' + parseInt(document.getElementById(id).innerHTML);
		}
	}


</script>

