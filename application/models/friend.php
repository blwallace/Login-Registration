<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Friend extends CI_Model {

	public function find_friends($id)
	{
		$query = '	SELECT friends.id as join_id,users.id, users.user_name,users.alias,user_friend.id as friend_id,user_friend.user_name,user_friend.alias
					FROM users
						LEFT JOIN friends on users.id = friends.user_id
						LEFT JOIN users as user_friend on friends.friend_id = user_friend.id
					WHERE users.id = ?
					AND friends.deleted_at IS NULL';
		$values = $id;
		return $this->db->query($query,$values)->result_array();
	}

	public function find_enemies($id)
	{
		$query = '	SELECT *
					FROM users
					WHERE id NOT IN (
						SELECT friend_id 
						FROM friends
						WHERE user_id = ?
						AND deleted_at IS NULL)
					AND id != ?';
		$values = array($id,$id);
		return $this->db->query($query,$values)->result_array();
	}

	public function remove_friend($friend_id,$user_id)
	{
		$query = '	UPDATE friends
					SET deleted_at = ?
					WHERE user_id = ?
					AND friend_id = ?
					AND deleted_at IS NULL';
		$values = array('Now()',$user_id,$friend_id);
		return $this->db->query($query,$values);
	}

	public function add_friend($friend_id,$user_id)
	{
		$query = '	INSERT INTO FRIENDS (user_id,friend_id,created_at)
					VALUES (?,?,Now())';
		$values = array($user_id,$friend_id);
		return $this->db->query($query,$values);
	}

}

/* End of file friend.php */
/* Location: ./application/models/friend.php */