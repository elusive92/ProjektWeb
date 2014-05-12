<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Artysci extends MY_Controller {

	public function index() {

		$data['page'] = $this->load->view('artysci', $this->data, true);
		$this->load->view('templates/layout', $data);

	}
}
