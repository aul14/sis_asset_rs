<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Simple_login
{

	// SET SUPER GLOBAL
	var $CI = NULL;
	public function __construct()
	{
		$this->CI = &get_instance();
	}

	// Cek login
	public function cek_login()
	{
		if ($this->CI->session->userdata('id_user') == '' && $this->CI->session->userdata('token') == '') {
			$this->CI->session->set_flashdata('error', 'Oops...please first login');
			redirect('login', 'refresh');
		}
	}

	//cek status code
	public function status_code($code)
	{
		if ($code == 401 && $this->CI->session->userdata('token') == '') {
			$this->CI->session->set_flashdata('error', 'Oops...token is not found');

			redirect('login', 'refresh');
		}
	}
}
