<?php 
require_once __DIR__ . '/vendor/autoload.php';
session_start();
ob_start();

if (isset($_POST['q']) && isset($_POST['maxResults'])) {

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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>YouTube Geolocation Search</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>

<body>
<nav class="red darken-4" role="navigation">
<div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">YD</a>
    <ul class="right hide-on-med-and-down">
    <li><a href="#">Home</a></li>
    </ul>
    <ul id="nav-mobile" class="side-nav">
    <li><a href="#">Home</a></li>
    </ul>
    <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
</div>
</nav>

<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <div class="row">
         <br><br>
        <input name="group1" type="radio" id="search" checked />
        <label for="search">Search and Download</label>
        <input name="group1" type="radio" id="download" />
        <label for="download">Download By URL</label>
      </div>

      <div class="row" id="searchvideo">
        <form class="col s12" method="POST">
        
        <div class="row">
            <div class="input-field col s12">
            <input id="Term" type="search" placeholder="Apple" name="q" class="validate">
            <label for="Term">Enter Search Term</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
            <input id="max" type="number" id="maxResults" name="maxResults" min="1" max="50" step="1" placeholder="25">
            <label for="max">Enter Max Results</label>
            </div>
        </div>
          <button class="waves-effect waves-light btn-large" type="submit" value="Search">Submit
            
        </button>

        </form>
    </div>

    <div class="row" id="searchlink">
         <form class="col s12" method="POST">
            <div class="row">
                <div class="input-field col s12">
                <input id="url" type="text" name="urllink" placeholder="https://youtu.be/-KFUp7S6yn8">
                <label for="url">Enter Url</label>
                </div>
            </div>
            <button class="waves-effect waves-light btn-large" type="submit" value="SearchURL">Submit
               
            </button>
        </form>
    </div>

    </div>
  </div>
<div class="container">
 
<?=$htmlBody?>

</div>
<footer class="page-footer orange">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Company Bio</h5>
          <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>


        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Settings</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Connect</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      Made by <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize</a>
      </div>
    </div>
  </footer>


<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
 <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

    <script src="js/custom.js"></script>
  </body></html>


