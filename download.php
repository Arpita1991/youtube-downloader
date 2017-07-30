<?php

// AIzaSyAAw-8h6iMVImWrj1CUSV5ymKhvvshzbcM
	$currentdir = dir(getcwd());
	if(isset($_REQUEST['submit'])){
		$text = $_REQUEST['search_video'];
		if($_REQUEST['type'] == 'audio'){
			$result = system("youtube-dl --extract-audio --audio-format mp3 -o ".$currentdir->path."/\Download\%(title)s.%(ext)s ".$text,$display);
		}else
		{
			$result = system("youtube-dl -o ".$currentdir->path."/\Download\%(title)s.%(ext)s ".$text,$display);
		}
	}

		$scanned_directory = scandir($currentdir->path."/\Download");	
		if($scanned_directory > 2){
			$files = array_diff($scanned_directory, array('..', '.'));
			foreach($files as $keys=>$values){
				echo $values."<br/>";
			}
		}
			
?>


<html>
 <head>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

<body>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
        
<div class="container">
<form name="youtubedl" method="post">
<h2>Download Youtube Video or Audio</h2>
<div class="row">
    <form class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <input id="email" type="email" class="validate">
          <label for="email" data-error="wrong" data-success="right">Email</label>
        </div>
      </div>
    </form>
  </div>


 <div class="form-group">
 <label>Youtube Link : </label>
<input type="text" class="form-control" name="search_video" placeholder="Youtube link">
 </div>
<div class="form-group">
<label class="checkbox">Options :</label>
 <input type="checkbox"  name="type" value="audio">Audio<br>
<input type="checkbox"  name="type" value="video">Video 
</div>
<div class="form-group">
<input type="submit" class="btn btn-default" value="Submit" name="submit">
</div>

</form>
</div>
</body>
</html>

