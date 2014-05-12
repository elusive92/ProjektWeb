<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	public function index() {

		$page_data = $this->data;

		$page_data['ads'] = $this->db
			->from('ads')
			->order_by('ad_id', 'DESC')
			->get()->result();

		$page_data['last_artists'] = $this->db
			->from('artists')
			->order_by('artist_account_id', 'DESC')
			->get()->result();

		$page_data['last_bands'] = $this->db
			->from('bands')
			->order_by('band_id', 'DESC')
			->get()->result();

		$data['page'] = $this->load->view('home', $page_data, true);
		$this->load->view('templates/layout', $data);

	}
}
