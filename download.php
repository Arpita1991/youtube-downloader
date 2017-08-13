<?php

ini_set('max_execution_time', 300);
	$currentdir = dir(getcwd());
	$link = $_REQUEST['q'];
	$type = $_REQUEST['type'];
	
	$title = $_REQUEST['title'];
	if($link && $type){
		if($type == 'audio'){	
			exec("youtube-dl -f 18 -o ".$currentdir->path."/\Download\\".$title.".%(ext)s ".$link);
			//exec("youtube-dl -f 18 -o ".$currentdir->path."/\Download\%(title)s.%(ext)s ".$link);
			$mp4video = $currentdir->path.'\Download\\'.$title.'.mp4';
			$mp3video = $currentdir->path.'\Download\\'.$title.'.mp3';
			$result = exec('ffmpeg -i'.' "'.$mp4video.'"'.' "'.$mp3video.'"',$output, $return);
			download($mp3video,$title);
		}else
		{
			$result = system("youtube-dl -o ".$currentdir->path."/\Download\%(title)s.%(ext)s ".$link);
		}
	}

function download($file,$title){
	if (file_exists($file) && is_readable($file) && preg_match('/\.mp3$/',$file))  { 
            header('Content-type: application/mp3');  
            header("Content-Disposition: attachment; filename=\"$file\"");   
			header("Content-length: " . filesize($file) . "\n\n"); 
            readfile($file); 
	}else{
	//	echo "cant downlaod";
	}
}	

?>

