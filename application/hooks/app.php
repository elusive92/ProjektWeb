<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App {

	private $ci;

	public function __construct() {

		$this->ci =& get_instance();

	}

	public function index() {

		$data = [];

		if($this->ci->session->userdata('user_id')) {
			$data['user'] = $this->ci->db->get_where('artists', array('artist_id' => $this->ci->session->userdata('user_id')))->row();
			$this->ci->user = $data['user'];
		}

	}
}
