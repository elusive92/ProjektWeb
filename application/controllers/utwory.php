<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utwory extends MY_Controller {

	public function index() {

		$data['page'] = $this->load->view('utwory', $this->data, true);
		$this->load->view('templates/layout', $data);

	}
}
