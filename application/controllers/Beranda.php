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
		$data['produk']							= $this->M_admin->get_produk();
		$this->template_frontend->view('beranda', $data);
	}
}
