<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipes extends CI_Controller {
	/**
	 * Maps to the following URL
	 * 		http://dwarves.iut-fbleau.fr/~reszka/sport/Equipes
	 *	- or -
	 * 		http://dwarves.iut-fbleau.fr/~reszka/sport/Equipes/index
	 */

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('ModelEquipes');
	}

	public function index() {
		if($this->session->logged_in == FALSE){
			redirect('Login');
		} else {
			$data['title'] = "Equipes";
			$this->load->view('Base',$data);			
			$this->load->view('Navbar',$this->session->userdata());
			$this->load->view(
				'Succes',array('message' => "Equipes")
			);
			$this->displayEquipes();
		}
	}

	public function displayEquipes() {
		$equipes = $this->ModelEquipes->listEquipes();

		foreach ($equipes as $equipe) {
			$joined = $this->ModelEquipes->checkIfJoined(
				$equipe->id,
				$this->session->login
			);
			if ($joined == TRUE) {
				$equipe->alreadyJoined = "hide";	
			} else {
				$equipe->alreadyJoined = "";
			}
			
			$this->load->view("CardEquipe",$equipe);
		}
	}
}
