<?php
ini_set("max_execution_time", "30000");
$upload_dir = wp_upload_dir(); 
$pngstring = $_POST["pngstring"];
$name = $_POST["name"];
$imageid = $_POST["imgid"];
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
     // clean up the file resource
     fclose( $ifp );
     //$image_path = str_replace(basename($image_path), '',$name);
     $nn = basename($image_path);
     $ext = $nn."-150x150";
     $image_del = str_replace($nn, $ext, $image_path);
     unlink($image_del);
     $ext = $nn."-300x180";
     $image_del = str_replace($nn, $ext, $image_path);
     unlink($image_del);
     $ext = $nn."-300x300";
     $image_del = str_replace($nn, $ext, $image_path);
     unlink($image_del);
     $ext = $nn."-400x240";
     $image_del = str_replace($nn, $ext, $image_path);
     unlink($image_del);
     $ext = $nn."-249x250";
     $image_del = str_replace($nn, $ext, $image_path);
     unlink($image_del);
     $ext = $nn."-598x600";
     $image_del = str_replace($nn, $ext, $image_path);
     unlink($image_del);
     //delete wordpress generate 150x150 300x180 300x300 400x240 249x250 598x600
     

     // Make sure that this file is included, as   wp_generate_attachment_metadata() depends on it.
     require_once( ABSPATH . 'wp-admin/includes/image.php' ); 
     $attachment = array(
        'guid'           => $image_url,
        'post_title'     => preg_replace( '/\.[^.]+$/', '', $nn." ~ Water Image" ),
        'post_content'   => '',
        'post_status'    => 'inherit'
       );

     wp_update_attachment_metadata( $imageid, $attach_data ); 
     wp_send_json_success($image_url);
     wp_die();

       }else{
       wp_send_json_error($image_url);
       wp_die();

}