<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ogloszenia extends MY_Controller {

	public function index() {

		$page_data = $this->data;

		$page_data['artists_ads'] = $this->db
			->from('ads_artist')
			->join('artists', 'artists.artist_account_id = ads_artist.ad_artist_id')
			->order_by('ad_id', 'DESC')
			->get()->result();

		$page_data['bands_ads'] = $this->db
			->from('ads_band')
			->join('bands', 'bands.band_id = ads_band.ad_band_id')
			->order_by('ad_id', 'DESC')
			->get()->result();

		$data['page'] = $this->load->view('ogloszenia', $page_data, true);
		$this->load->view('templates/layout', $data);

	}

	public function pokaz($id, $where) {

		$page_data = $this->data;

		if(empty($id))
			show_404();

		$ad = $this->db->get_where($where, array('ad_id' => $id))->row();
		if(empty($ad))
			show_404();

		if($where == 'ads_artist') {

			$page_data['artist'] = $this->db->from('artists')
			->join('accounts', 'artists.artist_account_id = accounts.account_id')
			->join('places', 'artists.place_id = places.place_id')
			->join('provinces', 'places.province_id = provinces.province_id')
			->where(array('artist_account_id' => $ad->ad_artist_id))->get()->row();

			$page_data['artist_bands'] = $this->db->from('members')
			->where(array('member_artist_id' => $ad->ad_artist_id))
			->join('bands', 'members.member_band_id = bands.band_id')
			->get()->result();

		}
		else if($where == 'ads_band') {

			$page_data['band'] = $this->db->from('bands')
			->join('places', 'bands.place_id = places.place_id')
			->join('provinces', 'places.province_id = provinces.province_id')
			->where(array('band_id' => $ad->ad_band_id))
			->get()->row();

			$page_data['band_members'] = $this->db->from('members')
			->where(array('member_band_id' => $ad->ad_band_id))
			->join('artists', 'members.member_artist_id = artists.artist_account_id')
			->get()->result();

		}

		$page_data['where'] = $where;
		$page_data['ad'] = $ad;

		$data['page'] = $this->load->view('ogloszenia_pokaz', $page_data, true);
		$this->load->view('templates/layout', $data);

	}

}
