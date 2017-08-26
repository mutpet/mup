 $(document).ready(function(){

	$("#teszt").hide();
   
   });
function showMessage(message){
	alert('Meghivodott a függvényem!');
	$("p").fadeOut();
	$("#teszt").fadeOut();	
	var v = message;
	console.log(v);
$("#teszt").html(v);
$("#teszt").fadeIn('middle');
$("#teszt").animate({opacity: 1.0}, 2000);
$("#teszt").fadeOut(2000);	
}