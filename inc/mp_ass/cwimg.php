<?php
ini_set("max_execution_time", "30000");
$upload_dir = wp_upload_dir(); 
$pngstring = $_POST["pngstring"];
$name = $_POST["imgname"];
$name = str_replace("https://".$_SERVER['HTTP_HOST']."/wp-content/uploads/", '',$name);
$image_path = urldecode( $upload_dir['basedir'] . '/' . $name);
$image_path = realpath($image_path);
$image_path = apply_filters( 'watermark_png_path',  $image_path );
$image_url = urldecode( $upload_dir['baseurl'] . '/' . $name);
$post_id = 0;
//**RealPath From stackoverflow.com**
//$str = "/images/test.jpg";
//$str = realpath($image_path);
/** */
if(isset($_POST["pngstring"])){
     $ifp = fopen($image_path, 'wb' ); 
     // split the string on commas
     // $data[ 0 ] == "data:image/png;base64"
     // $data[ 1 ] == <actual base64 string>
     $data = explode( ',', $pngstring);
     // we could add validation here with ensuring count( $data ) > 1
     fwrite( $ifp, base64_decode( $data[ 1 ] ) );
     $filetype = wp_check_filetype( basename( $image_path ), null );
     $attachment = array(
          'guid'           => $image_url,
          'post_mime_type' => $filetype['type'],
          'post_title'     => preg_replace( '/\.[^.]+$/', '', $name ),
          'post_content'   => '',
          'post_status'    => 'inherit'
         );
     // clean up the file resource
     fclose( $ifp ); 
         // Make sure that this file is included, as   wp_generate_attachment_metadata() depends on it.
     require_once( ABSPATH . 'wp-admin/includes/image.php' );
     $attach_id = wp_insert_attachment( $attachment, $image_path, $post_id );
     $attach_data = wp_generate_attachment_metadata( $attach_id, $image_path );
     wp_update_attachment_metadata( $attach_id, $attach_data );
     wp_send_json_success($image_url);
     wp_die();

}else{
wp_send_json_error($image_url);
wp_die();

}