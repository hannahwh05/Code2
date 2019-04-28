var map; // The map object
var myCentreLat = 53.823513;
var myCentreLng = -1.547088;
var initialZoom = 12;

function infoCallback(infowindow, marker) {
   return function() {
      infowindow.open(map, marker);
   };
}

function addMarker(myPos,myTitle,myInfo) {
   var marker = new google.maps.Marker({
      position: myPos, 
      map: map, 
	  icon: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png',
      title: myTitle
   });
   var infowindow = new google.maps.InfoWindow({content: myInfo});
   google.maps.event.addListener(marker,
      'click', infoCallback(infowindow, marker));
}

function initialize() {
   var latlng = new google.maps.LatLng(myCentreLat,myCentreLng);
   var myOptions = {
      zoom: initialZoom,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
   };
   map = new google.maps.Map(
      document.getElementById("map_canvas"),myOptions);

   for (id in os_markers) {
      var info = "<div class=infowindow><h3>" +
         os_markers[id].title + "</h3><box_style>Caption: "
         + os_markers[id].caption +
         "</box_style></div>";

      // Convert co-ords
      var osPt = new OSRef(
         os_markers[id].easting,os_markers[id].northing);
      var llPt = osPt.toLatLng(osPt);
      llPt.OSGB36ToWGS84();

      addMarker(
         new google.maps.LatLng(llPt.lat,llPt.lng),
         os_markers[id].title,info);
   }
}