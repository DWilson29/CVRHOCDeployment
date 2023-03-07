<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<?php session_start(); /* Starts the session */

		if(!isset($_SESSION['UserData']['Username'])){
				header("location:login.php");
				exit;
		}
		?>
	</head>
	<body>
		<form action="script-upload.php" method="POST" enctype="multipart/form-data">
		Choose File to Upload:
		<input type="file" name="file" id="file">
		<input type="submit" value="Upload Zipped Scene" name="submit">
		</form>
		
		<?php
			include './libraries/phpqrcode/qrlib.php';

			echo "<br><br>";
			if(glob("./*/index.html")) {
				$library = glob("./*/index.html");
				for($i = 0; $i < count($library); $i++) {
					$library[$i] = str_replace("./", "", $library[$i]);
					$library[$i] = str_replace("/index.html", "", $library[$i]);
					
					$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
					$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
					//echo "URL identified as: $url <br>";
					$link = str_replace("index.php", "", $url);
					$libraryLink = $library[$i];
					$link = $link.$libraryLink;
					$idx = $i+1;

					echo '<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl='.$link.'&choe=UTF-8" title="Link to scene" />';

					//QRcode::png('PHP QR Code :');
					/*
					$png = $libary[$i].'.png';

					if (file_exists($png)) {
					    header('Content-Type: image/png');
					    header('Expires: 0');
					    header('Content-Length: ' . filesize($png));
					    readfile($png);
					    //exit;
					}
					*/
					
					
					echo "  $idx. Scene located at /".$library[$i].", click <a href=$link>$link</a> to view scene. <br>";
					$removeLink = str_replace("$library[$i]", "remove.php?scene=$library[$i]", $link);
					echo "    Click <a href=$removeLink>here</a> to DELETE $library[$i] <br>";
				}
			}
			else {
				echo "Currently no scenes to display. <br>";
			}
		?>
	</body>
</html>