<!DOCTYPE html>
<html>
<body>

<p>Click the button to display the date.</p>

<button onclick="incrementB()">The time is?</button>

<script>
function displayDate() {
    document.getElementById("demo").innerHTML = Date();
}

function incrementB() {
    document.getElementById("demo").innerHTML = Date();
	document.getElementByID("demo").innerHTML = Date();	//TODO

}


</script>

<p id="demo"></p>

</body>
</html> 