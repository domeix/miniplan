<style>
	html {
		font-family: sans-serif;
	}
	
	


</style>




<h3>Aktueller Miniplan</h3>

<?php
include_once 'dbconnect.php';
$oDB = new DBconnect();


$godis = $oDB->getDates();

foreach ($godis as $godi){
	echo "<h4>" . $godi->date . "</h4>";
	if($godi->comment != "") {
		echo "<h5>" . $godi->comment . "</h5>";
	}
	
	$minis = substr($godi->minis,0, strlen($godi->minis)-2);
	echo $minis;
}