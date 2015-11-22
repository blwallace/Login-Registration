<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {

	public function add_user($form,$password)
	{
		$query= 'INSERT INTO users (user_name,alias,email,password,created_at,dob,updated_at,question,answer) VALUES (?,?,?,?,Now(),Now(),Now(),?,?)';
		$values= array($form['user_name'],$form['alias'],$form['email'],$password,$form['question'],$form['answer']);
		return $this->db->query($query,$values);		
	}

	public function update_user($form,$id)
	{
		$query = 'UPDATE users SET email=?,user_name=?,alias=? WHERE id=?';
		$values = array($form['email'],$form['user_name'],$form['alias'],$id);
		return $this->db->query($query,$values);
	}

	public function get_user($email)
	{
		$query = 'SELECT * FROM users WHERE email like? and deleted_at IS NULL';
		$values = $email;
		return $this->db->query($query,$values)->result_array();
	}	

	public function get_user_id($id)
	{
		$query = 'SELECT * FROM users WHERE id =? and deleted_at IS NULL';
		$values = $id;
		return $this->db->query($query,$values)->result_array();
	}

	public function login_attempt_successful($id,$ip){
		$query = 'INSERT INTO logins(user_id,created_at,successful,ip_address) VALUES (?,NOW(),1,?)';
		$values = array($id,$ip);
		return $this->db->query($query,$values);
	}

	public function login_attempt_unsuccessful($id,$ip){
		$query = 'INSERT INTO logins(user_id,created_at,successful,ip_address) VALUES (?,NOW(),0,?)';
		$values = array($id,$ip);
		return $this->db->query($query,$values);
	}

	public function check_failed_login_attempts($id){
		$query = 'SELECT * FROM logins WHERE user_id = ? ORDER BY id DESC LIMIT 5';
		$values = array($id);
		return $this->db->query($query,$values)->result_array();
	}

	public function get_question($email){
		$query = 'SELECT question FROM users WHERE email = ?';
		$values = array($email);
		return $this->db->query($query,$values)->result_array();
	}
	public function get_answer($email,$answer){
		$query = 'SELECT question FROM users WHERE email = ? AND answer = ?';
		$values = array($email,$answer);
		return $this->db->query($query,$values)->result_array();
	}

	public function reset_password($email,$password){
		$query = 'UPDATE users SET password=? WHERE email=?';
		$values = array($password,$email);
		return $this->db->query($query,$values);
	}

	public function add_password($id,$password)
	{
		$query= 'INSERT INTO account_history (userid,password,created_at) VALUES (?,?,Now())';
		$values= array($id,$password);
		return $this->db->query($query,$values);		
	}

	public function password_original($id){
		$query="SELECT * FROM account_history WHERE userid=?";
		$values= array($id);
		return $this->db->query($query,$values)->result_array();
	}	

}

/* End of file user.php */
/* Location: ./application/models/user.php */