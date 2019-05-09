<!DOCTYPE html>
<head>	
	<link rel="stylesheet" type="text/css" href="map_style.css">
</head>

<body>
	<?php 
	
		array_filter($_POST, 'trim_value');
		
		$pattern = "/[^A-Za-z0-9\s\.\:\-\+\!\@\,\'\"]/";
		$user	= sanitize('user',FILTER_SANITIZE_SPECIAL_CHARS,$pattern); 
		$password = sanitize('password',FILTER_SANITIZE_SPECIAL_CHARS,$pattern); 
		$pattern = "/[^A-Za-z0-9\s\.\:\-\+\.\°\,\'\"]/";
		$lat = sanitize('lat',FILTER_SANITIZE_SPECIAL_CHARS,$pattern);
		$long = sanitize('lon',FILTER_SANITIZE_SPECIAL_CHARS,$pattern);
		$dogs = sanitize('lon',FILTER_SANITIZE_SPECIAL_CHARS,$pattern);
		$play_area = sanitize('lon',FILTER_SANITIZE_SPECIAL_CHARS,$pattern);
		$disabled = sanitize('lon',FILTER_SANITIZE_SPECIAL_CHARS,$pattern);
		$toilets = sanitize('lon',FILTER_SANITIZE_SPECIAL_CHARS,$pattern);
		$designation = sanitize('lon',FILTER_SANITIZE_SPECIAL_CHARS,$pattern);
		$owner = sanitize('lon',FILTER_SANITIZE_SPECIAL_CHARS,$pattern);
		$website = sanitize('lon',FILTER_SANITIZE_SPECIAL_CHARS,$pattern);
		$cafe = sanitize('lon',FILTER_SANITIZE_SPECIAL_CHARS,$pattern);
		$visitor_centre = sanitize('lon',FILTER_SANITIZE_SPECIAL_CHARS,$pattern);
		$water = sanitize('lon',FILTER_SANITIZE_SPECIAL_CHARS,$pattern);
		$woodland = sanitize('lon',FILTER_SANITIZE_SPECIAL_CHARS,$pattern);
		$comments = sanitize('lon',FILTER_SANITIZE_SPECIAL_CHARS,$pattern);
		
		//Connect to db 
		$pgsqlOptions = "host='localhost' dbname='geog5871' user='geog5871student' password='Geibeu9b';
		$dbconn = pg_connect($pgsqlOptions) or die ('connection failure');
		
		$dbconn = pg_connect($pgsqlOptions);
		$insertQuery = pg_prepare($dbconn, "my_query", "INSERT INTO gy18hoae_walks_contribute(id, lat, long, dogs, play_area, disabled, toilets, designation, owner, website, cafe, visitor_centre, water, woodland, comments) VALUES($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,$13,$14,$15,$16)");
		$result = pg_execute($dbconn, "my_query", array($id, $lat, $long, $dogs, $play_area, $disabled, $toilets, $designation, $owner, $website, $cafe, $visitor_centre, $water, $woodland, $comments))  or die ('Insert Query failed: '.pg_last_error()); 

		
		if (is_null($result))	{
			echo 'Ooops! Something went wrong there... Try again please!';
		}
		
		else {
			echo 'Thanks for your contribution!';
		}
		
		//Close db connection
		pg_close($dbconn);
		
		
		function trim_value(&$value){
		   $value = trim($value);
		   $pattern = "/[\(\)\[\]\{\}]/";
		   $value = preg_replace($pattern," - ",$value);
		}

		function sanitize($str,$filter,$pattern) {
		   $sanStr = preg_replace($pattern,"",$sanStr);
		   $sanStr = filter_var($_POST[$str], $filter);
		   if (strlen($sanStr) > 255) $sanStr = substr($sanStr,0,255);
		   return $sanStr;
		} 
	?>

</body>
</html> 