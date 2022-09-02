<?php
  ini_set("max_execution_time", "30000");
  $upload_dir = wp_upload_dir();
  $mp3name = isset($_POST["mp3name"]) ? $_POST["mp3name"] : "1X94pQKC__T4STuYGL6mctCCX4E_VkEfg";
  $mp3file = isset($_POST["mp3file"]) ? $_POST["mp3file"] : "";
  $mp3png = isset($_POST["mp3png"]) ? $_POST["mp3png"] : ""; 
  $mp3file = apply_filters( 'peaks_file_path',  $mp3file );
  $image_path = urldecode( $upload_dir['path'] . '/' . $mp3name.'.png');
  $image_path = apply_filters( 'peaks_png_path',  $image_path );
  $image_url = urldecode( $upload_dir['url'] . '/' . $mp3name.'.png' );
  // how much detail we want. Larger number means less detail

if(isset($_POST["mp3png"])){
  if (file_exists( $image_path ) ) {
 @unlink( $image_path ); 
  };

    $ifp = fopen($image_path, 'wb' ); 
    // split the string on commas
    // $data[ 0 ] == "data:image/png;base64"
    // $data[ 1 ] == <actual base64 string>
    $data = explode( ',', $mp3png);

    // we could add validation here with ensuring count( $data ) > 1
    fwrite( $ifp, base64_decode( $data[ 1 ] ) );

    // clean up the file resource
    fclose( $ifp ); 
    unlink($mp3file);
    wp_send_json_success($image_url);
    wp_die();
}else{
    wp_send_json_error("Muisc Png not pass well!");  
    wp_die();

}