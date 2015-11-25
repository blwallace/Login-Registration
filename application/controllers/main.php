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

	public function vulnerabilities(){
		$this->load->view('index');
		$this->load->view('vulnerabilities');

	}

	public function brute_force(){
		$this->load->view('brute_force');
	}

	public function features(){
		$this->load->view('index');
		$this->load->view('features');
	}
}

//end of main controller