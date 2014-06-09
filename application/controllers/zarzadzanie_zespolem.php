<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Zarzadzanie_Zespolem extends MY_Controller {

	public function check($id) {

		$this->db->select('*');
		$this->db->from('bands');
		$this->db->join('places', 'bands.place_id = places.place_id');
		$this->db->join('provinces', 'places.province_id = provinces.province_id');
		$this->db->join('members', 'bands.band_id = members.member_band_id');
		$this->db->where(array('band_id' => $id, 'member_artist_id' => $this->session->userdata('user_id')));
		$band = $this->db->get()->row();

		if(empty($band))
			show_404();
		$this->band = $band;

	}

	public function check_admin($id) {

		$this->db->select('*');
		$this->db->from('bands');
		$this->db->join('places', 'bands.place_id = places.place_id');
		$this->db->join('provinces', 'places.province_id = provinces.province_id');
		$this->db->where(array('band_id' => $id, 'band_artist_id' => $this->session->userdata('user_id')));
		$band = $this->db->get()->row();

		if(empty($band))
			show_404();
		$this->band = $band;
	}

	public function index($id) {
		header('Location: /zarzadzanie-zespolem/'.$id.'/informacje');
	}

	public function informacje($id) {
		$this->check($id);

		if($this->input->post('informacje')) {

			$this->form_validation->set_rules('name', 'nazwa zespołu', 'trim|required');
			$this->form_validation->set_rules('genre', 'gatunek', 'trim|required');
			$this->form_validation->set_rules('place', 'miejscowość', 'required');
			
			if($this->form_validation->run() == true) {

				if($this->db->update('bands', array(
					'name' => $this->input->post('name'),
					'genre' => $this->input->post('genre'),
					'place_id' => $this->input->post('place'),
					'bio' => $this->input->post('bio')
				), array('band_id' => $this->band->band_id))) {

					$this->session->set_userdata('success', true);
					header('Location: /zarzadzanie-zespolem/'.$this->band->band_id);
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
                    	
                   	$this->db->update('bands', array('photo' => $this->upload->file_name), 
                    	array('band_id' => $this->band->band_id));
					header('Location: /zarzadzanie-zespolem/'.$this->band->band_id);
               	}

			}

		}

		$this->data['provinces'] = $this->db->get('provinces')->result();

		$page_data = $this->data;
		$this->data['band'] = $this->band;

		$page_data['subpage'] = $this->load->view('zarzadzanie_zespolem/informacje', $this->data, true);
		$data['page'] = $this->load->view('zarzadzanie_zespolem', $page_data, true);
		$this->load->view('templates/layout', $data);

	}

	public function usun_zdjecie($id) {
		$this->check($id);

		unlink(FCPATH.'/uploads/images/'.get_thumb_name($this->band->photo));
		unlink(FCPATH.'/uploads/images/'.$this->band->photo);
		$this->db->update('bands', 
			array('photo' => null), 
			array('band_id' => $this->band->band_id));

		header('Location: /zarzadzanie-zespolem/'.$this->band->band_id);

	}

	public function czlonkowie($id) {
		$this->check($id);

		$members = $this->db
			->from('artists')
			->join('members', 'artists.artist_account_id = members.member_artist_id')
			->where(array('members.member_band_id' => $this->band->band_id))
			->get()->result();

		foreach($members as $mem)
			$mem_ids[] = $mem->artist_account_id;

		$artists = $this->db
			->from('artists')
			->where_not_in('artist_account_id', $mem_ids)
			->order_by('nick', 'asc')
			->get()->result();

		$this->data['members'] = $members;
		$this->data['band'] = $this->band;
		$this->data['artists'] = $artists;

		if($this->input->post()) {

			$this->form_validation->set_rules('member_id', 'artysta', 'required');
			$this->form_validation->set_rules('role', 'rola', 'trim|required');

			if($this->form_validation->run() == true) {

				if($this->db->insert('members', array(
					'member_artist_id' => $this->input->post('member_id'),
					'member_band_id' => $id,
					'role' => $this->input->post('role')
				))) {
					$this->session->set_userdata('added');
					header('Location: /zarzadzanie-zespolem/'.$this->band->band_id.'/czlonkowie');
				}

			}
			else {
				$this->data['validation_errors'] = validation_errors();
			}
			
		}
		
		$page_data = $this->data;
		$page_data['subpage'] = $this->load->view('zarzadzanie_zespolem/czlonkowie', $this->data, true);
		$data['page'] = $this->load->view('zarzadzanie_zespolem', $page_data, true);
		$this->load->view('templates/layout', $data);

	}

	public function get_selected_member() {

		if(empty($_GET['id']))
			exit();

		$mem = $this->db->from('artists')
			->join('accounts', 'artists.artist_account_id = accounts.account_id')
			->join('places', 'artists.place_id = places.place_id')
			->join('provinces', 'places.province_id = provinces.province_id')
			->where(array('artist_account_id' => $_GET['id']))->get()->row();

		if(empty($mem))
			exit();

		?>
		<div class="col-md-12 band-box">
	      <div class="artist-box">
	        <div class="thumb">
	          <img src="<?=get_thumb($mem->photo)?>">
	        </div>
	        <p class="nick">
	          <a href="/artysci/pokaz/<?=$mem->artist_account_id?>">
	            <?=$mem->nick?>
	          </a>
	        </p>
	        <p class="instrument"><?=$mem->instrument?></p>
	        <p class="place"><?=$mem->place_name?></p>
	      </div>        
	    </div>
	    <?php

	}

	public function usun_czlonka($id, $mem_id) {
		$this->check($id);

		if(empty($mem_id))
			show_404();

		$mem = $this->db->get_where('members', array('member_band_id' => $id, 'member_artist_id' => $mem_id))
			->row();

		if(empty($mem))
			show_404();

		$this->db->delete('members', array('member_artist_id' => $mem_id, 'member_band_id' => $id));

		if($mem->member_artist_id == $this->session->userdata('user_id'))
			header('Location: /twoje-konto/zespoly');
		else
			header('Location: /zarzadzanie-zespolem/'.$this->band->band_id.'/czlonkowie');

	}

	public function ogloszenia($id) {
		$this->check($id);

		$band_ads = $this->db->get_where('ads_band', array('ad_band_id' => $id))
			->result();

		$this->data['ads'] = $band_ads;

		$page_data = $this->data;
		$this->data['band'] = $this->band;

		$page_data['subpage'] = $this->load->view('zarzadzanie_zespolem/ogloszenia', $this->data, true);
		$data['page'] = $this->load->view('zarzadzanie_zespolem', $page_data, true);
		$this->load->view('templates/layout', $data);

	}

	public function dodaj_ogloszenie($id) {
		$this->check($id);

		if($this->input->post()) {

			$this->form_validation->set_rules('title', 'tytuł ogłoszenia', 'trim|required');
			$this->form_validation->set_rules('content', 'treść ogłoszenia', 'trim|required');

			if($this->form_validation->run() == true) {

				if($this->db->insert('ads_band', array(
					'ad_band_id' => $this->band->band_id,
					'ad_title' => $this->input->post('title'),
					'ad_content' => $this->input->post('content')
				))) {
					$this->session->set_userdata('added');

					header('Location: /zarzadzanie-zespolem/'.$this->band->band_id.'/ogloszenia');
				}

			}
			else {
				$this->data['validation_errors'] = validation_errors();
			}

		}

		$this->data['band'] = $this->band;
		$page_data = $this->data;

		$page_data['subpage'] = $this->load->view('zarzadzanie_zespolem/ogloszenie_dodaj', $this->data, true);
		$data['page'] = $this->load->view('zarzadzanie_zespolem', $page_data, true);
		$this->load->view('templates/layout', $data);

	}

	public function edytuj_ogloszenie($id, $ad_id) {
		$this->check($id);

		if(empty($ad_id))
			show_404();

		$ad = $this->db->get_where('ads_band', array('ad_id' => $ad_id))->row();
		if($ad->ad_band_id != $id)
			show_404();

		$this->data['ad'] = $ad;

		if($this->input->post()) {

			$this->form_validation->set_rules('title', 'tytuł ogłoszenia', 'trim|required');
			$this->form_validation->set_rules('content', 'treść ogłoszenia', 'trim|required');

			if($this->form_validation->run() == true) {

				if($this->db->update('ads_band', array(
					'ad_title' => $this->input->post('title'),
					'ad_content' => $this->input->post('content')
				), array('ad_id' => $ad_id))) {
					$this->session->set_userdata('added');

					header('Location: /zarzadzanie-zespolem/'.$this->band->band_id.'/ogloszenia');
				}

			}
			else {
				$this->data['validation_errors'] = validation_errors();
			}

		}

		$this->data['band'] = $this->band;
		$page_data = $this->data;

		$page_data['subpage'] = $this->load->view('zarzadzanie_zespolem/ogloszenie_edytuj', $this->data, true);
		$data['page'] = $this->load->view('zarzadzanie_zespolem', $page_data, true);
		$this->load->view('templates/layout', $data);

	}

	public function usun_ogloszenie($id, $ad_id) {
		$this->check($id);

		if(empty($ad_id))
			show_404();

		$ad = $this->db->get_where('ads_band', array('ad_id' => $ad_id))->row();
		if($ad->ad_band_id != $id)
			show_404();

		if($this->db->delete('ads_band', array('ad_id' => $ad_id)))
			header('Location: /zarzadzanie-zespolem/'.$this->band->band_id.'/ogloszenia');

	}

	public function utwory($id) {
		$this->check($id);

		$audio = $this->db->get_where('audio_band', array('audio_band_id' => $id))
			->result();

		$this->data['audio'] = $audio;
		$this->data['band'] = $this->band;

		$page_data = $this->data;
		$page_data['subpage'] = $this->load->view('zarzadzanie_zespolem/utwory', $this->data, true);
		$data['page'] = $this->load->view('zarzadzanie_zespolem', $page_data, true);
		$this->load->view('templates/layout', $data);

	}

	public function dodaj_utwor($id) {
		$this->check($id);

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

					if($this->db->insert('audio_band', array(
						'audio_band_id' => $id,
						'audio_title' => $this->input->post('title'),
						'audio_description' => $this->input->post('description'),
						'audio_file' => $this->upload->file_name
					))) {
						$this->session->set_userdata('added');

						header('Location: /zarzadzanie-zespolem/'.$this->band->band_id.'/utwory');
					}
				}
			}
			else {
				$this->data['validation_errors'] = validation_errors();
			}

		}

		$this->data['band'] = $this->band;
		$page_data = $this->data;

		$page_data['subpage'] = $this->load->view('zarzadzanie_zespolem/utwor_dodaj', $this->data, true);
		$data['page'] = $this->load->view('zarzadzanie_zespolem', $page_data, true);
		$this->load->view('templates/layout', $data);

	}

	public function edytuj_utwor($id, $audio_id) {
		$this->check($id);

		if(empty($audio_id))
			show_404();

		$audio = $this->db->get_where('audio_band', array('audio_id' => $audio_id))->row();
		if($audio->audio_band_id != $id)
			show_404();

		$this->data['audio'] = $audio;

		if($this->input->post()) {

			$this->form_validation->set_rules('title', 'tytuł utworu', 'trim|required');
			$this->form_validation->set_rules('description', 'opis utworu', 'trim');

			if($this->form_validation->run() == true) {


				if($this->db->update('audio_band', array(
					'audio_title' => $this->input->post('title'),
					'audio_description' => $this->input->post('description')
				), array('audio_band_id' => $id))) {
					$this->session->set_userdata('added');
						header('Location: /zarzadzanie-zespolem/'.$this->band->band_id.'/utwory');
				}
				
			}
			else {
				$this->data['validation_errors'] = validation_errors();
			}

		}

		$this->data['band'] = $this->band;
		$page_data = $this->data;

		$page_data['subpage'] = $this->load->view('zarzadzanie_zespolem/utwor_edytuj', $this->data, true);
		$data['page'] = $this->load->view('zarzadzanie_zespolem', $page_data, true);
		$this->load->view('templates/layout', $data);

	}

	public function usun_utwor($id, $audio_id) {
		$this->check($id);

		if(empty($audio_id))
			show_404();

		$audio = $this->db->get_where('audio_band', array('audio_id' => $audio_id))->row();
		if($audio->audio_band_id != $id)
			show_404();

		if($this->db->delete('audio_band', array('audio_id' => $audio_id))) {

			unlink(FCPATH.'/uploads/audio/'.$audio->audio_file);
			header('Location: /zarzadzanie-zespolem/'.$this->band->band_id.'/utwory');

		}

	}

}
