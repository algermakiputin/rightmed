<?php 

class NotificationController extends CI_Controller {
	
	public function viewed() {
		return $this->db->where('recipient', $this->input->post('id'))
				->where('status', 0)
				->update('notifications', [
						'status' => 1
					]);
	}
}