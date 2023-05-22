<?php
	// Recursive remove function
	function rrmdir($dir) {
		if(is_dir($dir)) {
			$objects = scandir($dir);
			foreach($objects as $object) {
				if($object != "." && $object != "..") {
					if(is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir."/.".$object))
						rrmdir($dir. DIRECTORY_SEPARATOR .$object);
					else
						unlink($dir. DIRECTORY_SEPARATOR .$object);
				}
			}
			rmdir($dir);
		}
	}
	
	//start of script
	$sceneName = $_GET['scene'];
	
	if(file_exists("./".$sceneName)) {
		$scenePath = "./".$sceneName;
		rrmdir($scenePath);
		header("location:index.php");
        exit;
	}
	else {
		echo "Could not find scene folder to delete. <br>";
	}
?>