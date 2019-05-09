var map; 

	function fetchData()	{

			
			//Create the map object and set the centre point and zoom level 
			map = L.map('map').setView([53.757973, -1.552252], 11);
			//Load Outdoor tiles) 
			L.tileLayer('https://api.mapbox.com/styles/v1/gy18hoae/cjvgl9i0j08ag1gqd073kg411/tiles/256/{z}/{x}/{y}@2x?access_token=pk.eyJ1IjoiZ3kxOGhvYWUiLCJhIjoiY2pzeWhuY3Q4MGJ5bjQ3cm5naWdmdmhzcyJ9.zFVmqo1q2wv0I1dHIBz0Xw', {
				minZoom: 6,
				zoomDelta: 0.5,
				maxBounds: ([9.583276, -12.273780],[61.719292, 2.837935]),
				attribution:'© <a href="https://www.mapbox.com/about/maps/">Mapbox</a> © <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> <strong><a href="https://www.mapbox.com/map-feedback/" target="_blank">Improve this map</a></strong>',

			}).addTo(map);
		
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
					lon: results[i].lon
				}); 
			}
			
			//writeTweets(); 
			plotWalks();
		});
		
	}
		var myIcon = L.icon({
			iconUrl: 'marker.png',
			iconSize: [35, 59]
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