<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Friends extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('friend');
	}

	public function index()
	{		
		$user_id = $this->session->userdata('user_id');
		$friend_list = $this->friend->find_friends($user_id);
		$enemy_list = $this->friend->find_enemies($user_id);		

		$data = array(
			'friends' => $friend_list,
			'enemies' => $enemy_list,
			'home' => 1);

		$this->load->view('index');
		$this->load->view('banner',$data);
		$this->load->view('friend_dashboard',$data);
	}

	public function remove($id)
	{
		$friend_id = $id;
		$user_id = $this->session->userdata('user_id');

		$this->friend->remove_friend($id,$user_id);
		$this->friend->remove_friend($user_id,$id);
		header('location:/friends');
		
	}

	public function add($id)
	{
		$friend_id = $id;
		$user_id = $this->session->userdata('user_id');

		$this->friend->add_friend($id,$user_id);
		$this->friend->add_friend($user_id,$id);


		header('location:/friends');
	}
}

//end of main controller