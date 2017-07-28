<?php 
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
	/*	$files = scandir($currentdir->path."/\data");	
		
		foreach($files as $keys=>$values){
			 echo $values."<br/>";
		}
		*/	
?>
<html>
<head>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<form name="youtubedl" method="post">
<h2>Download Youtube Video or Audio</h2>
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