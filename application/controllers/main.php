<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if($this->session->userdata('is_logged_in'))
		{
			redirect('/friends');
		}

		$this->load->view('index');
		$this->load->view('login_registration');
	}
}

//end of main controller