<?php

$html = '';
$result = '';
$count = 0;

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
$category = $doc->getElementsByTagName("category");
$states = $doc->getElementsByTagName("states");
$iso_code = $doc->getElementsByTagName("iso_code");
$region = $doc->getElementsByTagName("region");


$count = 0;


if(isset($_POST['search'])){  

    $array = array();
    
    switch ($_POST['search']) {

        case "en":

            for($i=0; $i < $row->length; $i++){
                if(strpos($region->item($i)->nodeValue, "Europe and North America") !== false){
                    
                    $array[$count] = array($site->item($i)->nodeValue, $latitude->item($i)->nodeValue, $longitude->item($i)->nodeValue, $idNumber->item($i)->nodeValue, $imageUrl->item($i)->nodeValue, $iso_code->item($i)->nodeValue, $category->item($i)->nodeValue, $region->item($i)->nodeValue );
                    $count++;
        
                } 
            }

            $json_array = json_encode($array);
  
            die( $json_array );
            break;


        case "la":

            for($i=0; $i < $row->length; $i++){

                if(strpos($region->item($i)->nodeValue, "Latin America and the Caribbean") !== false){
                          
                    $array[$count] = array($site->item($i)->nodeValue, $latitude->item($i)->nodeValue, $longitude->item($i)->nodeValue, $idNumber->item($i)->nodeValue, $imageUrl->item($i)->nodeValue, $iso_code->item($i)->nodeValue, $category->item($i)->nodeValue );
                    $count++;
        
                } 
        
            }

            $json_array = json_encode($array);
  
            die( $json_array );
            break;


        case "asia":

            for($i=0; $i < $row->length; $i++){

                if(strpos($region->item($i)->nodeValue, "Asia and the Pacific") !== false){
        
                    $array[$count] = array($site->item($i)->nodeValue, $latitude->item($i)->nodeValue, $longitude->item($i)->nodeValue, $idNumber->item($i)->nodeValue, $imageUrl->item($i)->nodeValue, $iso_code->item($i)->nodeValue, $category->item($i)->nodeValue );
                    $count++;
        
                } 
            }

            $json_array = json_encode($array);
  
            die( $json_array );
            break;


        case "arab":

            for($i=0; $i < $row->length; $i++){

                if(strpos($region->item($i)->nodeValue, "Arab States") !== false){
                           
                    $array[$count] = array($site->item($i)->nodeValue, $latitude->item($i)->nodeValue, $longitude->item($i)->nodeValue, $idNumber->item($i)->nodeValue, $imageUrl->item($i)->nodeValue, $iso_code->item($i)->nodeValue, $category->item($i)->nodeValue );
                    $count++;
        
                } 
            }

            $json_array = json_encode($array);
  
            die( $json_array );
            break;


        case "africa":
           
            for($i=0; $i < $row->length; $i++){

                if(strpos($region->item($i)->nodeValue, "Africa") !== false){
        
                    $array[$count] = array($site->item($i)->nodeValue, $latitude->item($i)->nodeValue, $longitude->item($i)->nodeValue, $idNumber->item($i)->nodeValue, $imageUrl->item($i)->nodeValue, $iso_code->item($i)->nodeValue, $category->item($i)->nodeValue );
                    $count++;
                } 
            }
           

            $json_array = json_encode($array);
  
            die( $json_array );
            break;


        case "searchSubmit":

            $getCountry = $_POST['keyword'];

            for($i=0; $i < $row->length; $i++){

                if(strpos($states->item($i)->nodeValue,$getCountry) !== false){
                   
                    $array[$count] = array($site->item($i)->nodeValue, $latitude->item($i)->nodeValue, $longitude->item($i)->nodeValue, $idNumber->item($i)->nodeValue, $imageUrl->item($i)->nodeValue, $iso_code->item($i)->nodeValue, $category->item($i)->nodeValue );
                    $count++;
    
                }            
        
            }
            
            $json_array = json_encode($array);
    
            die( $json_array );
            break;
        

            case "country":
        
                $getCountry = $_POST['keyword'];
    
                for($i=0; $i < $row->length; $i++){
    
                    if(strpos($states->item($i)->nodeValue,$getCountry) !== false){
                               
                        $array[$count] = array($site->item($i)->nodeValue, $latitude->item($i)->nodeValue, $longitude->item($i)->nodeValue, $idNumber->item($i)->nodeValue, $imageUrl->item($i)->nodeValue, $iso_code->item($i)->nodeValue, $category->item($i)->nodeValue );
                        $count++;
            
                    } 
                }
                
    
                $json_array = json_encode($array);
        
                die( $json_array );
                break;


        case "list":
    
            $eaCountryfullName = array();
            $laCountryfullName = array();
            $asiaCountryfullName = array();
            $arabCountryfullName = array();
            $africaCountryfullName = array();
            $count = 0;
            
        
            for($i=0; $i < $row->length; $i++){
        
                if($region->item($i)->nodeValue == 'Europe and North America'){
        
                    $countries = explode(",", $states->item($i)->nodeValue);
        
                    foreach($countries as $country){
        
                        $eaCountryfullName[] = $country;
        
                    }
        
                }elseif($region->item($i)->nodeValue == 'Latin America and the Caribbean'){
        
                    $countries = explode(",", $states->item($i)->nodeValue);
        
                    foreach($countries as $country){
        
                        $laCountryfullName[] = $country;
        
                    }
        
                }elseif($region->item($i)->nodeValue == 'Asia and the Pacific'){
        
                    $countries = explode(",", $states->item($i)->nodeValue);
        
                    foreach($countries as $country){
        
                        $asiaCountryfullName[] = $country;
        
                    }
        
        
                }elseif($region->item($i)->nodeValue == 'Arab States'){
        
                    $countries = explode(",", $states->item($i)->nodeValue);
        
                    foreach($countries as $country){
        
                        $arabCountryfullName[] = $country;
        
                    }
        
                    
        
                }elseif($region->item($i)->nodeValue == 'Africa'){
        
                    $countries = explode(",", $states->item($i)->nodeValue);
        
                    foreach($countries as $country){
        
                        $africaCountryfullName[] = $country;
        
                    }
        
                }
        
                $array[$count] = array($site->item($i)->nodeValue, $latitude->item($i)->nodeValue, $longitude->item($i)->nodeValue, $idNumber->item($i)->nodeValue);
                $count++;
            }
        
                $ea = array_unique($eaCountryfullName);
            
                $la = array_unique($laCountryfullName);
                $asia = array_unique($asiaCountryfullName);
                $arab = array_unique($arabCountryfullName);
                $africa = array_unique($africaCountryfullName);
                            
        
                $html .= '<div><h2>Europe and North America</h2>';
                $html .= '<div>';
        
                foreach($ea as $i => $value){
                            
                    $html .= '<span class="mr-3"><a class="country" href="#" data-value="'.$value.'">'.$value.'</a></span>';
        
                }
        
                $html .= '</div></div>';
        
                $html .= '<div><h2>Latin America and the Caribbean</h2>';
                $html .= '<div>';
        
                foreach($la as $i => $value){
                            
                    $html .= '<span class="mr-3"><a class="country" href="#" data-value="'.$value.'">'.$value.'</a></span>';
        
                }
        
                $html .= '</div></div>';
        
        
                $html .= '<div><h2>Asia and the Pacific</h2>';
                $html .= '<div>';
        
                foreach($asia as $i => $value){
                            
                    $html .= '<span class="mr-3"><a class="country" href="#" data-value="'.$value.'">'.$value.'</a></span>';
        
                }
        
                $html .= '</div></div>';
        
        
                $html .= '<div><h2>Arab States</h2>';
                $html .= '<div>';
        
                foreach($arab as $i => $value){
                            
                    $html .= '<span class="mr-3"><a class="country" href="#" data-value="'.$value.'">'.$value.'</a></span>';
        
                }
        
                $html .= '</div></div>';
        
        
                $html .= '<div><h2>Africa</h2>';
                $html .= '<div>';
        
                foreach($africa as $i => $value){
                            
                    $html .= '<span class="mr-3"><a class="country" href="#" data-value="'.$value.'">'.$value.'</a></span>';
        
                }
        
                $html .= '</div></div>';
        
        
                $json_array = json_encode($array);
    
            die( $json_array );

            break;

    }

}else{
    
    $eaCountryfullName = array();
    $laCountryfullName = array();
    $asiaCountryfullName = array();
    $arabCountryfullName = array();
    $africaCountryfullName = array();
    $count = 0;
    

    for($i=0; $i < $row->length; $i++){

        if($region->item($i)->nodeValue == 'Europe and North America'){

            $countries = explode(",", $states->item($i)->nodeValue);

            foreach($countries as $country){

                $eaCountryfullName[] = $country;

            }

        }elseif($region->item($i)->nodeValue == 'Latin America and the Caribbean'){

            $countries = explode(",", $states->item($i)->nodeValue);

            foreach($countries as $country){

                $laCountryfullName[] = $country;

            }

        }elseif($region->item($i)->nodeValue == 'Asia and the Pacific'){

            $countries = explode(",", $states->item($i)->nodeValue);

            foreach($countries as $country){

                $asiaCountryfullName[] = $country;

            }


        }elseif($region->item($i)->nodeValue == 'Arab States'){

            $countries = explode(",", $states->item($i)->nodeValue);

            foreach($countries as $country){

                $arabCountryfullName[] = $country;

            }

            

        }elseif($region->item($i)->nodeValue == 'Africa'){

            $countries = explode(",", $states->item($i)->nodeValue);

            foreach($countries as $country){

                $africaCountryfullName[] = $country;

            }

        }

        $array[$count] = array($site->item($i)->nodeValue, $latitude->item($i)->nodeValue, $longitude->item($i)->nodeValue, $idNumber->item($i)->nodeValue);
        $count++;
    }

        $ea = array_unique($eaCountryfullName);

        $la = array_unique($laCountryfullName);
        $asia = array_unique($asiaCountryfullName);
        $arab = array_unique($arabCountryfullName);
        $africa = array_unique($africaCountryfullName);
        

        $html .= '<div class="my-3"><h2>Europe and North America</h2>';
        $html .= '<div class="mt-2">';

        foreach($ea as $i => $value){
                 
            $html .= '<span class="mr-3"><a class="country" href="#" data-value="'.$value.'">'.$value.'</a></span>';

        }

        $html .= '</div></div>';

        $html .= '<div class="my-3"><h2>Latin America and the Caribbean</h2>';
        $html .= '<div class="mt-2">';

        foreach($la as $i => $value){
                 
            $html .= '<span class="mr-3"><a class="country" href="#" data-value="'.$value.'">'.$value.'</a></span>';

        }

        $html .= '</div></div>';


        $html .= '<div class="my-3"><h2>Asia and the Pacific</h2>';
        $html .= '<div class="mt-2">';

        foreach($asia as $i => $value){
                 
            $html .= '<span class="mr-3"><a class="country" href="#" data-value="'.$value.'">'.$value.'</a></span>';

        }

        $html .= '</div></div>';


        $html .= '<div class="my-3"><h2>Arab States</h2>';
        $html .= '<div class="mt-2">';

        foreach($arab as $i => $value){
                 
            $html .= '<span class="mr-3"><a class="country" href="#" data-value="'.$value.'">'.$value.'</a></span>';

        }

        $html .= '</div></div>';


        $html .= '<div class="my-3"><h2>Africa</h2>';
        $html .= '<div class="mt-2">';

        foreach($africa as $i => $value){
                 
            $html .= '<span class="mr-3"><a class="country" href="#" data-value="'.$value.'">'.$value.'</a></span>';

        }

        $html .= '</div></div>';


        $json_array = json_encode($array);


}


