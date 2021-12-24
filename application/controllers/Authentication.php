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
}
