<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EnvoyerInvitation extends CI_Controller {
	/**
	 * Maps to the following URL
	 * 		http://dwarves.iut-fbleau.fr/~reszka/sport/EnvoyerInvitation
	 *	- or -
	 * 		http://dwarves.iut-fbleau.fr/~reszka/sport/EnvoyerInvitation/index
	 */

	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('ModelEquipes');
		$this->load->model('ModelUtilisateurs');
		$this->load->model('ModelInvitation');
	}

	public function index() {
		if($this->session->logged_in == FALSE){
			redirect('Login');
		} else {
			$data['title'] = "Inviter";
			$this->load->view('Base',$data);
			$this->load->view('Navbar',$this->session->userdata());
			
			$user = $this->ModelUtilisateurs->getUserByLogin($_GET['userLogin']);
        	$equipes = $this->ModelEquipes->getEquipesByLogin($this->session->login);
   	
        	if ($user == FALSE) {
        		$this->load->view(
        			"Erreur",array('message' => "Cet utilisateur n'existe pas")
        		);
        	} else if ($equipes == FALSE) {
        		$this->load->view(
        			"Erreur",array('message' => "Vous n'avez pas créé d'équipes")
        		);
        	} else {
        		$i = 0;
        		$n = 0;
        		foreach ($equipes as $equipe) {
        			if ($this->ModelEquipes->checkIfJoined($equipe->id,$user[0]->login)) {
        				$equipes[$n] = NULL;
        			} else {
        				$i = $i + 1;
        			}
        			$n = $n + 1; 
        		}
        		if ($i > 0) {
        			$this->load->view(
	        			"EnvoyerInvitation",
	        			array(
	        				'user'=>$user[0],
	        				'equipes'=>$equipes
	        			)
	        		);
        		} else {
        			$this->load->view(
        			"Erreur",array('message' => "Cet utilisateur a déjà rejoint toutes vos equipes")
        		);
        		}	
        	}
		}
	}

	public function envoiInvitation(){
		$this->form_validation->set_rules('equipe', 'Equipe', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$equipeData = $this->security->xss_clean(array(
				'idEquipe' => $this->input->post('equipe'),
				'login' => $_GET['userLogin']
			));
			$result = $this->ModelInvitation->envoyerInvitation($equipeData);
			$data['title'] = "Inviter";
			$this->load->view('Base',$data);
			$this->load->view('Navbar',$this->session->userdata());
			
			if ($result == 0) {
				$this->load->view(
					'Succes',array('message' => "Invitation envoyée !")
				);
			} else if ($result == -1) {
				$this->load->view(
        			"Erreur",array('message' => "Erreur lors de l'envoi de l'invitation")
        		);
			} else if ($result == -2) {
				$this->load->view(
        			"Erreur",
        			array(
        				'message' => "Cet utilisateur a déjà reçu une invitation pour cette equipe"
        			)
        		);
			}
		}
	}
}