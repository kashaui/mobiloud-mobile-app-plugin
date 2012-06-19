<?php



//function that sets the last notified post
function ml_set_post_id_as_notified($postID)
{
	global $wpdb;
	$table_name = $wpdb->prefix . "mobiloud_notifications";
	$wpdb->insert( 
		$table_name, 
		array( 
			'time' => current_time("timestamp"),
			'post_id' => $postID, 
		)
	);	
}

function ml_is_notified($post_id)
{
	global $wpdb;
	$table_name = $wpdb->prefix . "mobiloud_notifications";
	$num = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE post_id = $post_id" ));
	return $num > 0;
}

function ml_post_published_notification($post_id)
{
	if(ml_is_notified($post_id))
		return;

	$post = get_post($post_id,OBJECT);
	
	$alert = $post->post_title;
	$custom_properties = array('post_id' => $post_id);
	
	ml_send_notification($alert, true,NULL,$custom_properties);
}



//true if the notification was sent successfully
//false if there was an error
function ml_send_notification($alert, $sound=true, $badge=NULL, $custom_properties=NULL)
{
	global $ml_api_key, $ml_secret_key, $ml_server_host;
	
	
	$notification = array('alert' => $alert);
	if($sound) $notification['sound'] = $sound;
	if($badge) $notification['badge'] = $badge;
	if($custom_properties) $notification['custom_properties'] = $custom_properties;

	$parameters = array(
		'api_key' => $ml_api_key,	
		'secret_key' => $ml_secret_key,	
		'notification' => $notification,
	);
	
	$request = new WP_Http;
	$url = "$ml_server_host/notifications/send";
	
	$result = $request->request($url,
		array('method' => 'POST', 'timeout' => 10,'body' => $parameters) );
	if($result)
	{
		$response = $result->response;
		
		if($response)
		{
			$r_code = $response['code'];
			return $r_code == 200;
		}		

	}
	return false;
} 


?>