<?php

  include_once('./components/header.php');

  if(isset($_GET['id'])) { 
      $id = $_GET['id']; 
  }


  $rows = '';
  $subCol = '';
  $titleVal = '';
  $lat = '';
  $lon = '';
  $gellery = '';

  $doc = new DOMDocument();

  $doc->preserveWhiteSpace = false;
  $doc->formatOutput = true;
  $path = "xml/world-heritage.xml";
  $doc->load($path);

  $query = $doc->getElementsByTagName("query");
  $row = $doc->getElementsByTagName("row");
  $imageUrl = $doc->getElementsByTagName("image_url");
  $shortDescription = $doc->getElementsByTagName("short_description");
  $site = $doc->getElementsByTagName("site");
  $latitude = $doc->getElementsByTagName("latitude");
  $longitude = $doc->getElementsByTagName("longitude");
  $idNumber = $doc->getElementsByTagName("id_number");
  $states = $doc->getElementsByTagName("states");
  $httpUrl = $doc->getElementsByTagName("http_url");
  $latitude = $doc->getElementsByTagName("latitude");
  $longitude = $doc->getElementsByTagName("longitude");
  $iso_code = $doc->getElementsByTagName("iso_code");
  $category = $doc->getElementsByTagName("category");


  for($j=0; $j < $row->length; $j++){ 

    if($idNumber->item($j)->nodeValue == $id){

      // Call Open Weather API
      $openWeatherApiURL = 'http://api.openweathermap.org/data/2.5/weather?lat='. $latitude->item($j)->nodeValue .'&lon='.$longitude->item($j)->nodeValue.'&appid=4b5ce5112cf4c59a7845dee97f8650fc&units=metric';
      // var_dump( $openWeatherApiURL);

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_URL, $openWeatherApiURL);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($ch, CURLOPT_VERBOSE, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $response = curl_exec($ch);

      curl_close($ch);
      $data = json_decode($response);
      
      // var_dump($data);
      $currentTime = $data->dt + $data->timezone;


      $siteName = $site->item($j)->nodeValue;

      $countries = explode(",", $iso_code->item($j)->nodeValue);
       
      //var_dump($countries);


      $rows .= '<div class="mt-3">';
    
      $rows .= '<div class="font-weight-bold mb-3"><h5 class="text-break">'.$states->item($j)->nodeValue. '</h5></div><div>';

      foreach($countries as $country){
      
        $rows .= '<span class="mr-2"><img src="https://flagcdn.com/48x36/'.$country.'.png" alt="'. $country .' flag"></span>';

      }

      $rows .= '</div><div class="mt-5 font-weight-bold">Category: '. $category->item($j)->nodeValue .'</div>';
      $rows .= '<div class="mt-4">'.$shortDescription->item($j)->nodeValue .'</div>';
      $rows .= '<div class="mt-4"><span class="font-weight-bold mr-2">Unesco Site:</span><a href="'.$httpUrl->item($j)->nodeValue .'">'.$httpUrl->item($j)->nodeValue. '</a></div></div>';

      $lat = $latitude->item($j)->nodeValue;
      $lon = $longitude->item($j)->nodeValue;

    }
  }

  // Flickr API
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

  $encoded_params = array();

  foreach ($params as $k => $v){
      $encoded_params[] = urlencode($k).'='.urlencode($v);
  }


  // Call the API and decode the response
  $url = "https://api.flickr.com/services/rest/?".implode('&', $encoded_params);

  $rsp = file_get_contents($url);

  $rsp_obj = unserialize($rsp);

  //  var_dump($rsp_obj);

  $rowCount = 0;
  $size = "_m";


  if ($rsp_obj['stat'] == 'ok'){

    $ret .=  '<div class="row gallery">';

    for($i=0; $i < count($rsp_obj['photos']['photo']); $i++){ 

      $ret .= '<div class="col mb-4">';
      $ret .= '<a href="http://www.flickr.com/photos/'.$rsp_obj['photos']['photo'][$i]['owner'].'/'.$rsp_obj['photos']['photo'][$i]['id'].'/" target="_blank" rel="noopener noreferrer">';
      $ret .= '<img class="container-item-img" src="http://farm'.$rsp_obj['photos']['photo'][$i]['farm'].'.static.flickr.com/'.$rsp_obj['photos']['photo'][$i]['server'].'/'.$rsp_obj['photos']['photo'][$i]['id'].'_'.$rsp_obj['photos']['photo'][$i]['secret'].$size.'.jpg" alt="'.$rsp_obj['photos']['photo'][$i]['title'].'">'."\n";
      $ret .= '</a></div>';

      $rowCount++;

      if($rowCount % 4 == 0){
          
          $ret .= '</div><div class="row mb-2">';
      } 

    }

  }else{

    echo "Call failed!";
  }
      
?>

<div class="container mt-5">

  <div class="mb-3">
    <a href="index.php">Back to Home</a>
  </div>

  <div class="row">
    
    <div class="col-lg-9 col-sm-12 mb-sm-5">
        <h2><?php echo $siteName ?></h2>
        <?php print $rows ?>
    </div>

    <div class="col-lg-3 col-sm-12">  
      <div class="border shadow py-4 px-4 bg-white rounded h-100 ">

        <!-- <h3 class="mb-4"><?php echo $data->name; ?> Weather Now</h3> -->
        
        <div class="my-3 bg-secondary">
          <img class="mx-auto d-block" src="http://openweathermap.org/img/wn/<?php echo $data->weather[0]->icon; ?>@2x.png" />
        </div>

        <div class="font-weight-bold text-center">
          <?php echo ucwords($data->weather[0]->description); ?>
        </div>
        
        <div class="mt-4 h4 text-center">
          <span class="h1 mr-2"><?php echo round($data->main->temp); ?></span>°C
        </div>
        
        <div class="my-2 text-center">
            <span class="high"><?php echo round($data->main->temp_max); ?>°C</span> | <span class="min"><?php echo round($data->main->temp_min); ?>°C</span>
        </div>
        
        <div class="mt-4 mb-2">Humidity: <?php echo $data->main->humidity; ?> %</div>
        <div>Wind: <?php echo $data->wind->speed; ?> km/h</div>

        <div class="h5 mt-4">
          <?php echo date("l g:i a", $currentTime); ?>
        </div>
        <div class="h5">
          <?php echo date("F j, Y",$currentTime); ?>
        </div>
        
      </div>
    </div>
  </div>

  <div class="row mt-5">
    <div class="col-md-12">
      <h2 class="mb-4">Photo Gallery</h2>
      <div>
        <?php print $ret ?>
      </div>
    </div> 
  </div>
      
</div>


<?php

  // Closing tag
  include_once('./components/footer.php');

?>


