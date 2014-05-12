<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $data;

	public function __construct() {
		
		parent::__construct();
		$this->loadUserData();

		if(isSet($_GET['logout']) && $_GET['logout'] == 1) {
			$this->session->unset_userdata('user_id');
			header("Location: /");
		}

	}

	private function loadUserData() {
		if($this->session->userdata('user_id')) {
			$this->data['user'] = $this->db
				->get_where('artists', array('artist_account_id' => $this->session->userdata('user_id')))->row();
		}
	}
	
}
