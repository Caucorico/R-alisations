<?php
class ModelEquipes extends CI_Model { 

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function createEquipe($data) {
		$check = (
			"nom =" . "'" . $data['nom'] . "'"
		);

		$this->db->select('*');
		$this->db->from('sport_equipes');
		$this->db->where($check);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$this->db->insert('sport_equipes', $data);
			$this->db->insert(
				'sport_liste_membres', 
				array(
					'idEquipe' => $this->db->insert_id(),
					'login' => $data['administrateur'],
					'entraineur' => TRUE
				)
			);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
		} else {
			return false;
		}
	}

	public function updateEquipe($data) {
		$check = (
			"nom =" . "'" . $data['nom']
			. "' AND " 
			."id !=" . "'" .  $data['id']
			. "'"
		);

		$this->db->select('*');
		$this->db->from('sport_equipes');
		$this->db->where($check);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$this->db->where('id', $data['id']);
			$this->db->update('sport_equipes', $data);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
		} else {
			return false;
		}
	}

	public function deleteEquipe($id) {
		$this->db->where('id', $id);
		$this->db->delete('sport_equipes');
	}

	public function checkIfJoined($idEquipe,$login) {
		$check = (
			"idEquipe =" . "'" . $idEquipe
			. "' AND " 
			."login =" . "'" . $login
			. "'"
		);

		$this->db->select('*');
		$this->db->from('sport_liste_membres');
		$this->db->where($check);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function checkIfEntraineur($idEquipe,$login) {
		$check = (
			"idEquipe =" . "'" . $idEquipe
			. "' AND " 
			."login =" . "'" . $login
			. "' AND " 
			."entraineur = TRUE"
		);

		$this->db->select('*');
		$this->db->from('sport_liste_membres');
		$this->db->where($check);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function joinEquipe($data) {
		$check = (
			"id =" . "'" . $data['id']
			. "' AND " 
			."pwd =" . "'" . $data['pwd']
			. "'"
		);

		$this->db->select('*');
		$this->db->from('sport_equipes');
		$this->db->where($check);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$this->db->insert(
				'sport_liste_membres', 
				array(
					'idEquipe' => $data['id'],
					'login' => $data['login'],
					'entraineur' => $data['entraineur']
				)
			);
			return true;
		} else {
			return false;
		}
	}

	public function getEquipesByLogin($login) {
		$check = (
			"administrateur =" . "'" . $login . "'"
		);
		$this->db->select('*');
		$this->db->from('sport_equipes');
		$this->db->where($check);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}		
	}

	public function listEquipes() {
		$this->db->select(
			'id,nom,sports,ville,description,mixite,logo'
		);
		$this->db->from('sport_equipes');
		$query = $this->db->get();
		return $query->result();
	}

	public function getEquipe($idEquipe) {
		$check = (
			"id =" . "'" . $idEquipe . "'"
		);
		$this->db->select('*');
		$this->db->from('sport_equipes');
		$this->db->where($check);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			return FALSE;
		} else {
			return $query->result();
		}
	}

	public function congedier($data,$admin) {
		$check = (
			"sport_liste_membres.login =" . "'" . $data['login']
			. "' AND " 
			."sport_liste_membres.idEquipe =" . "'" . $data['idEquipe']
			. "' AND " 
			."sport_liste_membres.login != 'sport_equipes.administrateur"
			. "' AND " 
			."sport_equipes.administrateur =" . "'" . $admin 
			. "'"
		);
		$this->db->select('*');
		$this->db->from('sport_liste_membres');
		$this->db->join('sport_equipes', 'sport_liste_membres.idEquipe = sport_equipes.id');
		$this->db->where($check);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			$check = (
				"login =" . "'" . $data['login']
				. "' AND " 
				."idEquipe =" . "'" . $data['idEquipe']
				. "'"
			);
			$this->db->where($check);
			$this->db->delete('sport_liste_membres');
		}	
	}

	public function promouvoir($data,$admin) {
		$check = (
			"sport_liste_membres.login =" . "'" . $data['login']
			. "' AND " 
			."sport_liste_membres.idEquipe =" . "'" . $data['idEquipe']
			. "' AND " 
			."sport_liste_membres.login != 'sport_equipes.administrateur"
			. "' AND " 
			."sport_equipes.administrateur =" . "'" . $admin 
			. "' AND " 
			."sport_liste_membres.entraineur = FALSE" 
		);
		$this->db->select('*');
		$this->db->from('sport_liste_membres');
		$this->db->join('sport_equipes', 'sport_liste_membres.idEquipe = sport_equipes.id');
		$this->db->where($check);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			$check = (
				"login =" . "'" . $data['login']
				. "' AND " 
				."idEquipe =" . "'" . $data['idEquipe']
				. "'"
			);
			$this->db->set('entraineur', 1);
			$this->db->where($check);
			$this->db->update('sport_liste_membres');
		}	
	}

	public function destituer($data,$admin) {
		$check = (
			"sport_liste_membres.login =" . "'" . $data['login']
			. "' AND " 
			."sport_liste_membres.idEquipe =" . "'" . $data['idEquipe']
			. "' AND " 
			."sport_liste_membres.login != 'sport_equipes.administrateur"
			. "' AND " 
			."sport_equipes.administrateur =" . "'" . $admin 
			. "' AND " 
			."sport_liste_membres.entraineur =" . TRUE
		);
		$this->db->select('*');
		$this->db->from('sport_liste_membres');
		$this->db->join('sport_equipes', 'sport_liste_membres.idEquipe = sport_equipes.id');
		$this->db->where($check);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			$check = (
				"login =" . "'" . $data['login']
				. "' AND " 
				."idEquipe =" . "'" . $data['idEquipe']
				. "'"
			);
			$this->db->set('entraineur', 0);
			$this->db->where($check);
			$this->db->update('sport_liste_membres');
		}	
	}

	public function getJoinedEquipes($login) {
		$check = (
			"sport_liste_membres.login =" . "'" . $login
			. "' AND " 
			."sport_equipes.administrateur !=" . "'" . $login 
			. "'"
		);
		$this->db->select('*');
		$this->db->from('sport_equipes');
		$this->db->join('sport_liste_membres', 'sport_equipes.id = sport_liste_membres.idEquipe');
		$this->db->where($check);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			return FALSE;
		} else {
			return $query->result();
		}
	}

	public function getEquipeMembres($idEquipe){	
		$check = (
			"sport_liste_membres.idEquipe =" . "'" . $idEquipe . "'"
		);
		$this->db->select('*');
		$this->db->from('sport_users');
		$this->db->join('sport_liste_membres', 'sport_users.login = sport_liste_membres.login');
		$this->db->where($check);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			return FALSE;
		} else {
			return $query->result();
		}
	}


}