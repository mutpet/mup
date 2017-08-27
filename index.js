
$(document).ready(function() {

	//A főoldalon megjelenő üzenetek elhalványításos eltüntetése (fade effect)
	$("#error_msg").fadeIn('middle');
	$("#error_msg").animate({opacity: 1.0}, 2000);
	$("#error_msg").fadeOut(2000);	
	
	//A főoldalon lévő image slide-show kódja: (html div -ek alapján működik)
	$("#slideshow > div:gt(0)").hide();
	//A főoldalon lévő image slide-show függvénye
	setInterval(function() { 
	  $('#slideshow > div:first')
      .fadeOut(2000)
      .next()
      .fadeIn(2000)
      .end()
      .appendTo('#slideshow');
    },  4000);

	
});

function openLoginWindow() {
	loginWindow = window.open("bejelentkezes.php", "Bejelentkezés", "width=690, height=600, status=no, menubar=no, scrollbar=no, resizable=no, toolbar=no, location=no" );
	loginWindow.onresize = function() {
		
		loginWindow.resizeTo(690,600);
	}
    loginWindow.focus();
}

function closeLoginWindow() {
	loginWindow.close();
}

function openRegWindow() {
	RegWindow = window.open("regisztracio.php", "Regisztráció", "width=690, height=580, status=no, menubar=no, scrollbar=no, resizable=no, toolbar=no, location=no" );
}


