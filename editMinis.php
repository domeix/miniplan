<?php
include_once 'dbconnect.php';
$oDB = new DBconnect();

if(isset($_POST['delete'])) {
	$oDB->delMini($_POST['mini']);
}

$miniNames = $oDB->getMiniNames();
?>

<form method="post">
<select name='mini'>
<?php foreach ($miniNames as $name) {
	echo "<option>$name</option>";
}?>
</select>
<input type='submit' name='delete' value='Mini loeschen'>
</form>


<p><a style="text-decoration: none; color: blue;" href=".">back</a></p>
