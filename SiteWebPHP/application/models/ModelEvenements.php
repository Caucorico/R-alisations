<?php
class ModelEvenements extends CI_Model { 

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function getEvenements($data) {
		$check = (
			"idEquipe =" . "'" . $data["idEquipe"] 
			. "' AND " 
			."YEAR(dateEvenement) =" . "'" . $data['year']
			. "' AND " 
			."MONTH(dateEvenement) =" . "'" . $data['month']
			. "'"
		);
		$this->db->select('*');
		$this->db->from('sport_evenements');
		$this->db->where($check);
		$query = $this->db->get();

		return $query->result();
	}

	public function getEventByDate($idEquipe,$date) {
		$check = (
			"idEquipe =" . "'" . $idEquipe 
			. "' AND " 
			."dateEvenement =" . "'" . $date
			. "'"
		);
		$this->db->select('*');
		$this->db->from('sport_evenements');
		$this->db->where($check);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	public function getParticipants($idEquipe,$date) {
		$check = (
			"idEquipe =" . "'" . $idEquipe 
			. "' AND " 
			."dateEvenement =" . "'" . $date
			. "'"
		);
		$this->db->select('*');
		$this->db->from('sport_evenements_participants');
		$this->db->where($check);
		$query = $this->db->get();

		return $query->result();
	}

	public function addEvent($data) {	
		$check = (
			"idEquipe =" . "'" . $data['idEquipe']
			. "' AND "
			."dateEvenement =" . "'" . $data['dateEvenement'] 
			. "'"
		);

		$this->db->select('*');
		$this->db->from('sport_evenements');
		$this->db->where($check);
		$this->db->limit(1);

		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$this->db->insert('sport_evenements', $data);
			if ($this->db->affected_rows() > 0) {
				return TRUE;
			}else{
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	public function declarerPresent($data) {	
		$check = (
			"idEquipe =" . "'" . $data['idEquipe']
			. "' AND "
			."dateEvenement =" . "'" . $data['dateEvenement'] 
			. "' AND "
			."login =" . "'" . $data['login'] 
			. "'"
		);

		$this->db->select('*');
		$this->db->from('sport_evenements_participants');
		$this->db->where($check);
		$this->db->limit(1);

		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$this->db->insert('sport_evenements_participants', $data);
		} else {
			$this->db->set('seraPresent', $data['seraPresent']);
			$this->db->where($check);
			$this->db->update('sport_evenements_participants');
		}
	}
}