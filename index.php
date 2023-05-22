<?php 
	// Start the session
	session_start();
	if(!isset($_SESSION['UserData']['Username'])){
			header("location:login.php");
			exit;
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Classroom VR Manager</title>	
		<style>
			<?php 
				error_reporting(E_ALL);
				include "style.css";
			?>
		</style>
	</head>
	<body>
		<div class="top-area">
			<form action="script-upload.php" method="POST" enctype="multipart/form-data">
			Choose File to Upload:
			<input type="file" name="file" id="file">
			<input type="submit" value="Upload Zipped Scene" name="submit">
			</form>
		</div>
		
		<?php
			// Check and grab all sub-folders (which should be scenes) that contain index.html
			if(glob("./*/index.html")) {
				// Save detected folders as an array
				$library = glob("./*/index.html");
				for($i = 0; $i < count($library); $i++) {
					// Clean up the collected directories so just the scene folder name may be fixed to the end of the URL as a link
					$library[$i] = str_replace("./", "", $library[$i]);
					$library[$i] = str_replace("/index.html", "", $library[$i]);
					
					// Grab the current user URL
					$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
					$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

					// Clean the current user URL of its current location
					$link = str_replace("index.php", "", $url);
					$libraryLink = $library[$i];

					// Fix the scene folder name from the library array as a new link for the user
					$link = $link.$libraryLink;
					$idx = $i+1;

					// Generate remove scene script link for the scene
					$removeLink = str_replace("$library[$i]", "remove.php?scene=$library[$i]", $link);

					?>

					<div class="index">
						<a href="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo $link; ?>&choe=UTF-8" target="_blank">
						<img id="qr" src="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=<?php echo $link; ?>&choe=UTF-8" title="QR Code to scene" />
						</a>
						<p id="index-text"><?php echo $idx; ?>. Scene located at /<?php echo $library[$i]; ?>, click <a href=<?php echo $link; ?>><?php echo $link; ?></a> to view scene. <br><br> Click <a href=<?php echo $removeLink; ?>>here</a> to DELETE <?php echo $library[$i]; ?> <br>
					</div>

					<?php
					/* old PHP way of displaying info

					echo "<div class=\"index\">";

					echo '<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl='.$link.'&choe=UTF-8" title="Link to scene" />';
					echo "  $idx. Scene located at /".$library[$i].", click <a href=$link>$link</a> to view scene. <br>";
					echo "    Click <a href=$removeLink>here</a> to DELETE $library[$i] <br>";
					
					echo "</div>";
					*/
				}
			}
			else {
				echo "Currently no scenes to display. <br>";
			}
		?>
		<a id="logout" href="logout.php">Logout</a>
	</body>
</html>