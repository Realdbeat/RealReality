<?php 

if(!isset($_POST['title']) || empty($_POST['title']))exit('Remote download missing title!');

$url = $_POST['id'];
$title = $_POST['title'];

if(isset($_POST['path']) && !empty($_POST['path']))$path = $_POST['path'] . '/' . $title . '.mp3';  
else $path = dirname(__FILE__) . '/' . $title . '.mp3';  

if($_SERVER['HTTP_HOST'] == "localhost"){
    define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/');
    define('SITEPATH', $_SERVER['DOCUMENT_ROOT'] . '/');
}
else{ 
    define('SITE_URL', "http://" . $_SERVER['HTTP_HOST']);
    define('SITEPATH', $_SERVER['DOCUMENT_ROOT']);
}



function downloadFile($url, $path){

    $newfname = $path;
    $file = fopen ($url, 'rb');
    if ($file) {
        $newf = fopen ($newfname, 'wb');
        if ($newf) {
            while(!feof($file)) {
                fwrite($newf, fread($file, 1024 * 8), 1024 * 8);
            }
        }
    }

    if ($file) {
        fclose($file);
    }
    if ($newf) {
        fclose($newf);
    }

    $path_info = pathinfo($path);
    $res = SITE_URL.path2url(realpath($path_info['dirname'])).'/'.$path_info['basename'];

    echo json_encode($res);

    return true;
}

downloadFile($url, ABSPATH.$path);
?>