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
		$this->template_backend->view('admin/data_kategori');
	}

	function tambah_kategori(){
		if ($this->M_admin->tambah_kategori() == TRUE){
			$this->session->set_flashdata('success', 'Berhasil menambahkan kategori !');
			redirect($this->agent->referrer());
		}else{
			$this->session->set_flashdata('error', 'Terjadi kesalahan saat enambahkan kategori !');
			redirect($this->agent->referrer());
		}
	}

	function edit_kategori(){
		if ($this->M_admin->edit_kategori() == TRUE){
			$this->session->set_flashdata('success', 'Berhasil mengubah kategori !');
			redirect($this->agent->referrer());
		}else{
			$this->session->set_flashdata('error', 'Terjadi kesalahan saat mengubah kategorit !');
			redirect($this->agent->referrer());
		}
	}

	function hapus_kategori($id_kategori){
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
