<?php
/*
 * Plugin Name: WPDEFT A000249
 * Version: 2.3
 * Plugin URI: https://wpdeft.com/
 * Description: Freshdesk ticket status
 * Author: MOHAMMAD
 * Author URI: https://wpdeft.com/
 */

if(!function_exists('wp_get_current_user')) {
    include(ABSPATH . "wp-includes/pluggable.php"); 
}

add_action( 'wp_enqueue_scripts', 'wpdeft_script_and_styles');
 
function wpdeft_script_and_styles() {
    
 
    // when you use wp_localize_script(), do not enqueue the target script immediately
    wp_register_script( 'wpdeft_scripts', plugin_dir_url( __FILE__ ) . 'js/wpdeft.js', array('jquery') );
    
}
add_action('wp_ajax_freshdesk', 'wpdeft_freshdesk');
add_action('wp_ajax_nopriv_freshdesk', 'wpdeft_freshdesk');
 
function wpdeft_freshdesk(){
 $id = $_POST['id'];
    
    $email = "info@photopatic.com";
$password = "Akira.888888001122";
$key = "ovIxrkRTSMaljAkKNmY"; // (This parameter is used?)    
$url = "https://newaccount1616329019399.freshdesk.com/api/api/v2/tickets/[id]?include=stats";

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_USERPWD, "$api_key:$password");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec($ch);
$info = curl_getinfo($ch);
$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$headers = substr($server_output, 0, $header_size);
$response = substr($server_output, $header_size);

if($info['http_code'] == 200) {
  echo "Tickets fetched successfully, the response is given below \n";
  echo "Response Headers are \n";
  echo $headers."\n";
  echo "Response Body \n";
  echo "$response \n";
} else {
  if($info['http_code'] == 404) {
    echo "Error, Please check the end point \n";
  } else {
    echo "Error, HTTP Status Code : " . $info['http_code'] . "\n";
    echo "Headers are ".$headers;
    echo "Response are ".$response;
  }
}

curl_close($ch);
}
?>
