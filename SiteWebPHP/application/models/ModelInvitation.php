<?php
class ModelInvitation extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function getInvitations($login){
		$check = (
			"login =" . "'" . $login . "'"
		);
		$this->db->select('*');
		$this->db->from('sport_invitations');
		$this->db->where($check);

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	public function acceptInvitation($data) {
		$this->db->insert(
			'sport_liste_membres', 
			array(
				'idEquipe' => $data['id'],
				'login' => $data['login'],
				'entraineur' => $data['entraineur']
			)
		);
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function refuseInvitation($data) {
		$check = (
			"idEquipe =" . "'" . $data['id']
			. "' AND "
			."login =" . "'" . $data['login'] 
			. "'"
		);	
		$this->db->where($check);
		$this->db->delete('sport_invitations');
	}

	public function envoyerInvitation($data) {
		$check = (
			"idEquipe =" . "'" . $data['idEquipe']
			. "' AND "
			."login =" . "'" . $data['login'] 
			. "'"
		);	

		$this->db->select('*');
		$this->db->from('sport_invitations');
		$this->db->where($check);
		$this->db->limit(1);

		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$this->db->insert('sport_invitations', $data);
			if ($this->db->affected_rows() > 0) {
				return 0;
			}else{
				return -1;
			}
		} else {
			return -2;
		}
	}
}