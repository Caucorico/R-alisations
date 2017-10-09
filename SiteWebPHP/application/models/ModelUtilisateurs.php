<?php
class ModelUtilisateurs extends CI_Model { 

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function register($userdata) {
		$check = (
			"email =" . "'" . $userdata['email']
			. "' OR "
			."login =" . "'" . $userdata['login'] 
			. "'"
		);

		$this->db->select('*');
		$this->db->from('sport_users');
		$this->db->where($check);
		$this->db->limit(1);

		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$hash = sha1($userdata['pwd']);
			$userdata['pwd'] = $hash;
			$this->db->insert('sport_users', $userdata);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
		} else {
			return false;
		}
	}

	public function login($userdata) {
		$hash = sha1($userdata['pwd']);
		$userdata['pwd'] = $hash;
		$check = (
			"email =" . "'" . $userdata['email'] 
			. "' AND " 
			. "pwd =" . "'" . $userdata['pwd'] 
			. "'"
		);

		$this->db->select('*');
		$this->db->from('sport_users');
		$this->db->where($check);
		$this->db->limit(1);

		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function changePassord($userdata) {

		$userdata['oldpwd'] = sha1($userdata['oldpwd']);
		$userdata['pwd']    = sha1($userdata['pwd']);
		$check = (
			"login =" . "'" . $userdata['login'] 
			. "' AND " 
			. "pwd =" . "'" . $userdata['oldpwd'] 
			. "'"
		);

		$this->db->set('pwd', $userdata['pwd']);
		$this->db->where($check);
		$this->db->update('sport_users');

        if ($this->db->affected_rows() > 0 
       	|| $userdata['oldpwd'] == $userdata['pwd']) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function changeEmail($userdata) {
		$check = (
			"email =" . "'" . $userdata['email'] . "'"
		);
		$this->db->select('*');
		$this->db->from('sport_users');
		$this->db->where($check);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$userdata['pwd']    = sha1($userdata['pwd']);
			$check = (
				"login =" . "'" . $userdata['login'] 
				. "' AND " 
				. "email =" . "'" . $userdata['oldemail'] 
				. "' AND " 
				. "pwd =" . "'" . $userdata['pwd'] 
				. "'"
			);

			$this->db->set('email', $userdata['email']);
			$this->db->where($check);
			$this->db->update('sport_users');

	        if ($this->db->affected_rows() > 0) {
				return 1;
			} else {
				return 0;
			}
		} else {
			return -1;
		}
	}

	public function listUsers($login) {
		$check = (
			"login !=" . "'" . $login . "'"
		);
		$this->db->select('nom, prenom, avatar, login');
		$this->db->from('sport_users');
		$this->db->where($check);
		$query = $this->db->get();
	
		return $query->result();
	}

	public function getUserByLogin($login) {
		$check = (
			"login =" . "'" . $login . "'"
		);
		$this->db->select('nom, prenom, avatar, login');
		$this->db->from('sport_users');
		$this->db->where($check);
		$this->db->limit(1);
		$query = $this->db->get();
	
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
}