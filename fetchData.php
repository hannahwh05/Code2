<?php 
	//Returns JSON data to Javascript file
	header("Content-type:application/json");
	
	//Connect to db 
	$pgsqlOptions = "host='localhost' dbname='geog5871' user='geog5871student' password='Geibeu9b'";
	$dbconn = pg_connect($pgsqlOptions) or die ('connection failure');
	
	//Define sql query
	$query = "SELECT * FROM gy18hoae_walks";

	//Execute query
	$result = pg_query($dbconn, $query) or die ('Query failed: '.pg_last_error());
	
	//Define new array to store results
	$walkData = array();
	
	//Loop through query results 
	while ($row = pg_fetch_array($result, null, PGSQL_ASSOC))	{
	
		//Populate walkData array 
		$walkData[] = array("id" => $row["id"], "lat" => $row["lat"], "lon" => $row["long"]);
	}
	
	//Encode walkData array in JSON
	echo json_encode($walkData); 
	
	//Close db connection
	pg_close($dbconn);
?>
