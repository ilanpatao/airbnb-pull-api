# airbnb-pull-api

<b>Description:</b>

Sample of pulling listings from AirBNB's home tab explorer API. Air BNB displays a number of results with numerous metadata for display in real-time; with this sample you can explore how you can pull and use this data in your projects.

<hr><b>Technical:</b>
PHP CURL XHR request to airbnb.com requesting listings of available rentals in a certain location. The request calls on the Home Explorer API of Air BNB using their public key to draw listings with metadata such as pricing, location, pictures, reviews, listing IDs, availability, number of guests, number of bedrooms, rate type among other parameters (not all included in the decoded sample, there are over 40 parameters provided per each listing. This sample uses the most commonly viewed ones).

<hr><b>Demo:</b>
By default it will show results for France:<br>
http://dangerstudio.com/api/airbnb/

Add /?query=COUNTRY to modify the results of the pull:<br>
http://dangerstudio.com/api/airbnb/?query=Israel<br> 
http://dangerstudio.com/api/airbnb/?query=Germany<br>
http://dangerstudio.com/api/airbnb/?query=England<br>
http://dangerstudio.com/api/airbnb/?query=Italy

<hr><b>Note:</b>
This code can be tweaked (in the End Point URI to add filters to modify your search).

A sample call would be :

https://www.airbnb.com/api/v2/explore_tabs?version=1.3.9&satori_version=1.1.0&_format=for_explore_search_web&experiences_per_grid=0&items_per_grid=250&guidebooks_per_grid=0&auto_ib=true&fetch_filters=true&has_zero_guest_treatment=false&is_guided_search=true&is_new_cards_experiment=true&luxury_pre_launch=true&query_understanding_enabled=false&show_groupings=false&supports_for_you_v3=true&timezone_offset=-240&metadata_only=false&is_standard_search=true&tab_id=home_tab&section_offset=6&items_offset=18&recommendation_item_cursor=&refinement_paths[]=/homes&checkin=2018-11-02&checkout=2019-11-03&adults=1&children=0&infants=0&guests=1&toddlers=0&allow_override[]=&zoom=10&search_by_map=false&map_toggle=false&screen_size=large&query=".$query."&_intents=p1&key=d306zoyjsyarp7ifhu67rjxn52tv0t20&currency=USD&locale=en&allow_override%5B%5D=&refinement_paths%5B%5D=%2Fhomes

Make note of the Adults, Children, Infants, Guests and Toddlers parameters which you can filter to return more exact results; in addition the 'items_per_grid' will control the total amount of listing results returned in the query.

<hr><b>Usage ideas:</b>
<ul>
<li>Web apps and/or sites that wish to display AirBNB data on their platform.</li>
<li>Automatically obtain, update, crawl, scrape and display AirBNB listings for a certain location.</li>
<li>Widgetize and include AirBNB rental listings into your apps or site.</li>
<li>Build and initiate calculation on rental sales in your developments.</li>
<li>Automate/Data capture, or scrape; and quickly find rentals and contact the owners direct.</li>
<li>Build monitoring, spectating, live-availability checking and other functions.</li>
<ul>

<p><hr>
Author:
Ilan Patao (ilan@dangerstudio.com)
