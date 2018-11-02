<!--/////////////////////////////
// Written by: Ilan Patao //
// ilan@dangerstudio.com //
//////////////////////////-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>AirBNB REST API Pull Example - Ilan Patao (2018)</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="https://autotrader-api.herokuapp.com/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://autotrader-api.herokuapp.com/css/mdb.min.css" rel="stylesheet">
    <!-- BST core CSS -->
    <link href="https://autotrader-api.herokuapp.com/js/bootstrap-table.min.css" rel="stylesheet">
</head>

<body>


    <div class="container" style="margin-top:25px;">
        <div class="flex-center flex-column">
            <h1 class="animated fadeIn mb-4">AirBNB REST API Pull Example</h1>

            <h5 class="animated fadeIn mb-3">Written by: <a href="mailto:ilan@dangerstudio.com" style="text-decoration:none;">Ilan Patao</a> - 11/02/2018</b></h5>

            <p class="animated fadeIn text-muted">This is an example of pulling listings available on Air BNB in real-time from their localized hometabs API. In this example I am returning 250 results for locations in "France"; you can modify the URL to add filters to your search such as number of guests, children, etc; in addition you can also click on a listing ID to load the actual listing in a new window.</p>	&nbsp;<br /><small>Note: You can play with the query by adding /?query='COUNTRY' to this URL. For example: <a href="http://dangerstudio.com/api/airbnb/?query=Israel">http://dangerstudio.com/api/airbnb/?query=Israel</a> would return 250 results from Israel. You can modify the filters easily in the code to manipulate this data for any use (display, automation, monitoring, etc.).</small>
			

		<div class="table-responsive" id="results">
	
        <table id="table"
               data-toggle="table"
			   data-height="625"
			   data-page-size="100"
               data-show-columns="true"
               data-pagination="true"
               data-search="true" style="display:block;">
            <thead>
            <tr>
				<th data-field="img" data-sortable="true">Image</th>
                <th data-field="id" data-sortable="true">ID</th>
                <th data-field="name" data-sortable="true">Name</th>
				<th data-field="city" data-sortable="true">City</th>
				<th data-field="bedrooms" data-sortable="bedrooms">Bedrooms</th>
				<th data-field="bathrooms" data-sortable="bathrooms">Bedrooms</th>
				<th data-field="guests" data-sortable="true">Guests</th>
				<th data-field="pictures" data-sortable="true">Pictures</th>
				<th data-field="reviews" data-sortable="true">Reviews</th>
				<th data-field="type" data-sortable="type">Property Type</th>
				<th data-field="price" data-sortable="true">Price</th>
				<th data-field="rate" data-sortable="true">Rate</th>
            </tr>
            </thead>
			<tbody>

<?php
// Specify your search query
$query = $_GET['query'];

// If query parameter is blank, let's default to France
if (empty($query)){
	$query = "France";
}

// Call AirBNB's service
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.airbnb.com/api/v2/explore_tabs?version=1.3.9&satori_version=1.1.0&_format=for_explore_search_web&experiences_per_grid=0&items_per_grid=250&guidebooks_per_grid=0&auto_ib=true&fetch_filters=true&has_zero_guest_treatment=false&is_guided_search=true&is_new_cards_experiment=true&luxury_pre_launch=true&query_understanding_enabled=false&show_groupings=false&supports_for_you_v3=true&timezone_offset=-240&metadata_only=false&is_standard_search=true&tab_id=home_tab&section_offset=6&items_offset=18&recommendation_item_cursor=&refinement_paths[]=/homes&checkin=2018-11-02&checkout=2019-11-03&adults=1&children=0&infants=0&guests=1&toddlers=0&allow_override[]=&zoom=10&search_by_map=false&map_toggle=false&screen_size=large&query=".$query."&_intents=p1&key=d306zoyjsyarp7ifhu67rjxn52tv0t20&currency=USD&locale=en&allow_override%5B%5D=&refinement_paths%5B%5D=%2Fhomes",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache"
  ),
));

// Gather and decode the response
$response = curl_exec($curl);
curl_close($curl);
$json = json_decode($response, true);
$listings = $json["explore_tabs"][0]["sections"][0]["listings"];

// Itirate through all the results and display them in a table
foreach($listings as $listing){
	// Store our variables from each listing
	$id = $listing["listing"]["id"];
	$beds = $listing["listing"]["beds"];
	$bathrooms = $listing["listing"]["bathrooms"];
	$bedrooms = $listing["listing"]["bedrooms"];
	$name = $listing["listing"]["name"];
	$neighborhood = $listing["listing"]["neighborhood"];
	$city = $listing["listing"]["city"];
	$persons = $listing["listing"]["person_capacity"];
	$pictures = $listing["listing"]["picture_count"];
	$picture = $listing["listing"]["picture_url"];
	$reviews = $listing["listing"]["reviews_count"];
	$property = $listing["listing"]["room_and_property_type"];
	
	$price = $listing["pricing_quote"]["price_string"];
	$rate = $listing["pricing_quote"]["rate_type"];
	$instantbook = $listing["pricing_quote"]["can_instant_book"];
	
	// Echo each listings variable into a table row
	echo "<tr>";
	echo "<td><img src='".$picture."' style='width:45px;height;45px'></td>";
	echo "<td><a href='https://www.airbnb.com/rooms/".$id."' target='_new'>" . $id . "</a></td>";
	echo "<td>" . $name . "</td>";
	echo "<td>" . $city . "</td>";
	echo "<td>" . $bedrooms . "</td>";
	echo "<td>" . $bathrooms . "</td>";
	echo "<td>" . $persons . "</td>";
	echo "<td>" . $pictures . "</td>";
	echo "<td>" . $reviews . "</td>";
	echo "<td>" . $property . "</td>";
	echo "<td>" . $price . "</td>";
	echo "<td>" . $rate . "</td>";
	echo "</tr>";

}

?>
		
		</tbody>
        </table>
		</div>

		<center>
							
			<br>
			Written by: <a href="mailto:ilan@dangerstudio.com" style="text-decoration:none;">Ilan Patao</a> - 11/02/2018)
			
		</center>
        </div>
    </div>
    <!-- JQuery -->
    <script type="text/javascript" src="https://autotrader-api.herokuapp.com/js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://autotrader-api.herokuapp.com/js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://autotrader-api.herokuapp.com/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://autotrader-api.herokuapp.com/js/mdb.min.js"></script>
    <!-- BST core JavaScript -->
    <script type="text/javascript" src="https://autotrader-api.herokuapp.com/js/bootstrap-table.min.js"></script>
</body>
<script>
$(document).ready(function(){
});
</script>
</html>
