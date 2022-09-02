<?php
ini_set("max_execution_time", "30000");
$upload_dir = wp_upload_dir();
$name = isset($_POST["imgname"]) ? $_POST["imgname"] : "1X94pQKC__T4STuYGL6mctCCX4E_VkEfg";
$name = $name."Watermarked";
$pngstring = isset($_POST["pngstring"]) ? $_POST["pngstring"] : "";  
$image_path = urldecode( $upload_dir['path'] . '/' . $name.'.jpg');
$image_path = apply_filters( 'watermark_png_path',  $image_path );
$image_url = urldecode( $upload_dir['url'] . '/' . $name.'.jpg' );
// how much detail we want. Larger number means less detail
$post_id = 0;
if(isset($_POST["pngstring"])){
 //if (file_exists( $image_path ) ) {
 //@unlink( $image_path ); 
 //};

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
  // unlink($file);
   $attachment = array(
    'guid'           => $image_url,
    'post_mime_type' => $filetype['type'],
    'post_title'     => preg_replace( '/\.[^.]+$/', '', $name ),
    'post_content'   => '',
    'post_status'    => 'inherit'
   );



    // Make sure that this file is included, as   wp_generate_attachment_metadata() depends on it.
    require_once( ABSPATH . 'wp-admin/includes/image.php' );

    $tcaption = "";
  if (!empty($tcaption)) {
    $attachment['post_excerpt'] = $tcaption;
  }
    $attach_id = wp_insert_attachment( $attachment, $image_path, $post_id );
    $attach_data = wp_generate_attachment_metadata( $attach_id, $image_path );
    wp_update_attachment_metadata( $attach_id, $attach_data );
 // set_post_thumbnail( $post_id, $attach_id );
  $rd = [];
  $rd['imageid'] = $attach_id;
  $rd['imageurl'] = $image_url;
  wp_send_json_success($rd);
  wp_die();
}elseif(isset($_POST["pngurl"])){
include("remote_dl.php");
}else{
  wp_send_json_error("Muisc Png not pass well!");  
  wp_die();

}

