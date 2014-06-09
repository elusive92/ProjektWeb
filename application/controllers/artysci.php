<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Artysci extends MY_Controller {

	public function index($p = 0) {

		$this->load->library('pagination');
		$page_data = $this->data;

		$config['base_url'] = '/artysci/index';
		$config['total_rows'] = $this->db->count_all_results('artists');
		$config['per_page'] = 12; 
		$this->pagination->initialize($config); 
		$page_data['pagination'] = $this->pagination->create_links();

		$artists = $this->db->from('artists')
			->join('accounts', 'artists.artist_account_id = accounts.account_id')
			->join('places', 'artists.place_id = places.place_id')
			->join('provinces', 'places.province_id = provinces.province_id');

		if(isSet($_GET['s'])) {
			$artists = $artists->like('nick', $_GET['s'], 'both');
		}

		$artists = $artists->order_by('artist_account_id', 'desc');

		if(isSet($p)) 
			$artists = $artists->limit($config['per_page'], $p);

		$artists = $artists->get()->result();
		$page_data['artists'] = $artists;

		$data['page'] = $this->load->view('artysci', $page_data, true);
		$this->load->view('templates/layout', $data);

	}

	public function pokaz($id) {

		if(empty($id))
			show_404();

		$page_data = $this->data;

		$page_data['artist'] = $this->db->from('artists')
			->join('accounts', 'artists.artist_account_id = accounts.account_id')
			->join('places', 'artists.place_id = places.place_id')
			->join('provinces', 'places.province_id = provinces.province_id')
			->where(array('artist_account_id' => $id))
			->get()->row();

		if(empty($page_data['artist']))
			show_404();

		$page_data['artist_bands'] = $this->db->from('members')
			->where(array('member_artist_id' => $id))
			->join('bands', 'members.member_band_id = bands.band_id')
			->get()->result();

		$page_data['artist_ads'] = $this->db
			->from('ads_artist')
			->where(array('ad_artist_id' => $id))
			->order_by('ad_id', 'DESC')
			->get()->result();

		$page_data['artist_audio'] = $this->db
			->from('audio_artist')
			->where(array('audio_artist_id' => $id))
			->order_by('audio_id', 'DESC')
			->get()->result();

		$data['page'] = $this->load->view('artysci_pokaz', $page_data, true);
		$this->load->view('templates/layout', $data);

	}

}
