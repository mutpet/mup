<?php
/*
Send a simple email:
to send emails directly from a script

https://www.w3schools.com/php/func_mail_mail.asp
*/
// the message
$msg = "Anyád picsháját te szar fos!!!!!";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
if (mail("mupetike@gmail.com","My subject",$msg)){
	echo 'Sikeres e-mail küldés...';
}else{
	echo 'Hiba az e-mail küldése közben!';	
}

/*
Step 1: Configure the  php.ini  file in C:\xampp\php\php.ini

-  Remove the letter ;  before extension=php_openssl.dll
-  Find  [mail function] and change
SMTP=smtp.gmail.com
smtp_port=587
sendmail_from = saját-email-cím@gmail.com                             (sor elején lévő ; pontosvesszőt ki kell törölni!)
sendmail_path = "\"C:\xampp\sendmail\sendmail.exe\" -t"         (ez ne üres legyen, hanem ez legyen benne. sor elején lévő ; pontosvesszőt ki kell törölni!)

Step 2: Configure the  sendmail.ini  file in C:\xampp\sendmail\sendmail.ini
- Find  [sendmail] and change
smtp_server=smtp.gmail.com
smtp_port=587
smtp_ssl=auto
auth_username = saját-email-cím@gmail.com
auth_password = gmail-es saját jelszó
force_sender = saját-email-cím@gmail.com

Step 3: Restart Apache in XAMPP and Test the result.

Step 4: A Google fiókban be kellett állítani a: "Kevésbé biztonságos alkalmazások engedélyezése" opciót "BEKAPCSOLVA" státuszra!
https://myaccount.google.com/lesssecureapps?pli=1

https://www.youtube.com/watch?v=GnqRT7nh8wc

*/	
?> 
