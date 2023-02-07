<?php
if(isset($_POST['submit'])) {
	$file  = $_FILES['file'];

	$fileName = $_FILES['file']['name'];
	$fileError = $_FILES['file']['error'];

	if($fileError === 0) {
		// do the upload
		$fileDest = 'uploads/'.$fileName;
		move_uploaded_file($fileName, $fileDest)
		header("Location: index.php?uploadsuccess");
	}
	else {
		echo "There was an error uploading your file!";
	}
}