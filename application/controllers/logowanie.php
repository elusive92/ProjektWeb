<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logowanie extends CI_Controller {

	public function index() {

		if($this->input->post()) {

			$query = $this->db->get_where('accounts', 
				array(
					'login' => $this->input->post('login'),
					'password' => hash('sha256', $this->input->post('password'))
				)
			);

			$result = $query->row();
			if(!empty($result)) {

				$this->session->set_userdata('user_id', $result->account_id);
				header("Location: /");

			}
			else {
				
				$this->session->set_userdata('invalid_login', true);
				header("Location: /".$this->input->post('back_uri'));

			}

		}
		else {
			header("Location: /");
		}

	}
}
