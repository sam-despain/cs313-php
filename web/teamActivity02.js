function alertClicked() {
	alert("Clicked!");
}
function changeColor() {
	var textboxID = "color";
	var textbox = document.getElementById(textboxID);
	
	var divID = "c1";
	var div = document.getElementById(divID);
	
	var color = textbox.value;
	div.style.backgroundColor = color;
}