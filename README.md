# API Project - World Heritage Gallery

## Summery of this project

World Heritage Gallery provides the world heritage sites information, local weather information and a photo gallery.

* Information about the site is retrieving from UNESCO’s open data (XML))
* Search result will display on world map (Google Map API) along with the cards on index.php page. Icons on map is clickable.
* Photos on the details page is retrieving from Flickr API. If photo is clicked, redirect to Flickr page (Open with a new tab)
* Flag images is retrieveing from Flagcdn API
* Local weather information is retrieve from OpenWeatherMap API)


## APIS

* World Heritage List Open Data from UNESCO (XML) to retrieve the site name, longitude and latitude, states, short description and image(url), and UNESCO website (https://whc.unesco.org/en/syndication/) 


* Google Map API - display the markers and label with name (and link to details page) of the world heritage sites using longitude and latitude data from UNESCO’s open data.

```
https://maps.googleapis.com/maps/api/js?key=AIzaSyBkHXchFmjJDel_oLk3PjM7SoY7eqnccvI&libraries=&v=weekly

```

* Flickr API - display the pictures of the world heritage site (photo gallery) on the details pages. Retrieve photos by using longitude and latitude from UNESCO’s open data (XML) (https://api.flickr.com/services/rest/)

```
$url = "https://api.flickr.com/services/rest/?".implode('&', $encoded_params);


$params = array(
    'method'	=> 'flickr.photos.search',
    'api_key'	=> '69d9292fa3e301befa2bb6d1765861e3',
    'format'	=> 'php_serial',
    'lat' => $lat,
    'lon'=> $lon,
    'extras' => 'url_t',
    'size' => 'large_square',
    'per_page => 50',
    'sort => interestingness-desc',
    'safe_search=>1'

);
```

* OpenWeatherMap API - display the weather of the world heritage site area using latitude and logitute

```
http://api.openweathermap.org/data/2.5/weather?lat=LATITUDE&lon=LONGITUTE&appid=4b5ce5112cf4c59a7845dee97f8650fc&units=metric

$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $openWeatherApiURL);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
```


* Flagcdn - https://flagpedia.net/download/api to get world flag icon

```
https://flagcdn.com/48x36/COUNTRY CODE/.png

```

## Where I need to fix / want to add by portfolio show

* Image resolution from UNESCO’s open data is quite bad. I need to research how to make it better.
* Adding the pagination.
* I was able to converted to local date and time at the area, but I did not have time to create a real time clock.  # worldHeritage
