<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Szukanie_Zaawansowane extends MY_Controller {

	public function index() {

		$page_data = $this->data;

		if($this->input->get()) {

			if($this->input->get('w') == 'zespoly') {
				$results = $this->db->from('bands')
					->like('band_name', $this->input->get('s'))
					->get()->results();
			}
			else {
				$results = $this->db->from('artists')
					->like('artist_nick', $this->input->get('s'))
					->get()->results();
			}

			$page_data['search_results'] = $results;

		}

		$data['page'] = $this->load->view('szukanie_zaawansowane', $page_data, true);
		$this->load->view('templates/layout', $data);

	}
}
