<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		// CEK APAKAH USER MASIH LOGIN
		if ($this->session->userdata('logged_in') == FALSE || !$this->session->userdata('logged_in')) {
			if (!empty($_SERVER['QUERY_STRING'])) {
				$uri = uri_string() . '?' . $_SERVER['QUERY_STRING'];
			} else {
				$uri = uri_string();
			}
			$this->session->set_userdata('redirect', $uri);
			$this->session->set_flashdata('error', "Harap masuk ke akun anda, untuk melanjutkan");
			redirect('masuk');
		}
		
		$this->load->model(['M_admin', 'M_beranda']);
	}

	public function index()
	{
		$this->template_backend->view('admin/dashboard');
	}

  // KATEGORI
	public function data_kategori()
	{
		$this->load->library('pagination');

		$config['base_url'] 				= base_url().'kategori';
		$config['total_rows'] 			= $this->M_admin->count_kategori();
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
		$data['kategori']						= $this->M_admin->get_kategoriTable((empty($this->uri->segment(2)) ? 0 : $this->uri->segment(2)), $config['per_page']);

		$this->template_backend->view('admin/data_kategori', $data);
	}

	function tambah_kategori(){
		if ($this->M_admin->tambah_kategori() == TRUE){
			$this->session->set_flashdata('success', 'Berhasil menambahkan kategori !');
			redirect($this->agent->referrer());
		}else{
			$this->session->set_flashdata('error', 'Terjadi kesalahan saat menambahkan kategori !');
			redirect($this->agent->referrer());
		}
	}

	function edit_kategori(){
		if ($this->M_admin->edit_kategori() == TRUE){
			$this->session->set_flashdata('success', 'Berhasil mengubah kategori !');
			redirect($this->agent->referrer());
		}else{
			$this->session->set_flashdata('error', 'Tidak ada perubahan pada kategori !');
			redirect($this->agent->referrer());
		}
	}

	function hapus_kategori($id_kategori = null){
		if ($this->M_admin->hapus_kategori($id_kategori) == TRUE){
			$this->session->set_flashdata('success', 'Berhasil menghapus kategori !');
			redirect($this->agent->referrer());
		}else{
			$this->session->set_flashdata('error', 'Terjadi kesalahan saat menghapus kategori !');
			redirect($this->agent->referrer());
		}
	}

  // PRODUk
	public function data_produk()
	{
		$this->template_backend->view('admin/produk/data_produk');
	}

	public function tambah_produk()
	{
		$this->template_backend->view('admin/produk/tambah_produk');
  }
  
  public function proses_tambahProduk(){

  }

	public function edit_produk($permalink = null)
	{
		$this->template_backend->view('admin/produk/edit_produk');
	}
}
