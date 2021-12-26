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
		$data['count_produk']			= $this->M_admin->count_produk();
		$data['count_kategori']		= $this->M_admin->count_kategori();
		$this->template_backend->view('admin/dashboard', $data);
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
		
		// check if there is a produk using this kategori
		if ($this->M_admin->cek_produkKategori($id_kategori) != false) {
			
			$produk = $this->M_admin->cek_produkKategori($id_kategori);

			$this->session->set_flashdata('warning', 'Anda tidak dapat menghapus kategori ini, karena '.$produk.' menggunakan ketegori ini !');
			redirect($this->agent->referrer());
			
			// continue proccess
		} else {
			if ($this->M_admin->hapus_kategori($id_kategori) == TRUE){
				$this->session->set_flashdata('success', 'Berhasil menghapus kategori !');
				redirect($this->agent->referrer());
			}else{
				$this->session->set_flashdata('error', 'Terjadi kesalahan saat menghapus kategori !');
				redirect($this->agent->referrer());
			}
		}
	}
	
	// PRODUk
	public function data_produk()
	{
		$this->load->library('pagination');
		
		$config['base_url'] 				= base_url().'produk';
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
		
		$this->template_backend->view('admin/produk/data_produk', $data);
	}
	
	public function tambah_produk()
	{
		$data['kategori']						= $this->M_admin->get_kategori();
		$this->template_backend->view('admin/produk/tambah_produk', $data);
	}
	
	public function edit_produk($permalink = null)
	{
		if ($this->M_admin->get_produkDetail($permalink) == false) {
			$this->session->set_flashdata('error', 'Terjadi kesalahan saat mengambil data produk !');
			redirect($this->agent->referrer());
		} else {	
			$data['produk']						= $this->M_admin->get_produkDetail($permalink);
			$data['kategori']					= $this->M_admin->get_kategori();
			$this->template_backend->view('admin/produk/edit_produk', $data);
		}
	}
	
	// PROSES
	
	public function proses_tambahProduk(){
		
		// set validation rules
		$this->form_validation->set_rules('nama_produk', 'Nama produk', 'required');
		$this->form_validation->set_rules('harga', 'Harga produk', 'required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
		
		// cek form validaiton
		if ($this->form_validation->run() == FALSE){
			
			// redirect previous page
			$this->session->set_flashdata('warning', 'Harap lengkapi semua data !');
			redirect(site_url('tambah-produk'));
			
			// continued proccess
		}else{
			// cek uniqe nama produk
			if ($this->M_admin->cek_namaProduk($this->input->post('nama_produk')) == false) {
				
				// redirect previous page
				$this->session->set_flashdata('warning', 'Nama produk telah ada !');
				redirect(site_url('tambah-produk'));
				
				// continued proccess
			} else {
				
				// generate permalink as name folder too
				
				$chars 	= "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
				$uniqid = "";
				
				$word   = preg_replace("/[^a-zA-Z0-9]+/", "-", $this->input->post('nama_produk'));

				// genereate permalink
				$permalink 	 = strtolower($word);
				
				if (!empty($_FILES['poster']['name']))
				{
					
					// setting dir upload poster
					$folder 			= "berkas/produk/{$permalink}";
					
					// cek if folder di exist, is not make new folder
					if (!is_dir($folder)) {
						mkdir($folder, 0755, true);
					}
					
					// set file name
					for ($i = 0; $i < 4; $i++){
						$uniqid     .= $chars[mt_rand(0, strlen($chars)-1)];
					}

					$string_file = strtolower("poster_{$uniqid}");
					
					$config['upload_path']          = $folder;
					$config['allowed_types']        = '*';
					$config['max_size']             = 2*1024;
					$config['overwrite']            = true;
					$config['file_name']            = $string_file;
					
					$this->load->library('upload', $config);
					
					if ( !$this->upload->do_upload('poster')){
						$this->session->set_flashdata('error', 'Terjadi kesalahan saat menunggah poster !');
						redirect($this->agent->referrer());
					}else{
						
						$upload_data 	= $this->upload->data();
						if ($this->M_admin->proses_tambahProduk($permalink, $upload_data['file_name']) == TRUE){
							$this->session->set_flashdata('success', 'Berhasil menambahkan produk !');
							redirect(site_url('produk'));
						}else{
							$this->session->set_flashdata('error', 'Terjadi kesalahan saat menambahkan produk !');
							redirect($this->agent->referrer());
						}
					}
					
				}else{
					$this->session->set_flashdata('warning', 'Harap tambahkan file poster !');
					redirect($this->agent->referrer());
				}
				
			}
			
		}
		
	}
	
	public function proses_editProduk(){
		
		$permalink_old = $this->input->post('permalink');
		
		// set validation rules
		$this->form_validation->set_rules('nama_produk', 'Nama produk', 'required');
		$this->form_validation->set_rules('harga', 'Harga produk', 'required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
		
		// cek form validaiton
		if ($this->form_validation->run() == FALSE){
			
			// redirect previous page
			$this->session->set_flashdata('warning', 'Harap lengkapi semua data');
			redirect(site_url('edit-produk/'.$permalink_old));
			
			// continued proccess
		}else{
			// cek uniqe nama produk with param id produk
			if ($this->M_admin->cek_namaProdukEdit($this->input->post('id_produk'), $this->input->post('nama_produk')) == false) {
				
				// redirect previous page
				$this->session->set_flashdata('warning', 'Nama produk telah ada !');
				redirect(site_url('edit-produk/'.$permalink_old));
				
				// continued proccess
			} else {
				
				// generate permalink as name folder too
				
				$chars 	= "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
				$uniqid = "";
				
				$word   = preg_replace("/[^a-zA-Z0-9]+/", "-", $this->input->post('nama_produk'));
				// genereate permalink
				$permalink 	 = strtolower($word);
				
				if (!empty($_FILES['poster']['name']))
				{
					
					// setting dir upload poster
					$folder 			= "berkas/produk/{$permalink}";
					
					// delete older poster
					$poster 			= $this->input->post('old_poster');
					$file 				= "berkas/produk/{$permalink_old}/{$poster}";
					
					unlink($file);
					
					// cek if folder di exist, is not make new folder
					if (!is_dir($folder)) {
						mkdir($folder, 0755, true);
					}
					
					// set file name
					for ($i = 0; $i < 4; $i++){
						$uniqid     .= $chars[mt_rand(0, strlen($chars)-1)];
					}

					$string_file = strtolower("poster_{$uniqid}");
					
					$config['upload_path']          = $folder;
					$config['allowed_types']        = '*';
					$config['max_size']             = 2*1024;
					$config['overwrite']            = true;
					$config['file_name']            = $string_file;
					
					$this->load->library('upload', $config);
					
					if ( !$this->upload->do_upload('poster')){
						$this->session->set_flashdata('error', 'Terjadi kesalahan saat menunggah poster !');
						redirect($this->agent->referrer());
					}else{
						
						$upload_data 	= $this->upload->data();
						if ($this->M_admin->proses_editProduk($permalink, $upload_data['file_name']) == TRUE){
							$this->session->set_flashdata('success', 'Berhasil mengubah data produk !');
							redirect(site_url('produk'));
						}else{
							$this->session->set_flashdata('warning', 'Tidak terjadi perubahan data produk !');
							redirect(site_url('edit-produk/'.$permalink_old));
						}
					}
					
				}else{
					if ($this->M_admin->proses_editProduk($permalink_old, null) == TRUE){
						$this->session->set_flashdata('success', 'Berhasil mengubah data produk !');
						redirect(site_url('produk'));
					}else{
						$this->session->set_flashdata('warning', 'Tidak terjadi perubahan data produk !');
						redirect(site_url('edit-produk/'.$permalink_old));
					}
				}
				
			}
			
		}
	}
	
	function hapus_produk($permalink = null, $poster = null, $id_produk = null){
		if ($this->M_admin->hapus_produk($id_produk) == TRUE){
			// delete older poster
			$file 				= "berkas/produk/{$permalink}/{$poster}";
			
			unlink($file);
			$this->session->set_flashdata('success', 'Berhasil menghapus produk !');
			redirect($this->agent->referrer());
		}else{
			$this->session->set_flashdata('error', 'Terjadi kesalahan saat menghapus produk !');
			redirect($this->agent->referrer());
		}
	}
	
}
