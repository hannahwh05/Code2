<!DOCTYPE html>
<head>	
	<link rel="stylesheet" type="text/css" href="map_style.css">
</head>

<body>
	<?php 
		//Filter all POST data and trim to remove spaces
		array_filter($_POST, 'trim_value');
		
		//PHP filters, regular expression (regex)
		$pattern = "/[^A-Za-z0-9\s\.\:\-\+\!\@\,\'\"]/";
		$user	= sanitize('user',FILTER_SANITIZE_SPECIAL_CHARS,$pattern); 
		$password = sanitize('password',FILTER_SANITIZE_SPECIAL_CHARS,$pattern); 
		$pattern = "/[^A-Za-z0-9\s\.\:\-\+\.\°\,\'\"]/";
		$lat = sanitize('lat',FILTER_SANITIZE_SPECIAL_CHARS,$pattern);
		$long = sanitize('lon',FILTER_SANITIZE_SPECIAL_CHARS,$pattern);
		$parking = sanitize('lon',FILTER_SANITIZE_SPECIAL_CHARS,$pattern);
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
		
		//Connect to database
		$pgsqlOptions = "host='localhost' dbname='geog5871' user='geog5871student' password='Geibeu9b'";
		$dbconn = pg_connect($pgsqlOptions) or die ('connection failure');
		
		//Parameterised queries
		$dbconn = pg_connect($pgsqlOptions);
		$insertQuery = pg_prepare(
			$dbconn, "my_query", "INSERT INTO gy18hoae_walks_contribute(id, lat, long, parking, dogs, play_area, disabled, toilets, designation, owner, website, cafe, visitor_centre, water, woodland, comments) VALUES($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,$13,$14,$15,$16)"
		);
<<<<<<< HEAD
		//Some sort of error here? This comes up when click submit: 'Insert Query failed: ERROR: invalid input syntax for type numeric: "" '
		$result = pg_execute(
			$dbconn, "my_query", 
			//array_to_string(
			array($id, $lat, $long, $parking, $dogs, $play_area, $disabled, $toilets, $designation, $owner, $website, $cafe, $visitor_centre, $water, $woodland, $comments))  or die ('Insert Query failed: '.pg_last_error()
			// ' ', '')
		); 
=======
		$result = pg_execute(
			$dbconn, "my_query", 
			array($id, $lat, $long, $parking, $dogs, $play_area, $disabled, $toilets, $designation, $owner, $website, $cafe, $visitor_centre, $water, $woodland, $comments))  or die ('Insert Query failed: '.pg_last_error()
		); 

>>>>>>> 8d86b53dc88595607f0497597edf0edb95463d4f
		
		if (is_null($result)) {
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