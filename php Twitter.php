<?php 
require_once __DIR__ . '/vendor/autoload.php';
session_start();

if (isset($_GET['q']) && isset($_GET['maxResults'])) {
 
   $DEVELOPER_KEY = 'AIzaSyBmURKPcwzF5qxK6YImn2Tmh6ydphYRmfo';

  $client = new Google_Client();
  $client->setDeveloperKey($DEVELOPER_KEY);

 
  $youtube = new Google_Service_YouTube($client);

  $htmlBody = '';
  try {

   
    $searchResponse = $youtube->search->listSearch('id,snippet', array(
      'q' => $_GET['q'],
      'maxResults' => $_GET['maxResults'],
    ));

    $videos = '';
    $channels = '';
    $playlists = '';
    
    foreach ($searchResponse['items'] as $searchResult) {
	
      switch ($searchResult['id']['kind']) {
        case 'youtube#video':
		$videos .="
			<div class='col s12 m6'>
			<div class='card'>
				<div class='card-image'>
				<img src=".$searchResult['snippet']['thumbnails']['medium']['url'].">
				<span class='card-title'>".$searchResult['snippet']['title']."</span>
				<a class='btn-floating halfway-fab waves-effect waves-light red'>
				<i class='material-icons'>add</i></a>
				</div>
				<div class='card-content'>
				<p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
				</div>
			</div>
			
		</div>";

       //   $videos .= sprintf('<li>%s (%s)</li>',
      //        $searchResult['snippet']['title'], $searchResult['id']['videoId']);
          break;
      }
    }

    $htmlBody .= <<<END
    <h3>Videos</h3>
    <div class="row"> $videos</div>

END;
  } catch (Google_Service_Exception $e) {
    $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
      htmlspecialchars($e->getMessage()));
  } catch (Google_Exception $e) {
    $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
      htmlspecialchars($e->getMessage()));
  }
}


?>

<!doctype html>
<html>
<head>
<title>YouTube Geolocation Search</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/css/materialize.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/js/materialize.min.js"></script>
</head>
<body>
<div class="container">
 <div class="row">
  <form method="GET">
  <div>
    Search Term: <input type="search" id="q" name="q" placeholder="Enter Search Term">
  </div>
  <div>
    Max Results: <input type="number" id="maxResults" name="maxResults" min="1" max="50" step="1" value="25">
  </div>
  <input type="submit" value="Search">
</form>
</div>

<?=$htmlBody?>

</div>
  
</body>
</html>


