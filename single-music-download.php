<?php
/*
if(isset($_REQUEST["file"])){
    // Get parameters
    $file = urldecode($_REQUEST["file"]); // Decode URL-encoded string

    if(preg_match('/^[^.][-a-z0-9_.]+[a-z]$/i', $file)){
        $filepath = "images/" . $file;

        // Process download
        if(file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            flush(); // Flush system output buffer
            readfile($filepath);
            die();
        } else {
            http_response_code(404);
	        die();
        }
    } else {
        die("Invalid file name!");
    }
}


echo '<p><a href="download.php?file=">Download</a></p>';



function _Download($f_location, $f_name){
  $file = uniqid() . '.pdf';

  file_put_contents($file,file_get_contents($f_location));

  header('Content-Description: File Transfer');
  header('Content-Type: application/octet-stream');
  header('Content-Length: ' . filesize($file));
  header('Content-Disposition: attachment; filename=' . basename($f_name));

  readfile($file);
}

_Download($_GET['file'], "file.pdf");



<a href="download.php?file=http://url/file.pdf"> Descargar </a>

*/


echo'
<script>
var timeleft = 10;
var downloadTimer = setInterval(function(){ 
  if(timeleft <= 0){
    clearInterval(downloadTimer);
    document.getElementById("errorh").innerHTML = "File Eroors Long";

  
}
  document.getElementById("progressBar").value = 10 - timeleft;
  timeleft -= 1;
}, 1000);
</script>';


if(isset($_REQUEST["file"])){
$file_name = urldecode($_REQUEST["file"]);;
$file_url = $file_name;
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary"); 
header("Content-disposition: attachment; filename=\"".$file_name."\"");
echo'<progress value="0" max="10" id="progressBar"></progress>';
readfile($file_url);
echo "Downloaded Succefully";
echo "<script>window.close();</script>";
}else{
echo'<progress value="0" max="10" id="progressBar"></progress>';
echo '<p id="errorh"></p>';
}

?>
