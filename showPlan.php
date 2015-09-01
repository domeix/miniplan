<style>
	html {
		font-family: sans-serif;
	}
	
	h4 {
		margin-bottom: 0px;
	}


</style>

<?php
include_once 'dbconnect.php';
$oDB = new DBconnect();


$vb = $oDB->getVonBis();

echo "<h3>Miniplan von " 
	. $vb['von']
	. " bis "
	. $vb['bis']
	. "</h3>";


$godis = $oDB->getDates();

foreach ($godis as $godi){
	echo "<h4>" . $godi->date . "</h4>";
	if($godi->comment != "") {
		echo "<h5>" . $godi->comment . "</h5>";
	}
	
	$minis = substr($godi->minis,0, strlen($godi->minis)-2);
	echo $minis;
}