require("./components/header.php");




    
?>

<div id="map"></div>


<h2 class="text-center mt-5">Welcome to World Heritage Gallery</h2>

<div class="col-md-12 text-center mt-4">
   
    <div class="mb-2">Search by Keyword</div>
    <input class="w-50 py-2" id="search" type="text" placeholder="Search">
    <button class="btn btn-info py-2" id="searchSubmit">Search</button>
    
    <div class="mt-4">
        <div class="mb-2">Search by Area</div>
        
        <button class="btn btn-info" id="list">Search by Country</button>
        <button class="btn btn-info" id="en">Europe and North America</button>
        <button class="btn btn-info" id="la">Latin America and the Caribbean</button>
        <button class="btn btn-info" id="asia">Asia and the Pacific</button>
        <button class="btn btn-info" id="arab">Arab States</button>
        <button class="btn btn-info" id="africa">Africa</button>
        
    </div>   
</div>

<?php print $result?>

<div class="container mt-5">

    <div class="mb-2" id="resultCountContainer"></div>

    <!-- export cards here--> 
    <div class="row" >
        <div class="card-group" id="result"></div>
    </div>
   
   
   <!-- list of the country here-->
   <div class="row" id="listOfCountry"><?php print $html?></div>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBkHXchFmjJDel_oLk3PjM7SoY7eqnccvI&libraries=&v=weekly"
