<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Zespoly extends MY_Controller {

	public function index($p = 0) {

		$this->load->library('pagination');
		$page_data = $this->data;

		$config['base_url'] = '/artysci/index';
		$config['total_rows'] = $this->db->count_all_results('artists');
		$config['per_page'] = 12; 
		$this->pagination->initialize($config); 
		$page_data['pagination'] = $this->pagination->create_links();

		$bands = $this->db->from('bands')
			->join('places', 'bands.place_id = places.place_id')
			->join('provinces', 'places.province_id = provinces.province_id');

		if(isSet($_GET['s'])) {
			$bands = $bands->like('name', $_GET['s'], 'both');
		}

		$bands = $bands->order_by('band_id', 'desc');

		if(isSet($p)) 
			$bands = $bands->limit($config['per_page'], $p);

		$bands = $bands->get()->result();
		$page_data['bands'] = $bands;

		$data['page'] = $this->load->view('zespoly', $page_data, true);
		$this->load->view('templates/layout', $data);

	}

	public function pokaz($id) {

		if(empty($id))
			show_404();

		$page_data = $this->data;

		$page_data['band'] = $this->db->from('bands')
			->join('places', 'bands.place_id = places.place_id')
			->join('provinces', 'places.province_id = provinces.province_id')
			->where(array('band_id' => $id))
			->get()->row();

		if(empty($page_data['band']))
			show_404();

		$page_data['band_members'] = $this->db->from('members')
			->where(array('member_band_id' => $id))
			->join('artists', 'members.member_artist_id = artists.artist_account_id')
			->get()->result();

		$page_data['band_ads'] = $this->db
			->from('ads_band')
			->where(array('ad_band_id' => $id))
			->order_by('ad_id', 'DESC')
			->get()->result();

		$page_data['band_audio'] = $this->db
			->from('audio_band')
			->where(array('audio_band_id' => $id))
			->order_by('audio_id', 'DESC')
			->get()->result();

		$data['page'] = $this->load->view('zespoly_pokaz', $page_data, true);
		$this->load->view('templates/layout', $data);

	}
}
