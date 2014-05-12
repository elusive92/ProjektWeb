<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ogloszenia extends MY_Controller {

	public function index() {

		$data['page'] = $this->load->view('ogloszenia', $this->data, true);
		$this->load->view('templates/layout', $data);

	}
}
