<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(['M_admin', 'M_beranda']);
	}

	public function index()
	{
		$this->load->library('pagination');

		$config['base_url'] 				= base_url();
		$config['total_rows'] 			= $this->M_admin->count_produk();
		$config['per_page'] 				= 5;

		$config['full_tag_open'] 		= '<nav class="w-100 d-flex justify-content-center align-items-center mb-0" aria-label="Page navigation example"><ul class="pagination justify-content-center pagination-sm">';
		$config['full_tag_close'] 	= '</ul></nav>';

		$config['next_link'] 				= '&raquo';
		$config['next_tag_open'] 		= '<li class="page-item">';
		$config['next_tag_close'] 	= '</li>';

		$config['prev_link'] 				= '&laquo';
		$config['prev_tag_open'] 		= '<li class="page-item">';
		$config['prev_tag_close'] 	= '</li>';

		$config['cur_tag_open'] 		= '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] 		= '<span class="sr-only">(current)</span></a></li>';

		$config['num_tag_open'] 		= '<li class="page-item">';
		$config['num_tag_close'] 		= '</li>';

		$config['attributes']				= array('class' => 'page-link');

		$this->pagination->initialize($config);
		$data['produk']							= $this->M_admin->get_produkTable((empty($this->uri->segment(2)) ? 0 : $this->uri->segment(2)), $config['per_page']);
		$this->template_frontend->view('beranda', $data);
	}
}
