<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MesEquipes extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://dwarves.iut-fbleau.fr/~reszka/sport/MesEquipes
	 *	- or -
	 * 		http://dwarves.iut-fbleau.fr/~reszka/sport/MesEquipes/index
	 */

	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('ModelEquipes');
	}

	public function index() {
		if($this->session->logged_in == FALSE){
			redirect('Login');
		} else {
			$data['title'] = "Mes equipes";
			$this->load->view('Base',$data);			
			$this->load->view('Navbar',$this->session->userdata());
			$this->load->view("Succes",array('message' => "Mes equipes"));

			$equipes = $this->ModelEquipes->getEquipesByLogin($this->session->login);

			if ($equipes == FALSE || count($equipes) < 5) {
				$this->load->view('MesEquipes');
			}

			if ($equipes == FALSE) {

			} else {
				foreach ($equipes as $equipe) {
					$this->load->view("CardMesEquipes",$equipe);
				}
			}

			$joinedEquipes = $this->ModelEquipes->getJoinedEquipes($this->session->login);

			if ($joinedEquipes == FALSE) {
				$this->load->view("Succes",array('message' => "Vous ne participez à aucune équipe"));
			} else {
				$this->load->view("Succes",array('message' => "Equipes auquelles je participe"));
				foreach ($joinedEquipes as $equipe) {
					$equipe->alreadyJoined = "hide";
					$this->load->view("CardEquipe",$equipe);
				}
			}
		}
	}
}
