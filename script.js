var map; 

function fetchData()	{

		
		//Create the map object and set the centre point and zoom level 
		map = L.map('map').setView([53.803527, -1.584981], 9);
		
		//Load tiles from open street map (you maybe have mapbox tiles here- this is fine) 
		L.tileLayer('http://tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution:'Map data ©OpenStreetMap contributors, CC-BY-SA, Imagery ©CloudMade',
		//add the basetiles to the map object	
		}).addTo(map);
		
	//Define array to hold results returned from server
	walkData = new Array();
	
	//AJAX request to server; accepts a URL to which the request is sent 
	//and a callback function to execute if the request is successful. 
	$.getJSON("fetchData.php", function(results)	{ 
		
		//Populate walkData with results
		for (var i = 0; i < results.length; i++ )	{
			
			walkData.push ({
				id: results[i].id, 
				lat: results[i].lat, 
				lon: results[i].lon
			}); 
		}
		
		//writeTweets(); 
		plotWalks();
	});
	
}
	var myIcon = L.icon({
		iconUrl: 'logo.png',
		iconSize: [28, 44]
	});
	
	function plotWalks()	{
	   //Loop through tweetData to create marker at each location 
	   for (var i = 0; i < walkData.length; i++)	{ 
		  var markerLocation = 
			 new L.LatLng(walkData[i].lat, walkData[i].lon);

		  var marker = new L.Marker(markerLocation, {icon: myIcon}).addTo(map);

		  marker.bindPopup(walkData[i].id);
	   }
	}

function clearData()	{
	document.getElementById('textWrap').innerHTML = ''; 
}