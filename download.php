<?php

	$currentdir = dir(getcwd());
	$link = $_REQUEST['q'];
	$type = $_REQUEST['type'];
	
	$title = urldecode($_REQUEST['title']);
	if($link && $type){
		if($type == 'audio'){
			exec("youtube-dl -f 18 -o ".$currentdir->path."/\Download\%(title)s.%(ext)s ".$link);
			$mp4video = $currentdir->path.'\Download\\'.$title.'.mp4';
			$mp3video = $currentdir->path.'\Download\\'.$title.'.mp3';
			exec('ffmpeg -i'.' "'.$mp4video.'"'.' "'.$mp3video.'"');
		}else
		{
			$result = system("youtube-dl -o ".$currentdir->path."/\Download\%(title)s.%(ext)s ".$link);
		}
	}

?>

