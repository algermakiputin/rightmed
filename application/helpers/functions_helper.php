<?php 

function hasNotifications() {
 
	 $CI =& get_instance();
	 $user_id = $CI->db->where('account_id', $CI->session->userdata('userid'))
	 				->get('tbluser')
	 				->row()->id;

	 
	 $notifications = $CI->db->where("status", 0)
	 					->where('recipient', $user_id)
	 					->get("notifications")->result();
	 
	 return $notifications;
}

function dd($data) {
	echo "<pre>";
	print_r($data);
	echo "</pre>";
	die();
}