<?php 
defined('BASEPATH') OR exit ('No direct script access allowed');

class Auth extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('M_operator');
    // $this->load->library('session');
  }

  public function index() {
    if ($this->session->userdata('login')) {
      redirect('dashboard');
    }
    $data['title'] = "login";
    $this->load->view('templates/header', $data);
    $this->load->view('auth/login');
    $this->load->view('templates/footer', $data);
  }

  public function login() {
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    $user = $this->M_operator->get_by_username($username);
    if ($user && password_verify($password, $user->password)) {
      // simpan session
      $this->session->set_userdata([
        'login' => TRUE,
        'username' => $user->username,
        'nama' => $user->nama_lengkap,
        'last_login' => $user->last_login // simpan last login lama
      ]);

      // update last_login
      $this->M_operator->update_last_login($user->operator_id);

      redirect('dashboard');
    } else {
      $this->session->set_flashdata('error','Username / Password salah!');
      redirect('auth');
    }
  }

  public function logout() {
    $this->session->access_destroy();
    redirect('auth');
  }
}