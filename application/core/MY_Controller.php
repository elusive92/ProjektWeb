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

			$this->db->select('*');
			$this->db->from('artists');
			$this->db->join('accounts', 'artists.artist_account_id = accounts.account_id');
			$this->db->join('places', 'artists.place_id = places.place_id');
			$this->db->join('provinces', 'places.province_id = provinces.province_id');
			$this->db->where(array('artist_account_id' => $this->session->userdata('user_id')));
			$this->data['user'] = $this->db->get()->row();

			//var_dump($this->data['user']);

		}
	}
	
}
