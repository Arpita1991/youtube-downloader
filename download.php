<?php

	$currentdir = dir(getcwd());
	$link = $_REQUEST['q'];
	$type = $_REQUEST['type'];
	
	$title = urldecode($_REQUEST['title']);
	if($link && $type){
		if($type == 'audio'){
			exec("youtube-dl -f 18 -o ".$currentdir->path."/\Download\%(title)s.%(ext)s ".$link." && ".
						'ffmpeg -i "'.$currentdir->path.'\Download\\'.$title.'.mp4" "'.$title.'.mp3"');
		
			
		}else
		{
			$result = system("youtube-dl -o ".$currentdir->path."/\Download\%(title)s.%(ext)s ".$link);
		}
	}

	/*	$scanned_directory = scandir($currentdir->path."/\Download");	
		if($scanned_directory > 2){
			$files = array_diff($scanned_directory, array('..', '.'));
			foreach($files as $keys=>$values){
				echo $values."<br/>";
			}
			}
		*/
			
?>

