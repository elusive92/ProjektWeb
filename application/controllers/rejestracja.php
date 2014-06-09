<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rejestracja extends MY_Controller {

	public function index() {

		$page_data = $this->data;

		if($this->input->post()) {

			$this->form_validation->set_rules('login', 'login', 'trim|required|max_length[30]|callback_unique_login');
			$this->form_validation->set_rules('pass', 'hasło', 'trim|required');
			$this->form_validation->set_rules('passconf', 'powtórz hasło', 'trim|required|matches[pass]');
			$this->form_validation->set_rules('nick', 'nick', 'trim|required');
			$this->form_validation->set_rules('province', 'województwo', 'required');
			$this->form_validation->set_rules('place', 'miejscowość', 'required');

			if($this->form_validation->run() == true) {

				$this->db->insert('accounts', array(
					'login' => $this->input->post('login'),
					'password' => hash('sha256', $this->input->post('pass'))
				));

				$last_id = $this->db->insert_id();

				$this->db->insert('artists', array(
					'artist_account_id' => $last_id,
					'nick' => $this->input->post('nick'),
					'instrument' => $this->input->post('instrument'),
					'place_id' => $this->input->post('place'),
					'bio' => $this->input->post('bio')
				));

				$this->session->set_userdata('user_id', $last_id);
				header('Location: /twoje-konto');

			}
			else {
				$page_data['validation_errors'] = validation_errors();
			}

		}

		if($this->input->post('place')) {
			$page_data['selected_place'] = $this->db
			->get_where('places', array('place_id' => $this->input->post('place')))
			->row();
		}

		$page_data['provinces'] = $this->db->get('provinces')->result();

		$data['page'] = $this->load->view('rejestracja', $page_data, true);
		$this->load->view('templates/layout', $data);

	}

	public function logincheck() {

		header('content-type: text/json');

		if(!isSet($_POST['login']))
			exit();

		$data = $this->db->get_where('accounts', array('login' => $_POST['login']))->result();
		echo json_encode(array('login_exists' => count($data) > 0));

	}

	public function get_places() {

		if(!isSet($_GET['province_id']))
			exit();

		$data = $this->db->from('places')
			->where(array('province_id' => $_GET['province_id']))
			->order_by('place_name', 'asc')
			->get()->result();

		if(count($data) > 0) {
			foreach($data as $d) {
				echo '<option value='.$d->place_id.'>'.$d->place_name.'</option>';
			}
		}

	}

	public function unique_login($login) {

		$arr = $this->db->get_where('accounts', array('login' => $login))->result();
		if(count($arr) > 0) {

			$this->form_validation->set_message('unique_login', 'Podany login znajduje się już w bazie.');
			return false;

		}
		else {
			return true;
		}

	}

}
