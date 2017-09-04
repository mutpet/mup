function openLoginWindow(){
	loginWindow = window.open("bejelentkezes.php", "Bejelentkezés/Login", "width=750, height=600, status=no, menubar=no, scrollbar=no, resizable=no, toolbar=no, location=no" );
	loginWindow.onresize = function() {
		
		loginWindow.resizeTo(750,600);
	}
    loginWindow.focus();
}

function openForgotPasswordWindow(){
	forgotWindow = window.open("forgotpassword.php", "Elfelejtett jelszó/Forgot Password", "width=750, height=600, status=no, menubar=no, scrollbar=no, resizable=no, toolbar=no, location=no" );
	forgotWindow.onresize = function() {
		
		forgotWindow.resizeTo(400,300);
	}
    forgotWindow.focus();
}

function closeLoginWindow(){
	loginWindow = window.close();
	window.opener.location.reload();	
}

function openRegWindow(){
	regWindow = window.open("registration_form.php", "Regisztráció", "width=690, height=580, status=no, menubar=no, scrollbar=no, resizable=no, toolbar=no, location=no" );
	regWindow.onresize = function() {
		
		regWindow.resizeTo(690,580);
	}
    regWindow.focus();
}

function closeRegWindow(){
	regWindow = window.close();
	window.opener.location.reload();
}

function logout(){
	window.location.href = "kijelentkezes.php";
}

function saveCheckbox() {
		var checkbox = document.getElementById('rememberme');
		localStorage.setItem('rememberme', checkbox.checked);
	}	

function refreshCheckbox() {
		var checked = JSON.parse(localStorage.getItem('rememberme'));
		document.getElementById("rememberme").checked = checked;
}

function updateCheckbox() {
		location.reload();
		localStorage.clear()
}	
	
/*setInterval(function login(){ window.opener.location.reload(false);	}, 4000);*/	

$(document).ready(function(){
	
	refreshCheckbox();
	//alert('Ez a document.ready-ben lévő, checkbox értékének localstorage-ba letárolása!');
	/*
	 if(document.getElementById('rememberme') !== null && localStorage.getItem('rememberme') !== null){
		document.getElementById('rememberme').value = localStorage.getItem('rememberme');
		console.log(localStorage);
	 }*/
	
	//document.getElementById("con_yahoo").style.display = 'none';
	//document.getElementById("con_gmail").style.display = 'none';
	
	/*Ez a Bejelentkező (Login) kis ablakra vonatkozó üzenet elhalványító-eltüntető effekt függvénye. Most egyelőre nincs rá szükség, mert az üzenetek a főoldalon jelennek meg és halványulnak el. (index.js) 
	window.onload = function fade() {
		$("#error_msg").fadeIn('middle');
		$("#error_msg").animate({opacity: 1.0}, 2000);
		$("#error_msg").fadeOut(2000);	
	}*/
	
 $("#login_gomb").click(function(){ 
	 window.onunload = refreshParent;
	function refreshParent() {
        window.opener.location.reload();	
      }
  });

  
 $("#regisztral_gomb").click(function(){
	  window.onunload = refreshParent2;
	  function refreshParent2() {
        window.opener.location.reload();	
      }
	  //regWindow = window.close();
 });


});


function Showcontact(id){
	if(id == 'y'){
		document.getElementById("con_yahoo").innerHTML = 'mupetya@yahoo.co.uk';
		//document.getElementById("con_yahoo").style.display = 'table-cell';
		//document.getElementById("con_yahoo").style.nowrap="nowrap";
		document.getElementById("yahoo_label").style.fontWeight = "bold";
		document.getElementById("yahoo_label").style.textShadow = "rgba(82,122,122,1) -1px -2px 0.6em";
		 
	}
	 if(id == 'g'){
		 document.getElementById("con_gmail").innerHTML = 'mutterptr@gmail.com';
		 //document.getElementById("con_gmail").style.display = 'table-cell';
		 //document.getElementById("con_gmail").style.nowrap="nowrap";
		 document.getElementById("gmail_label").style.fontWeight = "bold";
		 document.getElementById("gmail_label").style.textShadow = "rgba(82,122,122,1) -1px -2px 0.6em";
	}
	if(id == 's'){
		 document.getElementById("con_skype").innerHTML = 'Skype felhasználónév: mupetike';
		 document.getElementById("skype_label").style.fontWeight = "bold";
		 document.getElementById("skype_label").style.textShadow = "rgba(82,122,122,1) -1px -2px 0.6em";
	}
	 if(id == 't'){
		 document.getElementById("con_twitter").innerHTML = 'Twitter felhasználónév: mpet80';
		 document.getElementById("twitter_label").style.fontWeight = "bold";
		 document.getElementById("twitter_label").style.textShadow = "rgba(82,122,122,1) -1px -2px 0.6em";
	}
	 if(id == 'l'){
		 document.getElementById("con_linkedin").innerHTML = 'https://www.linkedin.com/in/mutterp/';
		 document.getElementById("linkedin_label").style.fontWeight = "bold";
		 document.getElementById("linkedin_label").style.textShadow = "rgba(82,122,122,1) -1px -2px 0.6em";
	}
	 if(id == 'p'){
		 document.getElementById("con_profession").innerHTML = 'https://www.profession.hu (Mutter Péter álláskereső)';
		 document.getElementById("profession_label").style.fontWeight = "bold";
		 document.getElementById("profession_label").style.textShadow = "rgba(82,122,122,1) -1px -2px 0.6em";
	}
	  if(id == 'c'){
		 document.getElementById("con_cvonline").innerHTML = 'http://www.cvonline.hu (Mutter Péter álláskereső)';
		 document.getElementById("cvonline_label").style.fontWeight = "bold";
		 document.getElementById("cvonline_label").style.textShadow = "rgba(82,122,122,1) -1px -2px 0.6em";
	}
	 
	 //document.getElementById("p").style.display='none';
 }

function Hidecontact(){
	document.getElementById("con_yahoo").innerHTML = '';
	document.getElementById("yahoo_label").style.fontWeight = "normal";
	//document.getElementById("con_yahoo").style.display = 'none';
	//document.getElementById("con_yahoo").style.nowrap="nowrap";
	document.getElementById("con_gmail").innerHTML = '';
	document.getElementById("gmail_label").style.fontWeight = "normal";
	//document.getElementById("con_gmail").style.display = 'none';
	//document.getElementById("con_gmail").style.nowrap="nowrap";
	document.getElementById("con_skype").innerHTML = '';
	document.getElementById("skype_label").style.fontWeight = "normal";
	document.getElementById("con_twitter").innerHTML = '';
	document.getElementById("twitter_label").style.fontWeight = "normal";
	document.getElementById("con_linkedin").innerHTML = '';
	document.getElementById("linkedin_label").style.fontWeight = "normal";
	document.getElementById("con_profession").innerHTML = '';
	document.getElementById("profession_label").style.fontWeight = "normal";
	document.getElementById("con_cvonline").innerHTML = '';
	document.getElementById("cvonline_label").style.fontWeight = "normal";	
}

function Displayblackwhite(obj) {
$(obj).addClass("black_white_img");
}
function Displaycolorphoto(obj) {
$(obj).removeClass("black_white_img");
}
