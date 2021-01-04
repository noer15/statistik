<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Helper extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}

	 public function kirim_email(){
        // Konfigurasi email.
        $config = [
               'useragent' => 'CodeIgniter',
               'protocol'  => 'smtp',
               'mailpath'  => '/usr/sbin/sendmail',
               'smtp_host' => 'ssl://smtp.gmail.com',
               'smtp_user' => 'silaras2018@gmail.com',   // Ganti dengan email gmail Anda.
               'smtp_pass' => 'silaras12345',             // Password gmail Anda.
               'smtp_port' => 465,
               'smtp_keepalive' => TRUE,
               'smtp_crypto' => 'SSL',
               'wordwrap'  => TRUE,
               'wrapchars' => 80,
               'mailtype'  => 'html',
               'charset'   => 'utf-8',
               'validate'  => TRUE,
               'crlf'      => "\r\n",
               'newline'   => "\r\n",
           ];
 
        // Load library email dan konfigurasinya.
        $this->load->library('email', $config);
 
        // Pengirim dan penerima email.
        $this->email->from('silaras2018@gmail.com', 'silaras2018');    // Email dan nama pegirim.
        $this->email->to('ebsakun24@gmail.com');                       // Penerima email.
 
        // Lampiran email. Isi dengan url/path file.
        $this->email->attach('http://silaras.wahanaku.com/uploads/12.pdf');
 
        // Subject email.
        $this->email->subject('Surat Masuk');
 
        // Isi email. Bisa dengan format html.
        $this->email->message('Ini adalah contoh email yang dikirim melalui localhost pada CodeIgniter menggunakan SMTP email Google (Gmail).');
 
        if ($this->email->send())
        {
            echo 'Sukses! email berhasil dikirim.';
        }
        else
        {
            echo 'Error! email tidak dapat dikirim.';
        }
    }
}
