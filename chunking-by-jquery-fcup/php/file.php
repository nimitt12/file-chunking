<?php


header("Content-type: text/html; charset=utf-8");

$file = isset($_FILES['file_data']) ? $_FILES['file_data']:null; 

$name = isset($_POST['file_name']) ? '../upload/'.$_POST['file_name']:null; 

$total = isset($_POST['file_total']) ? $_POST['file_total']:0; 

$index = isset($_POST['file_index']) ? $_POST['file_index']:0; 

$md5   = isset($_POST['file_md5']) ? $_POST['file_md5'] : 0; 

$size  = isset($_POST['file_size']) ?  $_POST['file_size'] : null; 

echo 'Pieces：'.$index.PHP_EOL;

if(!$file || !$name){
	echo 'failed';
	die();
}

if ($file['error'] == 0) {
	
    if (!file_exists($name)) {
        if (!move_uploaded_file($file['tmp_name'], $name)) {
            echo 'success';
        }
    } else {
        $content = file_get_contents($file['tmp_name']);
        if (!file_put_contents($name, $content, FILE_APPEND)) {
            echo 'failed';
        }
		echo 'success';
    }
} else {
    echo 'failed';
}
 
