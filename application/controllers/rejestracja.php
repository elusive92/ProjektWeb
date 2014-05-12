<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rejestracja extends MY_Controller {

	public function index() {

		$page_data = $this->data;

		if($this->input->post()) {

			$this->form_validation->set_rules('login', 'login', 'trim|required|max_length[30]');
			$this->form_validation->set_rules('pass', 'hasło', 'trim|required');
			$this->form_validation->set_rules('passconf', 'powtórz hasło', 'trim|required|matches[pass]');
			$this->form_validation->set_rules('nick', 'nick', 'trim|required');

			if($this->form_validation->run() == true) {

				

			}
			else {
				$page_data['validation_errors'] = validation_errors();
			}

		}

		$data['page'] = $this->load->view('rejestracja', $page_data, true);
		$this->load->view('templates/layout', $data);

	}
}
