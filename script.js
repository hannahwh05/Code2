var map; 

	function fetchData()	{

			//Create the map object and set the centre point and zoom level 
			map = L.map('map').setView([53.757973, -1.552252], 11);
			//Load Outdoor tiles
			L.tileLayer('https://api.mapbox.com/styles/v1/gy18hoae/cjvgl9i0j08ag1gqd073kg411/tiles/256/{z}/{x}/{y}@2x?access_token=pk.eyJ1IjoiZ3kxOGhvYWUiLCJhIjoiY2pzeWhuY3Q4MGJ5bjQ3cm5naWdmdmhzcyJ9.zFVmqo1q2wv0I1dHIBz0Xw', {
				zoomDelta: 0.5,
				//Can't zoom out further than GB
				maxBounds: ([9.583276, -12.273780],[61.719292, 2.837935]),
				attribution:'© <a href="https://www.mapbox.com/about/maps/">Mapbox</a> © <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> <strong><a href="https://www.mapbox.com/map-feedback/" target="_blank">Improve this map</a></strong>',

			}).addTo(map);
		
			//Add scale bar to map
			L.control.scale().addTo(map);
			
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
					lon: results[i].lon,
					parking: results[i].parking,
					dogs: results[i].dogs,
					play_area: results[i].play_area,
					disabled: results[i].disabled,
					toilets: results[i].toilets,
					designation: results[i].designation,
					owner: results[i].owner,
					website: results[i].website,
					cafe: results[i].cafe,
					visitor_centre: results[i].visitor_centre,
					water: results[i].water,
					woodland: results[i].woodland
				}); 
			}
			
			//Add walk points to map(); 
			plotWalks();
		});
		
	}
		//Style icon
		var myIcon = L.icon({
			iconUrl: 'images/marker.png',
			iconSize: [35, 59]
		});
			
		function plotWalks()	{
			//Loop through walk data to create marker at each location 
			for (var i = 0; i < walkData.length; i++)	{ 
				var markerLocation = 
				new L.LatLng(walkData[i].lat, walkData[i].lon);

				var marker = new L.Marker(markerLocation, {icon: myIcon}).addTo(map);

				marker.bindPopup("Site name: " + walkData[i].id + "<br> Parking?: " + walkData[i].parking + "<br> Dogs permitted?: " + walkData[i].dogs + "<br> Play area?: " + walkData[i].play_area + "<br> Disabled access?: " + walkData[i].disabled + "<br> Toilets?: " + walkData[i].toilets + "<br> Designation: " + walkData[i].designation + "<br> Owner: " + walkData[i].owner + "<br> Website: " + walkData[i].website + "<br> Cafe?: " + walkData[i].cafe + "<br> Visitor centre?: " + walkData[i].visitor_centre + "<br> Rivers, ponds or lakes?: " + walkData[i].water + "<br> Woodland?: " + walkData[i].woodland);
			 }
		}
		
		map.locate({setView: true, maxZoom: 11});

		function clearData()	{
			document.getElementById('textWrap').innerHTML = ''; 
		}