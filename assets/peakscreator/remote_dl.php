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
$title = $_POST['title']; 



//https://www.googleapis.com/drive/v3/files/1wN_gdgyV2QILRGWNemYx9uwqcKy7JU_n?key=AIzaSyC8MwkFenBO3K-d-F_qYfMiW5Sr43JfcVw

$google_token = "AIzaSyC8MwkFenBO3K-d-F_qYfMiW5Sr43JfcVw";
$google_drive_file_url = 'https://www.googleapis.com/drive/v2/files/' . $title . '?alt=media&key='.$google_token;
$filen = $title.".mp3";
$options = array(
  'headers' => array(
    'Authorization: Bearer ' . $google_token,
  ),
);
$attachment_id =  save_remote_file( $google_drive_file_url, $filen , $referer, $options );
if ( !$attachment_id === "error") {wp_send_json_success( $attachment_id ); }else{ wp_send_json_error($attachment_id );}
  




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

      curl_close( $ch );

      $file_path = apply_filters( 'peaks_file_path', $file_path );
 
      if (curl_getinfo($ch, CURLINFO_CONTENT_TYPE) === "audio/mpeg" ) {
      file_put_contents( $file_path, $file_contents );     
      $attach_id = $file_path;
      }else{
        $attach_id = "error";
      }
      
    }else{
        // @unlink( $file_path );
        $attach_id = $file_path;
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