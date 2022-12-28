<?php
/*ggskj
  $event = json_decode($rdata);
  if( post_exists($event['musicname']) == 0 ) {
	$new_post = array(
    'post_title' => $name,
    'post_status'   => 'publish',
    'post_content'   => $event['descriptionlink'],
	'post_type' => 'music'
	);
    if ($pid = wp_insert_post($new_post)){
	update_field('field_6383ae92b26dc', $event['artfirstn'], $pid);
	update_field('field_6383ae9bb26dd', $event['artlastn'], $pid);
	update_field('field_627885d01bd4e', $event['musicname'], $pid);
	update_field('field_627886021bd50', $event['musicgenre'], $pid);
	update_field('field_6278862f1bd52', $event['downloadklink'], $pid);
	update_field('field_628fe50acd000', $event['musicpeakurl'], $pid);
	update_field('field_6278863e1bd53', $event['musiccoverlink'], $pid);
	update_field('field_62f955f695168', $event['applelink'], $pid);
	update_field('field_62f9561095169', $event['spotifylink'], $pid);
	update_field('field_62f956259516a', $event['youtubelink'], $pid);
	update_field('field_62f956359516b', $event['deezerlink'], $pid);
	update_field('field_62f9564a9516c', $event['googleplaylink'], $pid);
	update_field('field_62f956629516d', $event['amazonlink'], $pid);
	update_field('field_62f9566b9516e', $event['soundcloudlink'], $pid);
	update_field('field_62f956829516f', $event['boomplaylink'], $pid);
	update_field('field_62f9569d50915', $event['grovelink'], $pid);
	update_field('field_62f956ad50916', $event['shazamlink'], $pid);
	update_field('field_62f956ca50917', $event['tidallink'], $pid);
	update_field('field_62fcf9c2b0bdd', $event['tiktoklink'], $pid);
	update_field('field_62fcfb15b0bde', $event['twitterlink'], $pid);
	update_field('field_6383aeaab26de', $event['audiomacklink'], $pid);
	update_field('field_6383aeb4b26df', $event['descriptionlink'], $pid);
	update_field('field_6383aed7b26e0', $event['facebooklink'], $pid);
	update_field('field_6383aee0b26e1', $event['instgramlink'], $pid);
	update_field('field_638918ed390f5', $event['artstagename'], $pid);
	set_post_thumbnail($pid,$thumbid);	
	} else {} } else { 

    }
	try { } catch (\Throwable $th) { $rdata = $th->getMessage(); }
*/
$pdata= $_REQUEST["pdatas"];
if( post_exists($pdata['field_627885d01bd4e']) == 0 ) {
  $new_post = array(
  'post_title' => $pdata['field_627885d01bd4e'],
  'post_status'   => 'draft',
  'post_content'   => $pdata['field_6383aeb4b26df'],
  'post_type' => 'music'
  );
  if ($pid = wp_insert_post($new_post)){
      foreach($pdata as $key => $value) { update_field($key,  $value, $pid); } 
	}
  wp_send_json_success($pid);
}else{
wp_send_json_error("Music Already Exit");
}

wp_die();	

?>