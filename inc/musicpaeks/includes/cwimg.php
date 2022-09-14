<?php
ini_set("max_execution_time", "30000");
$upload_dir = wp_upload_dir();
$name =  $_POST["pngstring"];
$pngstring = $_POST["pngstring"];
$name = str_replace("https://".$_SERVER['HTTP_HOST']."/wp-content/uploads/", '',$name);
$image_path = urldecode( $upload_dir['basedir'] . '/' . $name);
$image_path = realpath($image_path);
$image_path = apply_filters( 'watermark_png_path',  $image_path );
$image_url = urldecode( $upload_dir['baseurl'] . '/' . $name);

//**RealPath From stackoverflow.com**
//$str = "/images/test.jpg";
//$str = realpath($image_path);
/**
if(isset($_POST["pngstring"])){
 
     $ifp = fopen($image_path, 'wb' ); 
     // split the string on commas
     // $data[ 0 ] == "data:image/png;base64"
     // $data[ 1 ] == <actual base64 string>
     $data = explode( ',', $pngstring);
   
     // we could add validation here with ensuring count( $data ) > 1
     fwrite( $ifp, base64_decode( $data[ 1 ] ) );
     $filetype = wp_check_filetype( basename( $image_path ), null );
     // clean up the file resource
     fclose( $ifp ); 
     wp_send_json_success($image_url);
     wp_die();

}
 */

wp_send_json_success($image_url);
wp_die();