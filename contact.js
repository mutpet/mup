
function myMap() {
var mapOptions = {
    center: new google.maps.LatLng(47.484834, 19.067405),
    zoom: 10,
    mapTypeId: google.maps.MapTypeId.ROUTE
	
}
var map = new google.maps.Map(document.getElementById("map"), mapOptions);

var myLatLng = {lat: 47.48488844, lng: 19.06734645};
var marker = new google.maps.Marker({
		  animation: google.maps.Animation.DROP,
          position: myLatLng,
          map: map,
          title: 'Mutter Peter'
        });
}
//My Google API Key: AIzaSyCembPq6TXWYZh46IbNIKnmmADEXiCUF7E


/*

function initMap() {
        var myLatLng = {lat: 47.48488844, lng: 19.06734645};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: myLatLng
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'Hello World!'
        });
      }
*/

function Displaymap(){
	document.getElementById("map").style.opacity = "1"; 
}
function Wanmap(){
	document.getElementById("map").style.opacity = "0.7"; 
}