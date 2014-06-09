<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	public function index() {

		$page_data = $this->data;

		$page_data['artists_ads'] = $this->db
			->from('ads_artist')
			->join('artists', 'artists.artist_account_id = ads_artist.ad_artist_id')
			->order_by('ad_id', 'DESC')
			->limit(3)
			->get()->result();

		$page_data['bands_ads'] = $this->db
			->from('ads_band')
			->join('bands', 'bands.band_id = ads_band.ad_band_id')
			->order_by('ad_id', 'DESC')
			->limit(3)
			->get()->result();

		$page_data['artists_audio'] = $this->db
			->from('audio_artist')
			->join('artists', 'artists.artist_account_id = audio_artist.audio_artist_id')
			->order_by('audio_id', 'DESC')
			->limit(3)
			->get()->result();

		$page_data['bands_audio'] = $this->db
			->from('audio_band')
			->join('bands', 'bands.band_id = audio_band.audio_band_id')
			->order_by('audio_id', 'DESC')
			->limit(3)
			->get()->result();

		$page_data['latest_artists'] = $this->db
			->from('artists')
			->order_by('artist_account_id', 'DESC')
			->limit(3)
			->get()->result();

		$page_data['latest_bands'] = $this->db
			->from('bands')
			->order_by('band_id', 'DESC')
			->limit(3)
			->get()->result();

		$data['page'] = $this->load->view('home', $page_data, true);
		$this->load->view('templates/layout', $data);

	}

	public function get_artists() {

		$artists = $this->db->from('artists')->like('nick', $_GET['term'], 'both')->get()->result();
		echo json_encode($artists);

	}

}
