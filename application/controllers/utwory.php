<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utwory extends MY_Controller {

	public function index() {

		$page_data = $this->data;

		$page_data['artists_audio'] = $this->db
			->from('audio_artist')
			->join('artists', 'artists.artist_account_id = audio_artist.audio_artist_id')
			->order_by('audio_id', 'DESC')
			->get()->result();

		$page_data['bands_audio'] = $this->db
			->from('audio_band')
			->join('bands', 'bands.band_id = audio_band.audio_band_id')
			->order_by('audio_id', 'DESC')
			->get()->result();

		$data['page'] = $this->load->view('utwory', $page_data, true);
		$this->load->view('templates/layout', $data);

	}

	public function pokaz($id, $where) {

		$page_data = $this->data;

		if(empty($id))
			show_404();

		$audio = $this->db->get_where($where, array('audio_id' => $id))->row();
		if(empty($audio))
			show_404();

		if($where == 'audio_artist') {

			$page_data['artist'] = $this->db->from('artists')
			->join('accounts', 'artists.artist_account_id = accounts.account_id')
			->join('places', 'artists.place_id = places.place_id')
			->join('provinces', 'places.province_id = provinces.province_id')
			->where(array('artist_account_id' => $audio->audio_artist_id))->get()->row();

			$page_data['artist_bands'] = $this->db->from('members')
			->where(array('member_artist_id' => $audio->audio_artist_id))
			->join('bands', 'members.member_band_id = bands.band_id')
			->get()->result();

		}
		else if($where == 'audio_band') {

			$page_data['band'] = $this->db->from('bands')
			->join('places', 'bands.place_id = places.place_id')
			->join('provinces', 'places.province_id = provinces.province_id')
			->where(array('band_id' => $audio->audio_band_id))
			->get()->row();

			$page_data['band_members'] = $this->db->from('members')
			->where(array('member_band_id' => $audio->audio_band_id))
			->join('artists', 'members.member_artist_id = artists.artist_account_id')
			->get()->result();

		}

		$page_data['where'] = $where;
		$page_data['audio'] = $audio;

		$data['page'] = $this->load->view('utwory_pokaz', $page_data, true);
		$this->load->view('templates/layout', $data);

	}

}
