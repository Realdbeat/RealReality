<?php
// require wp-load.php to use built-in WordPress functions
require_once("../../wp-load.php");
// Wordpress Post ID for featured image to be set
$postId = '5342';
// image to be uploaded to WordPress and set as featured image
$IMGFileName = 'turkey.png';
// current path directory
$dirPath = getcwd();
// full path of image
$IMGFilePath = $dirPath.'/'.$IMGFileName;
// error message for file not found in directory
$message = $IMGFileName.' is not available or found in directory.';
// does image file exist in directory
if(file_exists($IMGFileName)){
//prepare upload image to WordPress Media Library
$upload = wp_upload_bits($IMGFileName , null, file_get_contents($IMGFilePath, FILE_USE_INCLUDE_PATH));
// check and return file type
$imageFile = $upload['file'];
$wpFileType = wp_check_filetype($imageFile, null);
// Attachment attributes for file
$attachment = array(
'post_mime_type' => $wpFileType['type'],  // file type
'post_title' => sanitize_file_name($imageFile),  // sanitize and use image name as file name
'post_content' => '',  // could use the image description here as the content
'post_status' => 'inherit'
);
// insert and return attachment id
$attachmentId = wp_insert_attachment( $attachment, $imageFile, $postId );
// insert and return attachment metadata
$attachmentData = wp_generate_attachment_metadata( $attachmentId, $imageFile);
// update and return attachment metadata
wp_update_attachment_metadata( $attachmentId, $attachmentData );
// finally, associate attachment id to post id
$success = set_post_thumbnail( $postId, $attachmentId );
// was featured image associated with post?
if($success){
$message = $IMGFileName.' has been added as featured image to post.';
} else {
$message = $IMGFileName.' has NOT been added as featured image to post.';
}
} 
echo $message;
?>