<?php

defined('BASEPATH') OR exit ('No direct script access allowed');

class Operator extends CI_Controller {

  public function __construct() 
  {
    parent::__construct();
    if (!$this->session->userdata('login')) {
      redirect('auth');
    }
    $this->load->model('M_operator');
    $this->load->library('form_validation');
  }


  public function index()
  {
    $data['title'] = 'Data Operator';
    $data['operator'] = $this->db->get('operator')->result_array();

    $data['user'] = [
      'username' => $this->session->userdata('username'),
      'nama' => $this->session->userdata('nama'),
      'last_login' => $this->session->userdata('last_login')
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('templates/index', $data);
    $this->load->view('templates/footer', $data);
  }

  public function tambah()
  {
    $data['title'] = 'Tambah Operator';

    $data['user'] = [
      'username' => $this->session->userdata('username'),
      'nama' => $this->session->userdata('nama'),
      'last_login' => $this->session->userdata('last_login')
    ];

    $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
    $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[operator.username]',[
      'is_unique' => 'Username sudah digunakan!'
    ]);
    
    $this->form_validation->set_rules(
      'password',
      'Password',
      'required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_].+$/]',
      [
        'min_length' => 'Password minimal 8 karakter.',
        'regex_match' => 'Password harus mendukung huruf besar, kecil, angka, dan simbol.'
      ]
    );

    $this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'required|matches[password]', [
      'matches' => 'Konfirmasi password tidak cocok.'
    ]);

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('templates/index', $data);
      $this->load->view('templates/footer', $data);
    } else {
      $data_insert = [
        'nama_lengkap' => $this->input->post('nama_lengkap', TRUE),
        'username' => $this->input->post('username', TRUE),
        'password' => $password_hash($this->input->post('password'), PASSWORD_DEFAULT),
        'last_login' => NULL
      ];
      $this->db->insert('operator', $data_insert);
      $this->db->set_flashdata('success', 'Operator baru berhasil ditambahkan');
      redirect('operator');
    }
  }

  public function edit($id)
  {
    $data['title'] = 'Edit Operator';
    $data['operator'] = $this->db->get_where('operator', ['operator_id' => $id])->row_array();

    $data['user'] = [
      'username' => $this->session->userdata('username'),
      'nama' => $this->session->userdata('nama'),
      'last_login' => $this->session->userdata('last_login')
    ];

    if(!$data['operator']) {
      show_404();
    }

    $this->form_validation->set_rules('nama_lengkap','Nama Lengkap','required|trim');
    $this->form_validation->set_rules('username', 'Username', 'required|trim');

    if($this->input->post('password')){
      $this->form_validation->set_rules(
      'password',
      'Password',
      'required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_].+$/]',
      [
        'min_length' => 'Password minimal 8 karakter.',
        'regex_match' => 'Password harus mendukung huruf besar, kecil, angka, dan simbol.'
      ]
      );
      $this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'matches[password]',[
        'matches' => 'Konfirmasi password tidak cocok.'
      ]);
    }
    if ($this->form_validation->run() == FALSE) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('templates/index', $data);
      $this->load->view('templates/footer', $data);
    } else {
      $update_data = [
        'nama_lengkap' => $this->input->post('nama_lengkap', TRUE),
        'username' => $this->input->post('username', TRUE)
      ];

      if($this->input->post('password')) {
        $update_data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
      }

      $this->db->where('operator_id', $id);
      $this->db->update('operator', $update_data);

      $this->session->set_flashdata('success','Data operator berhasil diperbarui');
      redirect('operator');
    }
  }

  public function hapus($id)
  {
    $this->db->where('operator_id', $id);
    $this->db->delete('operator');
    $this->session->set_flashdata('success','Data operator berhasil dihapus');
    redirect('Operator');
  }

}