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

	function cek_produkKategori($id_kategori){
		$query = $this->db->get_where('tb_produk', array('id_kategori' => $id_kategori));
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		} else {
			return false;
		}
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
	
	// PRODUK
	function get_produkTable($start, $limit){
		$this->db->select('a.*, b.kategori');
		$this->db->from('tb_produk a');
		$this->db->join('tb_kategori b', 'a.id_kategori = b.id_kategori');
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
		
	}
	function get_produk(){
		$this->db->select('a.*, b.kategori');
		$this->db->from('tb_produk a');
		$this->db->join('tb_kategori b', 'a.id_kategori = b.id_kategori');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
		
	}
	
	function get_produkDetail($permalink){
		$this->db->select('a.*, b.kategori');
		$this->db->from('tb_produk a');
		$this->db->join('tb_kategori b', 'a.id_kategori = b.id_kategori');
		$this->db->where('permalink', $permalink);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}
	
	function count_produk(){
		return $this->db->get('tb_produk')->num_rows();		
	}
	
	function cek_namaProduk($nama_produk){
		$query = $this->db->query("SELECT * FROM tb_produk WHERE nama_produk = '$nama_produk'");
		if ($query->num_rows() > 0) {
			return false;
		} else {
			return true;
		}
		
	}
	
	function cek_namaProdukEdit($id_produk, $nama_produk){
		$query = $this->db->query("SELECT * FROM tb_produk WHERE id_produk != '$id_produk' AND nama_produk = '$nama_produk'");
		if ($query->num_rows() > 0) {
			return false;
		} else {
			return true;
		}
		
	}
	
	function produk_permalink($permalink){
		$query = $this->db->query("SELECT * FROM tb_produk WHERE permalink = '$permalink'");
		return $query->num_rows();
		
	}
	
	function proses_tambahProduk($permalink, $poster){
		$nama_produk   	= $this->input->post('nama_produk');
		$harga      		= $this->input->post('harga');
		$kategori    		= $this->input->post('kategori');
		$keterangan     = $this->input->post('keterangan');
		
		$data = array(
			'permalink' 	=> $permalink,
			'id_kategori' => $kategori,
			'nama_produk' => $nama_produk,
			'poster'      => $poster,
			'keterangan'  => $keterangan,
			'harga'       => $harga,
			'tanggal'			=> date("Y-m-d")
		);
		
		$this->db->insert('tb_produk', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	function proses_editProduk($permalink, $poster){
		$id_produk   		= $this->input->post('id_produk');
		
		$nama_produk   	= $this->input->post('nama_produk');
		$harga      		= $this->input->post('harga');
		$kategori    		= $this->input->post('kategori');
		$keterangan     = $this->input->post('keterangan');
		
		if ($poster == null) {
			$data = array(
				'permalink' 	=> $permalink,
				'id_kategori' => $kategori,
				'nama_produk' => $nama_produk,
				'keterangan'  => $keterangan,
				'harga'       => $harga
			);
		} else {
			$data = array(
				'permalink' 	=> $permalink,
				'id_kategori' => $kategori,
				'nama_produk' => $nama_produk,
				'poster'      => $poster,
				'keterangan'  => $keterangan,
				'harga'       => $harga
			);
		}
		
		$this->db->where('id_produk', $id_produk);
		$this->db->update('tb_produk', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	function hapus_produk($id_produk){
		$this->db->where('id_produk', $id_produk);
		$this->db->delete('tb_produk');
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
}