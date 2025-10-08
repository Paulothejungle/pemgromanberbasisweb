<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
  public function __construct() {
    parent::__construct();
    // $this->load->model('M_barang');
    $this->load->model('M_operator');
    if (!$this->session->userdata('login')) {
      redirect('auth');
    }
  }

  public function index() {
    $data['title'] = "Dashboard";
    // $data['jumlah_barang'] = $this->M_barang->count_all_barang();
    $data['jumlah_user'] = $this->M_operator->count_all_user();
    $data['user'] = [
      'username' => $this->session->userdata('username'),
      'nama'     => $this->session->userdata('nama'),
      'last_login' => $this->session->userdata('last_login')      
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('dashboard', $data);
    $this->load->view('templates/footer', $data);
  }
}