></script>

<script>

    var map;
    var marker = [];
    var infoWindow = [];
    var countLoop = 0;
    var id = "";
    var searchKeyword = "";
    var resultCount = "";


    $(document).ready(function(){
 
        let js_array = <?php echo $json_array; ?>

        console.log(js_array);
        initMap(js_array);

        setMarker(js_array);
    });


    $('.btn').on('click', function(){
        id = $(this).attr("id");
        $('.cardParent').remove();
        $('#resultCount').remove();
        
        if(id == 'en'){
            searchTerm= 'Europe and North America';
       
        }else if(id == 'la'){
            searchTerm= 'Latin America and the Caribbean';
           
        }else if(id == 'asia'){
            searchTerm= 'Asia and the Pacific';
           
        }else if(id == 'arab'){
            searchTerm= 'Arab States';
           
        }else if(id == 'africa'){
            searchTerm= 'Africa';
           
        }

        if(id == "searchSubmit"){
            searchKeyword = $("#search").val();
            searchTerm= $("#search").val();
            $("#search").val("");
            // console.log("key: " + searchKeyword);
        }
        
        $.ajax({
            type: "POST",
            url: "<?php echo $_SERVER['REQUEST_URI']; ?>",
            data: { "search" : id, "keyword": searchKeyword },
            dataType: "json",
            async: false,
            success: function(data){
                console.log(data);
                initMap(data);

                setMarker(data);

                if(id == 'list'){

                    $('#listOfCountry').show();
        
                }else{
                    $('#listOfCountry').hide();

                    for (var i = 0; i < Object.keys(data).length; i++) {

                    
                        var html = '<div class="col-md-6 col-lg-4 mb-4 cardParent"><div class="card h-100"><img class="card-img-top" src="' +data[i][4]+ '" alt="Picture is retrieved from' + data[i][4]+ 
                            '"><div class="card-body"><p class="card-text">'+data[i][0]+
                            '</p><p class="card-text">Category: '+data[i][6] +'</p><p class="card-text">';

                        var str = data[i][5];
                        var res = str.split(',');

                        $.each(res, function(index, val) {
                        html += '<span class="mr-1"><img src="https://flagcdn.com/48x36/'+ val+ '.png" alt="'+ val+' flag"></span>';
                        });
                        html += '</p></div><div class="card-footer"><a class="btn btn-primary" href="details.php?id=' +data[i][3]+ '">View Details</a></div></div></div>';


                        $("#result").append(html);

                        
                            
                    }

                    if(Object.keys(data).length <= 1){

                        
                        resultCount = "Search: " + searchTerm +  " - " + Object.keys(data).length + 1 +" result found";
                    }else{
                        resultCount = "Search: " + searchTerm + " - " + Object.keys(data).length +" results found";
                    }

                    $("#resultCountContainer").append('<div id="resultCount">'+resultCount+'</div>'); 

                }  

            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                console.log(errorThrown);
                console.log(textStatus);
            }
        })
 
    });

    $('.country').on('click', function(event){
        event.preventDefault();
        $('.cardParent').remove();
        $('#listOfCountry').hide();
        $('#resultCount').remove();
        
        searchKeyword = $(this).data('value');
        console.log("key: " + searchKeyword);
        
        $.ajax({
            type: "POST",
            url: "<?php echo $_SERVER['REQUEST_URI']; ?>",
            data: { "search" : "country", "keyword": searchKeyword },
            dataType: "json",
            async: false,
            success: function(data){
                console.log(data);
                initMap(data);

                setMarker(data);

                for (var i = 0; i < Object.keys(data).length; i++) {

                    
                    var html = '<div class="col-md-6 col-lg-4 mb-4 cardParent"><div class="card h-100"><img class="card-img-top" src="' +data[i][4]+ '" alt="Picture is retrieved from' + data[i][4]+ 
                        '"><div class="card-body"><p class="card-text">'+data[i][0]+
                        '</p><p class="card-text">Category: '+data[i][6] +'</p><p class="card-text">';

                    var str = data[i][5];
                    var res = str.split(',');

                    $.each(res, function(index, val) {
                    html += '<span class="mr-1"><img src="https://flagcdn.com/48x36/'+ val+ '.png" alt="'+ val+' flag"></span>';
                    });
                    html += '</p></div><div class="card-footer"><a class="btn btn-primary" href="details.php?id=' +data[i][3]+ '">View Details</a></div></div></div>';


                    $("#result").append(html);


                    
                }
                

                    if(Object.keys(data).length <= 1){

                    resultCount = "Search: " + searchKeyword +  " - " + Object.keys(data).length + 1 +" result found";

                    }else{
                        resultCount = "Search: " + searchKeyword + " - " + Object.keys(data).length +" results found";
                    }

                    $("#resultCountContainer").append('<div id="resultCount">'+resultCount+'</div>');

                
                
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                console.log(errorThrown);
                console.log(textStatus);
            }
        })
        
    });

    function initMap(markerData) {
        // console.log(Number(markerData[0][1]));
        // console.log(Number(markerData[0][2]));

        // Making map
        var mapLatLng = new google.maps.LatLng({lat: Number(markerData[0][1]), lng: Number(markerData[0][2])}); // 緯度経度のデータ作成
        map = new google.maps.Map(document.getElementById('map'), { 
            center: mapLatLng, 
            zoom: 2 
        });
    }
      
    // Set marker
    function setMarker(markerData) {
        console.log(Object.keys(markerData).length);
        
        for (var i = 0; i < Object.keys(markerData).length; i++) {
            
                markerLatLng = new google.maps.LatLng({lat: Number(markerData[i][1]), lng: Number(markerData[i][2])}); // 緯度経度のデータ作成
                marker[i] = new google.maps.Marker({ 
                    position: markerLatLng, 
                    map: map, 
                    icon: 'img/circle.png'
            });
        
            infoWindow[i] = new google.maps.InfoWindow({ 
                content: '<div class="maker"><a href="details.php?id='+ markerData[i][3] +'">' + markerData[i][0] + '</a></div>' 
            });
        
            markerEvent(i); 
        }
    }
 
 
function markerEvent(i) {
    marker[i].addListener('click', function() { 
      infoWindow[i].open(map, marker[i]); 
  });
}

    
</script>
  
<?php
    // Footer
    require("./components/footer.php");
?>





