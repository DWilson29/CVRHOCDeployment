<!DOCTYPE html>
<html>
	<head>
		<title></title>
	</head>
	<body>
		<?php
			if(isset($_POST['submit'])) {
				error_reporting(E_ALL);
				$file  = $_FILES['file'];
				$fileName = $_FILES['file']['name'];
				$fileTmpName = $_FILES['file']['tmp_name'];
				$fileError = $_FILES['file']['error'];
				$sceneName = str_replace(".zip", "", $fileName);
				
				if(file_exists('./'.$sceneName)) {
					echo "Scene already exists with name $sceneName. <br> Try again or delete the scene with name $sceneName. <br>";
				} else {
					if($fileError === 0) {
						$fileDest = __DIR__ .'/'.$fileName;
						// move the zip
						if(move_uploaded_file($fileTmpName, $fileDest) === FALSE) {
							echo "Upload Error in move_uploaded_file";
							echo "<br>";
							exit();
						}
						//check if valid file upload, verifying structure
						$zipCheck = new ZipArchive;
						$zipCheck->open($fileDest);
						if($zipCheck->locateName("$sceneName/index.html")) {
							// assume scene is built correctly
						} else {
							echo "Incorrect file structure. Please make sure the zipped file has a file structure corresponding to: <b>$fileName -> $sceneName/index.html</b> <br>";
							$zipDelete=unlink($fileDest);
							if($zipDelete) {
								//echo "Zip Cleanup Successful <br>";
							}
							else {
								echo "Zip Cleanup Failed <br>";
							}
							$zipCheck->close();
							exit();
						}
						$zipCheck->close();
						// Perform upload function
						$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
						$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
						//echo "URL identified as: $url <br>";
						$link = str_replace("script-upload.php", "", $url);
						$sceneLink = str_replace(".zip", "", $fileName);
						$link = $link.$sceneLink;
						echo "Scene now available at <a href=$link>$link</a>";
						echo "<br>";
						
						$zip = new ZipArchive;
						$res = $zip->open($fileDest);
						if($res === TRUE) {
							$zip->extractTo('./');
							$zip->close();
							//echo "Zip Extract Successful";
							//echo "<br>";
							$zipDelete=unlink($fileDest);
							if($zipDelete) {
								//echo "Zip Cleanup Successful";
								//echo "<br>";
							}
							else {
								echo "Zip Cleanup Failed";
								echo "<br>";
							}
						}
						else {
							echo "Error Unzipping File";
							echo "<br>";
						}
					}
					else {
					echo "There was an error uploading your file!";
					echo "<br>";
					}
				}
			}
		?>
	</body>
</html>