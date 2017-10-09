<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VoirEvenement extends CI_Controller {
	/**
	 * Maps to the following URL
	 * 		http://dwarves.arda/~reszka/sport/VoirEvenement
	 *	- or -
	 * 		http://dwarves.arda/~reszka/sport/VoirEvenement/index
	 */
	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('ModelEvenements');
		$this->load->model('ModelEquipes');
		$this->load->model('ModelUtilisateurs');
	}

	public function index() { 
		if($this->session->logged_in == FALSE
		|| $this->ModelEquipes->checkIfJoined(
				$this->uri->segment(3), 
				$this->session->login
			) == FALSE || $this->uri->segment(4) == null
		) {
			redirect('Login');
		} else {
			$data['title'] = "Evenement";
			$this->load->view('Base',$data);			
			$this->load->view('Navbar',$this->session->userdata());

			$equipe = $this->ModelEquipes->getEquipe($this->uri->segment(3));

			$this->load->view(
				'Succes',array('message' => $equipe[0]->nom)
			);

			$evenement = $this->ModelEvenements->getEventByDate(
				$this->uri->segment(3),
				$this->uri->segment(4)
			);
		
			if ($evenement != false) {
				$this->load->view('VoirEvenement',$evenement[0]);

				$participants = $this->ModelEvenements->getParticipants(
					$this->uri->segment(3),
					$this->uri->segment(4)
				);

				foreach ($participants as $participant) {
					$user = $this->ModelUtilisateurs->getUserByLogin($participant->login);
					if ($participant->seraPresent == 1) {
						$user[0]->message = "sera présent";
					} else {
						$user[0]->message = "sera absent";
					}
					$this->load->view(
						'CardParticipant',$user[0]
					);
				}
			} else {
				$this->load->view(
					'Erreur',array('message' => "Cet evenement n'existe pas")
				);
			}
		}
	}

	public function present() {
		$userdata = $this->security->xss_clean(array(
			'idEquipe' => $_GET['idEquipe'],
			'dateEvenement' => $_GET['dateEvenement'],
			'seraPresent' => $_GET['participe'],
			'login' => $this->session->login
		));
		
		$this->ModelEvenements->declarerPresent($userdata);

		redirect(
			"VoirEvenement/index/"
			.  $_GET['idEquipe']
			. '/' 
			. $_GET['dateEvenement']
		);	
	}
}
