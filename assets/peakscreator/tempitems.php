<?php
if(!isset($_POST['title']) || empty($_POST['title']))exit('Remote download missing title!');

$url = $_POST['id'];
$title = $_POST['title'];


if($_SERVER['HTTP_HOST'] == "localhost"){
    define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/');
    define('SITEPATH', $_SERVER['DOCUMENT_ROOT'] . '/');
}
else{ 
    define('SITE_URL', "http://" . $_SERVER['HTTP_HOST']);
    define('SITEPATH', $_SERVER['DOCUMENT_ROOT']);
}

$path = SITEPATH.'/'.'wp-content'.'/'.'uploads'.'/'.'peaks'.'/'.$title . '.mp3';  
//$path = get_template_directory().'/'.'assets/peakscreator'.'/'.$title . '.mp3';  


$response = wp_remote_get( 
    $url, 
    array( 
        'timeout'  => 300, 
        'stream'   => true, 
        'filename' => "TCS_CPDF_LOCAL_ZIP.mp3"
    ) 
);


print_r($response);





/*
$path_info = pathinfo($path);
$temp_file = download_files($url, ["Content-Type"=>"application/octet-stream"]);
copy($temp_file, $path_info['dirname'].'/'.$path_info['basename']);
@unlink($temp_file);
$res = SITE_URL.path2url(realpath($path_info['dirname'])).'/'.$path_info['basename'];
$resv = ["url" => $res,"title" => $path_info['basename'],"path"=>$path];
echo json_encode($resv);
wp_die();



function download_files($url, $headers = []) {
    // WARNING: The file is not automatically deleted, the script must unlink() the file.
    if ( ! $url ) {
        return new WP_Error( 'http_no_url', __( 'Invalid URL Provided.' ) );
    }
 
    $url_filename = basename( parse_url( $url, PHP_URL_PATH ) );
 
    $tmpfname = wp_tempnam( $url_filename );
    if ( ! $tmpfname ) {
        return new WP_Error( 'http_no_file', __( 'Could not create Temporary file.' ) );
    }
 
    $response = wp_safe_remote_get(
        $url,
        array(
            'timeout'  => 600,
            'stream'   => true,
            'filename' => $tmpfname,
            'headers'  => $headers
        )
    );
 
    if ( is_wp_error( $response ) ) {
        unlink( $tmpfname );
        return $response;
    }
 
    $response_code = wp_remote_retrieve_response_code( $response );
 
    if ( 200 != $response_code ) {
        $data = array(
            'code' => $response_code,
        );
 
        $tmpf = fopen( $tmpfname, 'rb' );
        if ( $tmpf ) {
            $response_size = apply_filters( 'download_url_error_max_body_size', KB_IN_BYTES );
            $data['body']  = fread( $tmpf, $response_size );
            fclose( $tmpf );
        }
 
        unlink( $tmpfname );
        return new WP_Error( 'http_404', trim( wp_remote_retrieve_response_message( $response ) ), $data );
    }
 
    return $tmpfname;
}


function path2url($dirname) {
    $arr = explode('public_html', $dirname);
    if(isset($arr[1]))return $arr[1];
    else return str_replace(SITEPATH, '', str_replace('\\', '/', $dirname));
}
*/