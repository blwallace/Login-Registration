<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user');

	}

	public function index($id)
	{

	}

	public function login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$data_users = $this->user->get_user($email);
		

      	if(isset($data_users[0]))
        {
        	$data = $data_users[0];
            $enc_password = crypt($password,$data['password']); //If you 'crypt' a non-encrypted password with an encrypted password, the successful result will be the encrypted password

            if($data['password'] == $enc_password) //do the encrypted passwords match? if yes, then log in
            {
                $user = array(
                   'user_id' => $data['id'],
                   'user_email' => $data['email'],
                   'user_name' => $data['user_name'],
                   'alias' => $data['alias'],
                   'is_logged_in' => true,
                   // 'type' => $data['type'],
                );
                $this->session->set_userdata($user);
				redirect('/friends/index');	
            }
            else
            {
                $this->session->set_flashdata("login_error", "Invalid email or password!");
				redirect('');	
            }
        }

        else
        {
                $this->session->set_flashdata("login_error", "Invalid email or password!");
				redirect('');	
        }


		$this->load->view('index');  
	}

	public function logout()
	{
		$this->session->sess_destroy();
        redirect('') ;
	}	

	// Add a new user
	public function add()
	{
        // $this->main->admin_validation();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('user_name', 'Name', 'required|min_length[2]');
        $this->form_validation->set_rules('alias', 'Alias', 'required|min_length[2]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('confirm', 'Confirm Password', 'required|');
        $this->form_validation->set_rules('dob','Date of Birth','callback_checkDateFormat');          

        $this->form_validation->set_message('is_unique', '%s is already taken');  //custom error messages
        $this->form_validation->set_message('required', '%s is required');  //custom error messages

        if($this->form_validation->run() === FALSE) //displays error message if form validation rules were violated
        {
            $this->view_data["errors"] = validation_errors();
            $error_log = validation_errors();
            $this->session->set_flashdata("registration_error", $error_log);
            redirect(base_url());

        } 

        else
        {
            $form=$this->input->post(null,true); //pull in post data

            $salt = bin2hex(openssl_random_pseudo_bytes(22));  //encrypts password
            $password = crypt($form['password'],$salt);

            $this->user->add_user($form,$password);
            $this->login();
            redirect(base_url());
        }	
	}

	public function show($id)
    {
        $user=$this->user->get_user_id($id);
        $data = array(
            'user' => $user,
            'home' => 0);

		$this->load->view('index');
        $this->load->view('banner',$data);        
        $this->load->view('user_profile',$data);
    }





}

/* End of file users.php */
/* Location: ./application/controllers/users.php */
