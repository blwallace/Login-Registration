<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        // $this->output->enable_profiler();
		$this->load->model('user');

	}

	public function index($id)
	{

	}

    public function login(){
        print_r($_REQUEST);
    }

	// public function login()
	// {
	// 	$email = $this->input->post('email');
	// 	$password = $this->input->post('password');

	// 	$data_users = $this->user->get_user($email);
		

 //      	if(isset($data_users[0]))
 //        {
 //        	$data = $data_users[0];

 //            if(password_verify($password,$data['password'])) //do the encrypted passwords match? if yes, then log in
 //            {
 //                //log the login
 //                $this->user->login_attempt_successful($data['id'],$this->input->ip_address());

 //                $user = array(
 //                   'user_id' => $data['id'],
 //                   'user_email' => $data['email'],
 //                   'user_name' => $data['user_name'],
 //                   'alias' => $data['alias'],
 //                   'is_logged_in' => true,
 //                   'updated_at' => $data['updated_at'],
 //                );
 //                if(!$this->check_login_expiration('-60 day','Now',$data['updated_at']))
 //                {
 //                    $this->session->set_flashdata("login_error", "Last password change was >60 days ago. <a href = '/users/reset'>Please consider resetting your password </a>");
 //                }
 //                $this->session->set_userdata($user);
	// 			redirect('/friends/index');	
 //            }
 //            else
 //            {
 //                $this->session->set_flashdata("login_error", "Invalid email or password!");
 //                if(isset($data_users[0]))
 //                {
 //                    $this->user->login_attempt_unsuccessful($data['id'],$this->input->ip_address());
                    
 //                    if($this->check_logins_fail($data['id'])){
 //                        $this->session->set_flashdata("login_error", "Invalid email or password! Too many Login Failures, your account has been locked.  ");
 //                        $this->kill_account($data['email']);
 //                        redirect('/users/reset');  
 //                    }
 //                }
 //                redirect('');
                     
 //            }
 //        }

 //        else
 //             {
 //                $this->session->set_flashdata("login_error", "Invalid email or password!");
 //                if(isset($data_users[0]))
 //                {
 //                    $this->user->login_attempt_unsuccessful($data['id'],$this->input->ip_address());
                    
 //                    if($this->check_logins_fail($data['id'])){
 //                        $this->session->set_flashdata("login_error", "Invalid email or password! Too many Login Failures");
 //                        $this->kill_account($data['email']);
 //                        redirect('/users/reset');  
 //                    }
 //                }
 //                redirect('');
                     
 //            }


	// 	$this->load->view('index');  
	// }

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
        $this->load->library('MY_Form_validation');

        //will require user to enter information
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('user_name', 'Name', 'required|min_length[2]');
        $this->form_validation->set_rules('alias', 'Alias', 'required|min_length[2]');
        $this->form_validation->set_rules('dob','Date of Birth','callback_checkDateFormat');          
        $this->form_validation->set_rules('answer','Answer to security question','required');          

        // these are password specific rules
        $this->form_validation->set_rules('password', 'Password', 'required|matches[confirm]|min_length[8]|password_check[1,1,1]');
        $this->form_validation->set_rules('confirm', 'Confirm Password', 'required|');

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

            
            $password = password_hash($form['password'],PASSWORD_BCRYPT);

            $this->user->add_user($form,$password);
            $user = $this->user->get_user($form['email']);
            $this->user->add_password($user[0]['id'],$password);
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

    public function reset()
    {
        $this->load->view('index');
        $this->load->view('partials/reset');
    }    

//returns true if the user hasn't reached his check in limit
    public function check_logins_fail($id){
        $logins = $this->user->check_failed_login_attempts($id);
        $indicator = true;
        if(count($logins) >= 5){

            for($i = 0; $i < 5; $i++){
                

                if($logins[$i]['successful'] == 1){
                    $indicator = false;
                }

            }}
        else{
            $indicator = false;
        }
        
        return $indicator;

//blwallace2015@gmail.com
//19871987a
    }


    public function check_login_expiration($start_date, $end_date, $date_from_user)
    {
      // Convert to timestamp
      $start_ts = strtotime($start_date);
      $end_ts = strtotime($end_date);
      $user_ts = strtotime($date_from_user);

      // Check that user date is between start & end
      return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
    }

    public function question(){
        $form=$this->input->post(null,true); //pull in post data
        $result = $this->user->get_question($form['email']);
        
        //if valid login
        if(isset($result[0]))
        {
            $data = array('json' => $result[0]);
            $this->load->view('/partials/json',$data);
        }
        else{
            $data = array('json' => array('question'=>"What is your favorite sports team?"));
            $this->load->view('/partials/json',$data);
        }
    }

    public function answer(){
        $form=$this->input->post(null,true); //pull in post data
        $result = $this->user->get_answer($form['email'],$form['answer']);
        
        //if valid login
        if(isset($result[0]))
        {
            $data = array('json' => array('question'=>1));
            $this->load->view('/partials/json',$data);
        }
        else{
            $data = array('json' => array('question'=>0));
            $this->load->view('/partials/json',$data);
        }
    }

    public function resetpassword(){
        $form=$this->input->post(null,true); //pull in post data    

        // $this->main->admin_validation();
        $this->load->library('form_validation');
        $this->load->library('MY_Form_validation');
        // these are password specific rules
        $this->form_validation->set_rules('password', 'Password', 'required|matches[confirm]|min_length[8]|password_check[1,1,1]');
        
        if($this->form_validation->run() === FALSE) //displays error message if form validation rules were violated
        {
            $data = array('json' => array('question'=>"0"));
        }    
        else{
            
            $password = password_hash($form['password'],PASSWORD_BCRYPT);
            $result = $this->user->reset_password($form['email'],$password);

            $user = $this->user->get_user($form['email']);
            //if password isn't original for user do this
            if($this->password_not_original($user[0]['id'],$form['password'])){
                $data = array('json' => array('question'=>"Please choose a password you haven't used before. Password not reset. <a href='/users/reset'>Try again</a> "));
            }
            //if password is original, reset
            else{
                $this->user->add_password($user[0]['id'],$password);
                $data = array('json' => array('question'=>"Password Reset"));
            }


        } 

        $this->load->view('/partials/json',$data);

    }

    public function kill_account($email){
            $salt = bin2hex(openssl_random_pseudo_bytes(22));  //encrypts password
            $password = crypt($salt,$salt);
            $result = $this->user->reset_password($email,$password);
            
            $data = array('json' => array('question'=>"Password Reset"));
    }

    private function password_not_original($id,$password){
        $result = $this->user->password_original($id);
        $bool = false;

        for($i=0;$i<count($result);$i++){
            if(password_verify($password, $result[$i]['password'])){
                $bool = true;
            }
        }

        return $bool;
    }

    public function password_test(){
            $un = 'Blahblah1!3';
            $password = password_hash($un,PASSWORD_BCRYPT);
            if(password_verify('Blahblah1!', $password)){
                echo $password;
            }
    }





}

/* End of file users.php */
/* Location: ./application/controllers/users.php */
