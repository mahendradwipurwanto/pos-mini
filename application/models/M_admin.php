<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {
	function __construct(){
		parent::__construct();
	}
	
	// KATEGORI
	function get_kategoriTable($start, $limit){
		$this->db->select('*');
		$this->db->from('tb_kategori');
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
		
	}
	
	function get_kategori(){
		$query = $this->db->get('tb_kategori');
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
		
	}
	
	function count_kategori(){
		return $this->db->get('tb_kategori')->num_rows();		
	}
	
	// PROCESS KATEGORI
	function tambah_kategori(){
		$kategori 	= htmlspecialchars($this->input->post('kategori'), true);
		$keterangan = htmlspecialchars($this->input->post('keterangan'), true);
		
		$data = array(
			'kategori' 		=> $kategori,
			'keterangan' 	=> $keterangan,
		);

		$this->db->insert('tb_kategori', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	function edit_kategori(){
		$id_kategori= $this->input->post('id_kategori');

		$kategori 	= htmlspecialchars($this->input->post('kategori'), true);
		$keterangan = htmlspecialchars($this->input->post('keterangan'), true);
		
		$data = array(
			'kategori' 		=> $kategori,
			'keterangan' 	=> $keterangan,
		);

		$this->db->where('id_kategori', $id_kategori);
		$this->db->update('tb_kategori', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	function hapus_kategori($id_kategori){
		$this->db->where('id_kategori', $id_kategori);
		$this->db->delete('tb_kategori');
		return ($this->db->affected_rows() != 1) ? false : true;
	}

}