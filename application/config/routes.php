<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// AUTH
$route['masuk']               = 'authentication';
$route['keluar']              = 'authentication/logout';

// ADMIN
$route['dashboard']           = 'admin';
$route['kategori']            = 'admin/data_kategori';

$route['produk']              = 'admin/data_produk';
$route['tambah-produk']       = 'admin/tambah_produk';
$route['edit-produk/(:any)']  = 'admin/edit_produk/$1';

$route['default_controller'] = 'beranda';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
