<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Twoje_Konto extends MY_Controller {

	public function __construct() {

		parent::__construct();

			$this->db->select('*');
			$this->db->from('artists');
			$this->db->join('accounts', 'artists.artist_account_id = accounts.account_id');
			$this->db->join('places', 'artists.place_id = places.place_id');
			$this->db->join('provinces', 'places.province_id = provinces.province_id');
			$this->db->where(array('artist_account_id' => $this->session->userdata('user_id')));
			$this->data['account'] = $this->db->get()->row();

	}

	public function index() {
		header("Location: /twoje-konto/informacje");
	}

	public function informacje() {

		if($this->input->post('informacje')) {

			$this->form_validation->set_rules('nick', 'nick', 'trim|required');
			$this->form_validation->set_rules('instrument', 'instrument', 'trim|required');
			
			if($this->form_validation->run() == true) {

				if($this->db->update('artists', array(
					'nick' => $this->input->post('nick'),
					'instrument' => $this->input->post('instrument'),
					'place_id' => $this->input->post('place'),
					'bio' => $this->input->post('bio')
				), array('artist_account_id' => $this->data['account']->artist_account_id))) {

					$this->session->set_userdata('success', true);
					header('Location: /twoje-konto');
				}
			}
			else {
				$this->data['validation_errors'] = validation_errors();
			}

		}
		else if($this->input->post('zdjecie')) {
			
			$config['upload_path'] = FCPATH.'/uploads/images/';
			$config['file_name'] = uniqid();
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '1000';
			$config['max_width']  = '2000';
			$config['max_height']  = '2000';
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('image')) {
				$error = array('error' => $this->upload->display_errors());
				var_dump($error);
			}
			else {
				
				$config2['image_library'] = 'gd2';
                $config2['source_image'] = $this->upload->upload_path.$this->upload->file_name;
                $config2['new_image'] = FCPATH.'/uploads/images/';
                $config2['maintain_ratio'] = TRUE;
                $config2['create_thumb'] = TRUE;
                $config2['thumb_marker'] = '_thumb';
                $config2['width'] = 80;
                $config2['height'] = 75;
                $this->load->library('image_lib',$config2);

                if($this->image_lib->resize()) {
                    	
                   	$this->db->update('artists', array('photo' => $this->upload->file_name), 
                    	array('artist_account_id' => $this->data['account']->artist_account_id));
					header('Location: /twoje-konto');
               	}

			}

		}
		else if($this->input->post('pass_change')) {

			$this->form_validation->set_rules('current_pass', 'aktualne hasło', 'required|callback_pass_check');
			$this->form_validation->set_rules('new_pass', 'nowe hasło', 'required');
			$this->form_validation->set_rules('new_pass_confirm', 'potwierdź hasło', 'required|matches[new_pass]');

			if($this->form_validation->run() == true) {

				if($this->db->update('accounts', array(
					'password' => hash('sha256', $this->input->post('new_pass'))
				), array('account_id' => $this->session->userdata('user_id')))) {
					$this->session->set_userdata('added');

					header('Location: /twoje-konto/informacje');
				}

			}
			else {
				$this->data['pass_validation_errors'] = validation_errors();
			}

		}

		$this->data['provinces'] = $this->db->get('provinces')->result();

		$page_data = $this->data;
		$page_data['subpage'] = $this->load->view('twoje_konto/informacje', $this->data, true);
		$data['page'] = $this->load->view('twoje_konto', $page_data, true);
		$this->load->view('templates/layout', $data);

	}

	public function pass_check($pass) {

		$arr = $this->db->get_where('accounts', array(
			'account_id' => $this->data['account']->account_id,
			'password' => hash('sha256', $pass)
		))->result();
		if(count($arr) < 1) {
			$this->form_validation->set_message('pass_check', 'Aktualne hasło jest nieprawidłowe.');
			return false;
		}
		else {
			return true;
		}
	}

	public function usun_zdjecie() {

		unlink(FCPATH.'/uploads/images/'.get_thumb_name($this->data['account']->photo));
		unlink(FCPATH.'/uploads/images/'.$this->data['account']->photo);
		$this->db->update('artists', 
			array('photo' => null), 
			array('artist_account_id' => $this->data['account']->artist_account_id));

		header('Location: /twoje-konto/informacje');

	}

	public function ogloszenia() {

		$user_ads = $this->db->get_where('ads_artist', array('ad_artist_id' => $this->session->userdata('user_id')))
			->result();

		$this->data['ads'] = $user_ads;

		$page_data = $this->data;
		$page_data['subpage'] = $this->load->view('twoje_konto/ogloszenia', $this->data, true);
		$data['page'] = $this->load->view('twoje_konto', $page_data, true);
		$this->load->view('templates/layout', $data);

	}

	public function dodaj_ogloszenie() {

		if($this->input->post()) {

			$this->form_validation->set_rules('title', 'tytuł ogłoszenia', 'trim|required');
			$this->form_validation->set_rules('content', 'treść ogłoszenia', 'trim|required');

			if($this->form_validation->run() == true) {

				if($this->db->insert('ads_artist', array(
					'ad_artist_id' => $this->session->userdata('user_id'),
					'ad_title' => $this->input->post('title'),
					'ad_content' => $this->input->post('content')
				))) {
					$this->session->set_userdata('added');

					header('Location: /twoje-konto/ogloszenia');
				}

			}
			else {
				$this->data['validation_errors'] = validation_errors();
			}

		}

		$page_data = $this->data;

		$page_data['subpage'] = $this->load->view('twoje_konto/ogloszenie_dodaj', $this->data, true);
		$data['page'] = $this->load->view('twoje_konto', $page_data, true);
		$this->load->view('templates/layout', $data);

	}

	public function edytuj_ogloszenie($ad_id) {

		if(empty($ad_id))
			show_404();

		$ad = $this->db->get_where('ads_artist', array('ad_id' => $ad_id))->row();
		if($ad->ad_artist_id != $this->data['account']->artist_account_id)
			show_404();

		$this->data['ad'] = $ad;

		if($this->input->post()) {

			$this->form_validation->set_rules('title', 'tytuł ogłoszenia', 'trim|required');
			$this->form_validation->set_rules('content', 'treść ogłoszenia', 'trim|required');

			if($this->form_validation->run() == true) {

				if($this->db->update('ads_artist', array(
					'ad_title' => $this->input->post('title'),
					'ad_content' => $this->input->post('content')
				), array('ad_id' => $ad_id))) {
					$this->session->set_userdata('added');

					header('Location: /twoje-konto/ogloszenia');
				}

			}
			else {
				$this->data['validation_errors'] = validation_errors();
			}

		}

		$page_data = $this->data;

		$page_data['subpage'] = $this->load->view('twoje_konto/ogloszenie_edytuj', $this->data, true);
		$data['page'] = $this->load->view('twoje_konto', $page_data, true);
		$this->load->view('templates/layout', $data);

	}

	public function usun_ogloszenie($ad_id) {

		if(empty($ad_id))
			show_404();

		$ad = $this->db->get_where('ads_artist', array('ad_id' => $ad_id))->row();
		if($ad->ad_artist_id != $this->data['account']->artist_account_id)
			show_404();

		if($this->db->delete('ads_artist', array('ad_id' => $ad_id)))
			header('Location: /twoje-konto/ogloszenia');

	}

	public function zespoly() {

		if($this->session->userdata('added'))
			$this->data['added'] = true;

		$user_bands = $this->db
			->from('bands')
			->join('members', 'bands.band_id = members.member_band_id')
			->where(array('member_artist_id' => $this->data['account']->artist_account_id))
			->get()->result();

		$this->data['user_bands'] = $user_bands;

		$page_data = $this->data;
		$page_data['subpage'] = $this->load->view('twoje_konto/zespoly', $this->data, true);
		$data['page'] = $this->load->view('twoje_konto', $page_data, true);
		$this->load->view('templates/layout', $data);

		$this->session->unset_userdata(array('added' => ''));

	}

	public function dodaj_zespol() {

		if($this->input->post()) {

			$this->form_validation->set_rules('name', 'nazwa zespołu', 'trim|required');
			$this->form_validation->set_rules('genre', 'gatunek', 'trim|required');
			$this->form_validation->set_rules('place', 'miejscowość', 'required');
			$this->form_validation->set_rules('role', 'twoja rola', 'required');

			if($this->form_validation->run() == true) {

				if($this->db->insert('bands', array(
					'band_artist_id' => $this->session->userdata('user_id'),
					'name' => $this->input->post('name'),
					'genre' => $this->input->post('genre'),
					'place_id' => $this->input->post('place'),
					'bio' => $this->input->post('bio')
				))) {
					$this->session->set_userdata('added');

					$band_id = $this->db->insert_id();

					$this->db->insert('members', array(
						'member_band_id' => $band_id,
						'member_artist_id' => $this->session->userdata('user_id'),
						'role' => $this->input->post('role')
					));

					header('Location: /twoje-konto/zespoly');
				}

			}
			else {
				$this->data['validation_errors'] = validation_errors();
			}

		}

		if($this->input->post('place')) {
			$this->data['selected_place'] = $this->db
			->get_where('places', array('place_id' => $this->input->post('place')))
			->row();
		}

		$this->data['provinces'] = $this->db->get('provinces')->result();

		$page_data = $this->data;
		$page_data['subpage'] = $this->load->view('twoje_konto/zespol_dodaj', $this->data, true);
		$data['page'] = $this->load->view('twoje_konto', $page_data, true);
		$this->load->view('templates/layout', $data);

	}

	public function usun_zespol($id) {

		$band = $this->db->get_where('bands', array('band_id' => $id))->row();
		if(empty($band))
			show_404();
		if($band->band_artist_id != $this->session->userdata('user_id'))
			show_404();

		// delete members
		$this->db->delete('members', array('member_band_id' => $id));

		// delete ads
		$this->db->delete('ads_band', array('ad_band_id' => $id));

		// delete audio
		$this->db->delete('audio_band', array('audio_band_id' => $id));

		// delete band
		$this->db->delete('bands', array('band_id' => $id));

		header("Location: /twoje-konto/zespoly");

	}

	public function utwory() {

		$audio = $this->db->get_where('audio_artist', array('audio_artist_id' => $this->session->userdata('user_id')))
			->result();

		$this->data['audio'] = $audio;

		$page_data = $this->data;
		$page_data['subpage'] = $this->load->view('twoje_konto/utwory', $this->data, true);
		$data['page'] = $this->load->view('twoje_konto', $page_data, true);
		$this->load->view('templates/layout', $data);

	}

	public function dodaj_utwor() {

		if($this->input->post()) {

			$this->form_validation->set_rules('title', 'tytuł utworu', 'trim|required');
			$this->form_validation->set_rules('description', 'opis utworu', 'trim');

			if($this->form_validation->run() == true) {

				$config['upload_path'] = FCPATH.'/uploads/audio/';
				$config['file_name'] = uniqid();
				$config['allowed_types'] = 'mp3';
				$config['max_size']	= '5000';
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('file')) {
					$error = array('error' => $this->upload->display_errors());
					var_dump($error);
				}
				else {

					if($this->db->insert('audio_artist', array(
						'audio_artist_id' => $this->session->userdata('user_id'),
						'audio_title' => $this->input->post('title'),
						'audio_description' => $this->input->post('description'),
						'audio_file' => $this->upload->file_name
					))) {
						$this->session->set_userdata('added');

						header('Location: /twoje-konto/utwory');
					}
				}
			}
			else {
				$this->data['validation_errors'] = validation_errors();
			}

		}

		$page_data = $this->data;

		$page_data['subpage'] = $this->load->view('twoje_konto/utwor_dodaj', $this->data, true);
		$data['page'] = $this->load->view('twoje_konto', $page_data, true);
		$this->load->view('templates/layout', $data);

	}

	public function edytuj_utwor($audio_id) {

		if(empty($audio_id))
			show_404();

		$audio = $this->db->get_where('audio_artist', array('audio_id' => $audio_id))->row();
		if($audio->audio_artist_id != $this->data['account']->artist_account_id)
			show_404();

		$this->data['audio'] = $audio;

		if($this->input->post()) {

			$this->form_validation->set_rules('title', 'tytuł utworu', 'trim|required');
			$this->form_validation->set_rules('description', 'opis utworu', 'trim');

			if($this->form_validation->run() == true) {


				if($this->db->update('audio_artist', array(
					'audio_title' => $this->input->post('title'),
					'audio_description' => $this->input->post('description')
				), array('audio_artist_id' => $this->session->userdata('user_id')))) {
					$this->session->set_userdata('added');
						header('Location: /twoje-konto/utwory');
				}
				
			}
			else {
				$this->data['validation_errors'] = validation_errors();
			}

		}

		$page_data = $this->data;

		$page_data['subpage'] = $this->load->view('twoje_konto/utwor_edytuj', $this->data, true);
		$data['page'] = $this->load->view('twoje_konto', $page_data, true);
		$this->load->view('templates/layout', $data);

	}

	public function usun_utwor($audio_id) {

		if(empty($audio_id))
			show_404();

		$audio = $this->db->get_where('audio_artist', array('audio_id' => $audio_id))->row();
		if($audio->audio_artist_id != $this->data['account']->artist_account_id)
			show_404();

		if($this->db->delete('audio_artist', array('audio_id' => $audio_id))) {

			unlink(FCPATH.'/uploads/audio/'.$audio->audio_file);
			header('Location: /twoje-konto/utwory');

		}

	}

}
