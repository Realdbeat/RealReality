<?php
$typed = $_POST['gdriveid'];
$custom_token = showapi();
//$url = "https://www.googleapis.com/drive/v3/files/".$typed."?".$customg_token;
$url = "https://www.googleapis.com/drive/v3/files/".$typed."?key=".$custom_token;
$respond = api_process(wp_remote_get($url, array('sslverify' => false)));
function api_process($result){
    if (is_wp_error($result)) {
        $errResult = array();
        $errResult['error']['message'] = "wp_remote_get() failed!";
        if (method_exists($result, 'get_error_message')) $errResult['error']['message'] .= " Message: " . $result->get_error_message();
        return $errResult;
}
    return json_decode($result['body'], true);
}

if (!$respond || isset($respond['error'])) {
wp_send_json_error($respond['error']['message']);
}else{
wp_send_json_success($respond);
}
?>