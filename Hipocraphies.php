<html>
    <head>
    <meta charset=utf-8 />
    <link rel="icon" type="image/x-icon"
href="http://www.specious-space.org/WEB/favicon.ico"/>
        <title>Hipocraphies | Hipster Geographies</title>
        
<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
  <script src='//api.tiles.mapbox.com/mapbox.js/v1.5.1/mapbox.js'></script>
  <link href='//api.tiles.mapbox.com/mapbox.js/v1.5.1/mapbox.css' rel='stylesheet' />
  
  <style>
@import url("//hello.myfonts.net/count/2940f0");  
@font-face {font-family: 'TrendHMSlabFive';src: url('webfonts/2940F0_0_0.eot');src: url('webfonts/2940F0_0_0.eot?#iefix') format('embedded-opentype'),url('webfonts/2940F0_0_0.woff') format('woff'),url('webfonts/2940F0_0_0.ttf') format('truetype');}  
@font-face {font-family: 'CoreSansG45Regular-Italic';src: url('webfonts/2940F0_1_0.eot');src: url('webfonts/2940F0_1_0.eot?#iefix') format('embedded-opentype'),url('webfonts/2940F0_1_0.woff') format('woff'),url('webfonts/2940F0_1_0.ttf') format('truetype');} 
@font-face {font-family: 'CoreSansG45Regular';src: url('webfonts/2940F0_2_0.eot');src: url('webfonts/2940F0_2_0.eot?#iefix') format('embedded-opentype'),url('webfonts/2940F0_2_0.woff') format('woff'),url('webfonts/2940F0_2_0.ttf') format('truetype');}
 
    body { width:70% ;margin-left:auto; margin-right:auto; margin-top:40; margin-bottom:40; padding:0; background-image:url('http://farm9.staticflickr.com/8161/7194917656_320070033b_o.jpg');font-size: 100%;
	font-family: "CoreSansG45Regular", sans-serif;color: #373737 ;}
	#headers { padding: 10; width:100% ;margin-left:auto; margin-right:auto; margin-top:30;}
	#forms {padding: 10; width:100% ;margin-left:auto; margin-right:auto;}
    #map {  top-margin:10; padding: 10; height: 600; width:100% ;margin-left:auto; margin-right:auto; border:5px solid; border-radius:10px;border-color:#ffffff; box-shadow: 5px 5px 5px 5px #888888;}
    #credits {text-align: right;  top-margin: 20;padding: 10; width:100% ; margin-left:auto; margin-right:auto;}    
    #graph { top-margin:10; padding: 10; width:100% ;margin-left:auto; margin-right:auto; border:2px dashed; border-radius:10px;border-color:#ffffff; box-shadow: 1px 1px 1px 1px #cccccc;}
    #box{ margin: 3px; height: 30px; padding: 10 ;font-family: "CoreSansG45Regular", sans-serif; border:5px solid; border-radius:10px;border-color:#ffffff; box-shadow: 2px 2px 2px 2px #888888;}
    p {
	line-height: 1.7em;
	font-size: .75em;
	margin: 0 0 20px 0;	
	color: #373737 ;}
	
	pb {
	line-height: 1.8em;
	font-size: .75em;
	margin: 10px 0 10px 0;
	padding: 0 0 20px 0;		
	color: #ffffff ;}
    
    h1, h2, h3{		
	margin: 0 0 15px 0;
	font-weight: normal;
	font-family: "TrendHMSlabFive";
	color: #373737 ;}
	
	h4, h5, h6{		
	margin: 0 0 15px 0;
	font-weight: normal;
	font-family: "CoreSansG45Regular";
	color: #373737 ;}
	
	
  </style>        
    </head>
    
    <body>
 
<form action="Hipocraphies.php" method="post">
<div id='headers'>
<h1>Hipocraphies *sigh* (hipster geographies)</h1>
</div>
<div id='graph'>
<h3>Search Flickr (Text & Captions):</h3>
<strong>Find Flaneurs</strong>:<input type='text' name="food"> 
<strong>Indexical/Iconic Coding</strong> <i>(pick one)</i>:
<input type='radio' name="entree" value="entree"> <img src="1.png"></img> sarcasm
<input type='radio' name="side" value="side"> <img src="2.png"></img> pastiche
<input type='radio' name="beverage" value="beverage"> <img src="3.png"></img> camp
<input type='radio' name="snack" value="snack"> <img src="4.png"></img> irony
<input type='radio' name="condiment" value="condiment"> <img src="5.png"></img> panache or <img src="6.png"></img> default <br/><br/><br/>

<?php
require 'phpDataMapper/Base.php';
// Require the file to setup database connection
require 'phpDataMapper/Adapter/Mysql.php';
class PostMapper extends phpDataMapper_Base{
    // Specify the database table
    protected $_datasource = "HipsterSearch";
  
    // Define your fields
    // The array gives information about the field -- data type, primary key, etc
    public $dbid = array('type' => 'int', 'primary' => true, 'serial' => true);
    public $search = array('type' => 'string', 'required' => true);
    public $link = array('type' => 'string', 'required' => true);
    public $hits = array('type' => 'int', 'required' => true);
    public $color = array('type' => 'string', 'required' => true);
    public $icon = array('type' => 'string', 'required' => true);
}

try {
    $adapter = new phpDataMapper_Adapter_Mysql('mysql.specious-space.org', 'specious_web', 'megstuweb', 'pswrd4mcsirc');
     echo "<h3><i>Like, You're the First... </i>Appropriate Past Searches:</h3> <strong>Steal like an Artist</strong> <i>(grab one or several)</i>:";
} catch(Exception $e) {
    echo $e->getMessage();
    exit();
}
 
$postMapper = new PostMapper($adapter);

$posts = $postMapper->all();
 
// $posts now contains all the records retrieved from the database

$searchAll = array();
foreach ($posts as $post){
    $searches=$post->search;
    array_push($searchAll, $searches);
    }
    $result = array_unique($searchAll);
    
//echo '<action="foodscapesDBEx.php" method="post">' . "\n";
    foreach ($result as $resLayer){
   // echo $resLayer. ", ";
    echo "<input type='radio' name='{$resLayer}' value='{$resLayer}'> {$resLayer} ";
    }
    
?>
<br/><br/>
<h5>[Btw, chillax, this api-mashup is leisurely, very leisurely. And centered on NYU-ITP.]</h5>

<input type='submit' value="Meme/Map Me..."/>
<br/><br/>
</div>
</form>

<?php 

//-------------------------------grab post
$Geocode = $_POST['geocode'];
$Food = $_POST['food']; //post is the key grab for forms, hence takes value

$entree = $_POST['entree'];
$side = $_POST['side'];
$beverage = $_POST['beverage'];
$snack = $_POST['snack'];
$condiment = $_POST['condiment'];

if (isset($_POST['food'])){
if (($_POST['food']) !=null){
//this is just for the 20mile radius around geocode, first 2000+values from
$json_food = file_get_contents("http://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=72e2814aeee20883e819ced9a6a92db5&text=".$Food."&lat=40.729747&lon=-73.993717&radius=20&radius_units=mi&per_page=500&format=json&nojsoncallback=1");
$foodsearch= json_decode($json_food);

$total=$foodsearch->photos->total;
$pages=$foodsearch->photos->pages;

if ($entree){
	$color="#ad6638";
	$symbol="hospital";
	$icon="1.png";
	
	}
else if ($side){
	$color="#6e634b";
	$symbol="circle-stroked";
	$icon="2.png";
	}
else if ($beverage){
	$color="#cd9455";
	$symbol="circle";
	$icon="3.png";
	}	
else if ($snack){
	$color="#74a384";
	$symbol="marker-stroked";
	$icon="4.png";
	}	
else if ($condiment){
	$color="#92b089";
	$symbol="marker";
	$icon="5.png";
	}
else {
$symbol="";
$color="#944120";
$icon="6.png";
}


//--------------------------------add search to database------------------------
try {
    $adapter = new phpDataMapper_Adapter_Mysql('mysql.specious-space.org', 'specious_web', 'megstuweb', 'pswrd4mcsirc');
     echo "This is ";
} catch(Exception $e) {
    echo $e->getMessage();
    exit();
}
 
$postMapper = new PostMapper($adapter);
$postMapper->migrate();

// make an array of the fields in the new record
// the array keys must match the names of the fields (columns) in the database table
$newValues = array(
                'search'=>$Food,
                'link'=>$Food.'_map_data.json',
                'hits'=>$total,
                'color'=>$color,
                'icon'=>$icon
                );
 
if ($postMapper->save($newValues)){ // this will return true if it worked, false if not
    echo "Happening. . .";
} else {
    echo "Oh no! Could not add the record. Check your database set-up and your PostMapper class";
}
}
}
?>
<br/>
<h3>Cultural Capital Captured:</h3>
You've searched for [ <strong><?php echo($Food)?></strong> ] and found [ <strong><?php echo($total)?></strong> ] matches. You've also grabbed [ <strong><?php foreach ($result as $resLayer){if ($_POST[$resLayer]!=null){echo $_POST[$resLayer]." ";}} ?></strong> ] to view.
Have a gander at a few (~500) of them. . . </br><br/>
<h5>[Btw, ignore errors and web glitches, they're just part of the shabby chic code.]</h5>

<br/>



<?php
//------------------GRAB API VARIABLES-----------------------
//var_dump($foodsearch);
//if ($foodsearch){

$geojson = array( 'type' => 'FeatureCollection', 'features' => array());

if ($pages>=2){
$json_food2 = file_get_contents("http://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=72e2814aeee20883e819ced9a6a92db5&text=".$Food."&lat=40.729747&lon=-73.993717&radius=20&radius_units=mi&per_page=500&page=2&format=json&nojsoncallback=1");
$foodsearch2= json_decode($json_food2);

$foods1= $foodsearch->photos->photo;
$foods2= $foodsearch2->photos->photo;

$foodObject = array_merge($foods1,$foods2);
} else {
$foodObject =$foodsearch->photos->photo;
}

if (($_POST['food']) !=null){
foreach($foodObject as $food_point){
 
$photo_id = $food_point->id;
$title = $food_point->title;
$farm_id = $food_point->farm;
$server_id = $food_point->server;
$secret_id = $food_point->secret;

$photo_linkS = "http:///farm{$farm_id}.staticflickr.com/{$server_id}/{$photo_id}_{$secret_id}_q.jpg";
$photo_link = "http:///farm{$farm_id}.staticflickr.com/{$server_id}/{$photo_id}_{$secret_id}.jpg";

//echo $photo_link;

$json_loc= file_get_contents("http://api.flickr.com/services/rest/?method=flickr.photos.geo.getLocation&api_key=72e2814aeee20883e819ced9a6a92db5&photo_id=".$photo_id."&format=json&nojsoncallback=1");
$foodloc= json_decode($json_loc); 

$foodlocation = $foodloc->photo;

foreach($foodlocation as $location){
		$lat = $location->latitude;
		$long = $location->longitude;
		}
		
			//echo $lat." , ".$long." , ";
			
// make an array of the fields in the new record


$marker = array(
    				'type' => 'Feature',
    				'geometry' => array(
                            'type' => 'Point',
                            'coordinates' => array( 
                                            $long,
                                            $lat
                            )
                        ),
                        'properties' => array(
                            'title' => $title,
                            'marker-color' => $color,
                            'marker-size' => 'small',
                            'marker-symbol' => $symbol,
                            'image' => $photo_linkS,
                            'url' => $photo_link
                            ),
                    );
    
    array_push($geojson['features'], $marker);
    	
}//out of foreach (foodObject as food_point) and adding to json
}// out of food null

//var_dump($geojson);

$g_json=json_encode($geojson,JSON_NUMERIC_CHECK);

//so this is about saving the specific search item in json... precombo!
   if (json_decode($g_json) != null) { 
     $file = fopen($Food.'_map_data.json','w+');
     fwrite($file, $g_json);
     fclose($file);
   } else {
     echo "file write, handle error"; 
   } 
 
 //test to see what variables I want...  
 /*
   print_r($result);
   foreach ($result as $resLayer){
   print_r($_POST[$resLayer]);
   }
   */  
//create a looping if statement to effect that if any of the array values were selected.... 
//loop through, read url/decode and grab markers, and add each to geojson... do a final recode of g_json...


foreach ($result as $resLayer){
if ($_POST[$resLayer]!=null) {
	$file=file_get_contents("http://www.specious-space.org/WEB/".$resLayer."_map_data.json");
	 $file_json=json_decode($file);
	$markerNew=$file_json->features;
	
	foreach($markerNew as $marker){
	array_push($geojson['features'], $marker);
	//$geojson=array_merge($geojson['features'], $markerNew);
    }
    }
    }
//print_r($geojson);    

$g_json=json_encode($geojson,JSON_NUMERIC_CHECK);    
    //}

//echo $g_json;
//$Food="";
?>

<div id='map'>
<script>

var map = L.mapbox.map('map', 'siteations.gfgb1h79').setView([40.7286, -73.9928], 14);



var geoJson = <?php echo $g_json; ?>; 

map.markerLayer.setGeoJSON(geoJson);

map.markerLayer.on('mouseover', function(e) {   
    var content = '<img src='+e.layer.feature.properties.image + '>';
    e.layer.bindPopup(content,{
        closeButton: false,
        minWidth: 170    
    });
    
    e.layer.openPopup();
});

map.markerLayer.on('mouseout', function(e) {   
    e.layer.closePopup();
});

map.markerLayer.on('click', function(e) {
    e.layer.unbindPopup();
    window.open(e.layer.feature.properties.url);
});

</script>
</div>
<br/>
<div id='graph'>
<h3>Cumulative Responses:</h3>
<h5> [Btw, base graphic datum = 240 hits no matter how passe & meager the response] </h5>
<?php

try {
    $adapter = new phpDataMapper_Adapter_Mysql('mysql.specious-space.org', 'specious_web', 'megstuweb', 'pswrd4mcsirc');
     //echo "<h3><i>Like, You're the First... </i>Appropriate Past Searches:</h3> <strong>Steal like an Artist</strong> <i>(grab one or several)</i>:";
} catch(Exception $e) {
    echo $e->getMessage();
    exit();
}
 
$postMapper = new PostMapper($adapter);
$posts = $postMapper->all();
//$posts= array_reverse($postsA, true);
 
// $posts now contains all the records retrieved from the database

foreach ($posts as $post){
    $searchTerm=$post->search;
    $searchColor=$post->color;
     $searchHits=$post->hits;
     
     $bar=$searchHits/2;
if ($bar<900 AND $bar>120 ){     
echo "<div class=\"box\" style=\"width: {$bar}px; background-color: {$searchColor}; margin: 3px; height: 18px; padding: 5; border:3px solid; border-radius:10px;border-color:#ffffff; box-shadow: 2px 2px 2px 2px #888888;\">";
echo "<pb> {$searchTerm} [ {$searchHits} ] </pb>";
echo '</div>';
echo "\n";
} elseif ($bar<120 ){     
echo "<div class=\"box\" style=\"width: 120px; background-color: {$searchColor}; margin: 3px; height: 18px; padding: 5; border:3px solid; border-radius:10px;border-color:#ffffff; box-shadow: 2px 2px 2px 2px #888888;\">";
echo "<pb> {$searchTerm} [ {$searchHits} ] </pb>";
echo '</div>';
echo "\n";
} else {  
echo "<div class=\"box\" style=\"width: 900 px; background-color: {$searchColor};margin: 3px; height: 18px; padding: 5; border:3px solid; border-radius:10px;border-color:#ffffff; box-shadow: 2px 2px 2px 2px #888888;\">";
echo "<pb> {$searchTerm} [ {$searchHits} ] (width truncated) </pb>";
echo '</div>';
echo "\n"; 
}
    }

?>
<br/>
<h5> ~<i>cheers</i>~ </h5>

</div>
<div id='credits'>
<h5>[map from <a href="http://www.mapbox.com">mapbox</a>, points & images from <a href="http://www.flickr.com">flickr</a>, vocab from <a href="http://www.hipsteripsum.me/">hipster-ipsum</a>, search engine from <a href="http://www.siteations.com">siteations</a>, copyleft 2013] </h5></br>
</div>
</body>