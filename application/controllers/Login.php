<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// Session
		$this->load->library('session');
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function pesanRegister()
	{
		$this->load->view('message');
	}

	public function signup()
	{

		$uk = $this->db->query("Select a.* from m_unit_kerja a ")->result_object();

		$data['notif'] 	 = '';
		$data['message'] = '';
		$data['unitkerja'] 	 = $uk;
		$data['page'] 	 = 'register';
		$this->load->view('signup', $data);
	}

	public function create()
	{

		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$repassword = $this->input->post('repassword');
		$nama = $this->input->post('nama');
		$nip = $this->input->post('nip');
		$uk = $this->input->post('uk');
		$kategori = $this->input->post('jenis');
		$notif = $message = "";


		$peg = $this->db->query("select * from tb_pegawai where nip='" . $nip . "'");

		if ($peg->num_rows() > 0) {
			// cek di users
			$pegawai = $peg->result_object();
			$idPeg = $pegawai[0]->id;
			$user = $this->db->query("select * from users where nip='" . $nip . "' and pegawai_id='" . $idPeg . "'");
			if ($user->num_rows() == 0) {
				// insert user login
				$post_data = array(
					'username' 	=> $username,
					'password' 	=> $password,
					'name' 		=> $nama,
					'nip' 		=> $nip,
					'suspend' 	=> 0,
					'role_id' 	=> $kategori,
					'pegawai_id' => $idPeg
					// 'created_at' => date('Y-m-d H:i:s'),
					// 'updated_at' => date('Y-m-d H:i:s')
				);
				$insert = $this->db->insert('users', $post_data);
				if ($insert) {
					//cek di penyuluh
					$penyuluh = $this->db->query("select * from t_penyuluh where pegawai_id='" . $idPeg . "'");
					if ($penyuluh->num_rows() == 0) {
						// insert penyuluh						
						$post_penyuluh = array(
							'nip' 		=> $nip,
							'nama' 		=> $nama,
							'pegawai_id' => $idPeg,
							'jabatan_penyuluh' => 1,
							'created_at' => date('Y-m-d H:i:s'),
							'updated_at' => date('Y-m-d H:i:s')
						);
						$this->db->insert('t_penyuluh', $post_penyuluh);
					}
					$notif = 'sukses';
					$message = 'Register Sukses, silahkan login ';
				} else {
					$notif = 'error';
					$message = 'Error Register, Silahkan coba lagi ';
				}
			} else {
				$notif = 'error';
				$message = 'Error Register, Anda sudah melakukan register sebelumnya ';
			}
		} else {
			// insert pegawai
			$post_peg = array(
				'nip' 	=> $nip,
				'nama' => $nama,
				'bidang_id' => $uk,
				'email' => $username
				// 'created_at' => date('Y-m-d H:i:s'),
				// 'updated_at' => date('Y-m-d H:i:s')
			);
			$this->db->insert('tb_pegawai', $post_peg);
			$idPeg = $this->db->insert_id();

			//cek di penyuluh
			$penyuluh = $this->db->query("select * from t_penyuluh where pegawai_id='" . $idPeg . "'");
			if ($penyuluh->num_rows() == 0) {
				// insert penyuluh
				$post_penyuluh = array(
					'nip' 	=> $nip,
					'nama' 		=> $nama,
					'pegawai_id' => $idPeg,
					'jabatan_penyuluh' => 1
					// 'created_at' => date('Y-m-d H:i:s'),
					// 'updated_at' => date('Y-m-d H:i:s')
				);
				$this->db->insert('t_penyuluh', $post_penyuluh);
			}

			// insert user login
			$post_data = array(
				'username' 	=> $username,
				'password' 	=> $password,
				'name' 		=> $nama,
				'nip' 		=> $nip,
				'suspend' 	=> 0,
				'role_id' 	=> $kategori,
				'pegawai_id' => $idPeg
				// 'created_at' => date('Y-m-d H:i:s'),
				// 'updated_at' => date('Y-m-d H:i:s')
			);
			$insert = $this->db->insert('users', $post_data);
			if ($insert) {
				$notif = 'sukses';
				$message = 'Register Sukses, silahkan login ';
				//redirect(base_url().'login');
			} else {
				$notif = 'error';
				$message = 'Error Register, Silahkan coba lagi ';
			}
		}

		$uk = $this->db->query("Select a.* from m_unit_kerja a ")->result_object();

		$data['notif'] = $notif; //$this->session->flashdata('notif');
		$data['message'] = $message;
		$data['unitkerja'] 	 = $uk;
		$data['page'] 	 = 'register';
		$this->load->view('signup', $data);
		//redirect(base_url().'signup',$data);		

	}

	public function doLogin()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		/*
		$result = $this->db->query("select * from users where username='".$username.
							"' and password='".$password."'");
		if ($result->num_rows()>0){
			$users = $result->result_array();

			$this->session->set_userdata('username',$username);			
			$this->session->set_userdata('role_id',$users[0]['role_id']);
			$this->session->set_userdata('user_id',$users[0]['id']);
			$this->session->set_userdata('name',$users[0]['name']);
			
			redirect(base_url().'home');
		}else{
			redirect(base_url().'login');
		}
		*/
		//197812221998031003
		if ($username == "super@admin.com") {
			$result = $this->db->query("select * from users where username='" . $username .
				"' and password='" . $password . "'");
		} else {

			$result = $this->db->query("select * from tb_pegawai where nip='" . $username .
				"' and password='" . $password . "'");
		}
		if ($result->num_rows() > 0) {
			$users = $result->result_array();

			$this->session->set_userdata('username', $username);
			$this->session->set_userdata('role_id', $users[0]['role_id']);
			$this->session->set_userdata('user_id', $users[0]['id']);
			$this->session->set_userdata('nip', $users[0]['nip']);
			$this->session->set_userdata('nama', $users[0]['nama']);
			$this->session->set_userdata('jabatan_id', $users[0]['jabatan_id']);

			redirect(base_url() . 'home');
		} else {
			redirect(base_url() . 'login');
		}
	}

	public function doLogout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('role_id');
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('nip');
		$this->session->unset_userdata('nama');

		$this->session->sess_destroy();
		redirect(base_url() . 'login');
	}
}
