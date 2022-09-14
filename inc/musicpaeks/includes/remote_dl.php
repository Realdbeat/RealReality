<?php 
/**
   * Save image on wp_upload_dir.
   * Add image to the media library and attach in the post.
   *
   * @param string $url image url
   * @param string $plugin
   * @param string $filename
   * @param string $caption
   * @param string $referer
   * @return int $attch_id
   */

//https://www.googleapis.com/drive/v3/files/1wN_gdgyV2QILRGWNemYx9uwqcKy7JU_n?key=AIzaSyC8MwkFenBO3K-d-F_qYfMiW5Sr43JfcVw

$typed = $_POST['type'];
switch ($typed) {
  case 'drive':
    gdrive();
    break;
  case 'ext':
    extdrive();
    break;  
  default:
  wp_send_json_error( "Type Not Fond and Type is ".$type); 
    break;
   }




function extdrive(){
 $title = $_POST['title'];
 $drive_file_url = $_POST['url'];
 $options = array();
 $attachment_id =  save_remote_file($drive_file_url,  $title, $options );
 if ($attachment_id[0] === false) {
  wp_send_json_error($attachment_id);
 }else{
 wp_send_json_success( $attachment_id ); } }

function gdrive(){
 $gdriveid = $_POST['url'];
 $title = $_POST['title'];
 $google_token = showapi();
 $google_drive_file_url = 'https://www.googleapis.com/drive/v2/files/' .$gdriveid. '?alt=media&key='.$google_token;
 $filen = $title;
 $options = array(
  'headers' => array(
    'Authorization: Bearer ' . $google_token,
  ),
 );
 $options = array(); 
 $attachment_id =  save_remote_file( $google_drive_file_url, $filen ,$options );
 if ($attachment_id !== false) {
  wp_send_json_success( $attachment_id ); 
 }else{
 wp_send_json_error($attachment_id );} }

function save_remote_file( $url, $filename = '', $options = array() ) {
    $attach_id = [];
    if ( !function_exists( 'curl_init' ) || empty( $filename ) ) {
      return;
    }

    // Check permissions.
    if (!current_user_can('upload_files')) {
      return;
    }

    // Sanitize filename.
    $filename = sanitize_file_name( $filename );

    $extensions = apply_filters( 'peaks_safe_extensions', 'jpg jpeg gif png mp3 mp4 m4v mov webm' );
    if (isUnsafe( $filename, $extensions )) {
      return;
    }

    $upload_dir = wp_upload_dir();
    $file_path = urldecode( $upload_dir['path'] . '/' . $filename );
    $file_url = urldecode( $upload_dir['url'] . '/' . $filename );

    // Make sure we don't upload the same file more than once.
    if ( !file_exists( $file_path ) ) {
     
      setlocale( LC_ALL, "en_US.UTF8" );
      $ch = curl_init( $url );
      if ( !empty( $options['headers'] ) ) {
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $options['headers'] );
      }
      curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
      curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
      curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
      curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 2 );
      // Spoof referrer to download remote media. 
      $file_contents = curl_exec( $ch );

      if ( $file_contents === false ) {
        return;
      }

      $file_type = curl_getinfo( $ch, CURLINFO_CONTENT_TYPE );
      $file_size = curl_getinfo( $ch, CURLINFO_SIZE_DOWNLOAD );


      $file_path = apply_filters( 'peaks_file_path', $file_path );
      $strtype = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
      curl_close( $ch ); 
      if (strpos($strtype, 'application/json') === false) {
      file_put_contents( $file_path, $file_contents );     
      $attach_id = array($file_path,$file_url);
      }else{
        $attach_id = false;
      }
       
    }else{
        // @unlink( $file_path ); 
        $attach_id = array($file_path,$file_url);
    }

    return $attach_id;
  }

  /**
   * Check if file extension is unsafe to upload.
   */
function isUnsafe( $filename, $extensions ) {
    if (preg_match('/\.(php|php2|php3|php4|php5|php6|php7|php8|phtml|phar|pl|py|cgi|asp|js|html|htm|xml)(\.|$)/i', $filename)) {
      $regex = '/\.(' . preg_replace('/ +/', '|', preg_quote($extensions)) . ')$/i';
      if (!preg_match($regex, $filename)) {
        return true;
      }
    }
  }




?>