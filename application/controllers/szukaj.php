<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Szukaj extends MY_Controller {

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
					->like('nick', $this->input->get('s'))
					->get()->results();
			}

			$page_data['search_results'] = $results;

		}

		$data['page'] = $this->load->view('szukaj', $page_data, true);
		$this->load->view('templates/layout', $data);

	}
}
