<?php

// print_r($_FILES);
// print_r($_REQUEST);
if (isset($_POST['imgBase64'])) {
	# code...
$img = $_POST['imgBase64'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$fileData = base64_decode($img);
//saving
$fileName = 'photo.png';
$fileadata = file_put_contents($fileName, $fileData);
// print_r($fileadata);
}



?>