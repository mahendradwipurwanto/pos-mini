<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('M_authentication', 'M_auth');
	}
	
	public function index()
	{
			$this->load->view('masuk');
	}
	
	public function proses_masuk(){

		// set validation rules
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'You must provide a %s.'));
		
		// cek form validaiton
		if ($this->form_validation->run() == FALSE){

			// redirect previous page
			$this->session->set_flashdata('warning', 'Harap masukkan username atau password');
			redirect(site_url('masuk'));

			// continued proccess
		}else{
			// ambil inputan dari view
			$username   = $this->input->post('username');
			$password   = $this->input->post('password');
			
			// cek apakah data user ada, berdasarkan username yang dimasukkan
			if ($this->M_auth->cek_user($username) == true) {
				// ambil data user, menjadi array
				$user     = $this->M_auth->get_user($username);
				
				// cek apakah password yang dimasukkan sama dengan database
				if (password_verify($password, $user->password)) {
					
					// simpan data user yang login kedalam session 
					$session_data = array(
						'kode_user' => $user->kode_user,
						'nama'      => $user->nama,
						'role'      => $user->role,
						'logged_in' => true,
					);
					
					$this->session->set_userdata($session_data);
					
					// cek role dari user yang login
					
					// ADMIN
					if ($user->ROLE == 0) {
						// arahkan ke halaman admin
						if ($this->session->userdata('redirect')) {
							$this->session->set_flashdata('success', 'Hai, anda telah masuk. Silahkan melanjutkan aktivitas anda !!');
							redirect($this->session->userdata('redirect'));
						} else {
							$this->session->set_flashdata('success', "Hai, admin. Selamat datang !");
							redirect(site_url('dashboard'));
						}
						
						// ETC
					}else{
						$this->session->set_flashdata('error', "Mohon maaf, hak akses user tidak dikenali !");
						redirect(site_url('keluar'));
					}
					
				} else {
					$this->session->set_flashdata('warning', "Mohon maaf, password yang anda masukkan salah !");
					redirect(site_url('masuk'));
				}
				
			} else {
				$this->session->set_flashdata('error', "Mohon maaf, user tidak terdaftar !");
				redirect(site_url('masuk'));
			}
		}		
	}

	public function logout(){

			// SESS DESTROY
		$this->session->sess_destroy();
		$this->session->set_flashdata('success', "Anda berhasil keluar !");
		redirect(base_url());
	}
}
