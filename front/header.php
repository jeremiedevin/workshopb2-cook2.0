<div class="item active">
  <script
src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCHDJE8_1RXsiXaqNOoiAt4xPXtkI39TYM&sensor=false">
// clé dev : AIzaSyBLfc3F338iXg3L4nT1WsjplI29vQzImF0
// clé en ligne : AIzaSyCHDJE8_1RXsiXaqNOoiAt4xPXtkI39TYM
</script>

<script>

if (navigator.geolocation)
navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
else
alert("Votre navigateur ne prend pas en compte la géolocalisation HTML5");

function successCallback(position){
//alert("Latitude : " + position.coords.latitude + ", longitude : " + position.coords.longitude);
};

function errorCallback(error){
  switch(error.code){
  case error.PERMISSION_DENIED:
      alert("L'utilisateur n'a pas autorisé l'accès à sa position");
      break;
  case error.POSITION_UNAVAILABLE:
      alert("L'emplacement de l'utilisateur n'a pas pu être déterminé");
      break;
  case error.TIMEOUT:
      alert("Le service n'a pas répondu à temps");
      break;
  }
};

var myCenter=new google.maps.LatLng(47.213084,-1.552989);
var marker;
function initialize()
{
var mapProp = {
center:myCenter,
zoom:15,
mapTypeId:google.maps.MapTypeId.ROADMAP
};
var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
marker=new google.maps.Marker({
position:myCenter,
// icon:'themes/assets/images/nepali-momo.png',
animation:google.maps.Animation.BOUNCE
});

marker.setMap(map);

// Info open
var infowindow = new google.maps.InfoWindow({
content:"Votre position!"
});

google.maps.event.addListener(marker, 'click', function() {
infowindow.open(map,marker);
});
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>
<div id="googleMap" style="height:450px;"></div>
<div class="container">
<div class="carousel-caption">
  <!--<a class="btn btn-lg btn-default" href="#" role="button" style="font-size:2em">Commandez dès maintenant en ligne &raquo;</a>-->
</div>
</div>
</div>
