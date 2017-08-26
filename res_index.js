/*
function WelcomeMessage(){
			//alert("TESZT");
            $("#msg").fadeIn('middle');
            $("#msg").animate({opacity: 1.0}, 2000);
            $("#msg").fadeOut(1000);
}
*/
/*
function ChangeColor(){
	var BannerTable = document.getElementById("myself");
	alert("Kurva anyádat akkor!");
	BannerTable.style.backgroundColor = 'green';
}
*/
$(document).ready(function(){

$("#slideshow > div:gt(0)").hide();

setInterval(function() { 
  $('#slideshow > div:first')
    .fadeOut(2000)
    .next()
    .fadeIn(2000)
    .end()
    .appendTo('#slideshow');
},  4000);

});

function openLoginWindow(){
	loginWindow = window.open("bejelentkezes.php", "Bejelentkezés", "width=690, height=600, status=no, menubar=no, scrollbar=no, resizable=no, toolbar=no, location=no" );
	loginWindow.onresize = function() {
		
		loginWindow.resizeTo(690,600);
	}
    loginWindow.focus();
}
function closeLoginWindow(){
	loginWindow.close();
}
function openRegWindow(){
	RegWindow = window.open("regisztracio.php", "Regisztráció", "width=690, height=580, status=no, menubar=no, scrollbar=no, resizable=no, toolbar=no, location=no" );
}

/*
$(document).ready(function(){
//alert("Kurva anyádat akkor!");
   $("#msg").hide();
   function WelcomeMessage();	
});
*/
/*
window.onload = function(){
function WelcomeMessage();	
}
*/

