<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Zespoly extends MY_Controller {

	public function index() {

		$data['page'] = $this->load->view('zespoly', $this->data, true);
		$this->load->view('templates/layout', $data);

	}
}
