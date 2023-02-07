<?php
if(isset($_POST['submit'])) {
	$file  = $_FILES['file'];

	$fileName = $_FILES['file']['name'];
	$fileError = $_FILES['file']['error'];

	if($fileError === 0) {
		// do the upload
		$fileDest = 'uploads/'.$fileName;
		header("Location: upload.php?uplaodsuccess");
	}
	else {
		echo "Therre was an error uploading your file!";
	}
}