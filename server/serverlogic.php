<?php

/* 
$status = '404 Not Found';

if(rand(1, 4) == 4) {
    // Имитируем ошибку каждый четвертый раз
    header("HTTP/1.0 {$status}");
    header("HTTP/1.1 {$status}");
    header("Status: {$status}");
    die();
} */

/* $this->load->model('baget_model'); */

if(!empty($_FILES)) {
    // Файл передан через обычный массив $_FILES
    echo 'Contents of $_FILES:<br/><pre>'.print_r($_FILES, true).'</pre>';
    $file = $_FILES['my-pic'];
	$file_name=$file['name'];
	$ppos = strrpos($file_name, '.');
	$file_name = substr($file_name, 0, $ppos).'('.md5(uniqid(rand(),1)).').'.substr($file_name, $ppos + 1);
	session_start();
	$_SESSION['file_name']=$file_name;	
	$tmp_name=$file['tmp_name'];
	$uploads_dir='../photos';  
	
	move_uploaded_file($tmp_name, "$uploads_dir/$file_name");
	/* $data['img']='/photos/'.$file_name;
	$this->baget_model->insert($data); */
    // Внимание! Имя файла для Blob-данных может различаться в разных браузерах
    if ( ($file['type'] == 'image/png') && ($file['name'] == 'blob') ) {
        //move_uploaded_file($file['tmp_name'], './canvas-' . uniqid() . '.png');
    }
} else {
    // Надо выцеплять файл из входного потока php
    // (такое встречается только в очень экзотических браузерах,
    //  поэтому можно не предусматривать этот способ вовсе)
    $headers = getallheaders();
    if(array_key_exists('Upload-Filename', $headers)) {
        $data = file_get_contents('php://input');
        echo 'File recieved: '.$headers['Upload-Filename'];
        echo '<br/>Size: '.$headers['Upload-Size'].' ('.strlen($data).' b)';
        echo '<br/>Type: '.$headers['Upload-Type'];
    }
}
?>