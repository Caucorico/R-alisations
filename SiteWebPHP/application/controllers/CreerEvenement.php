<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CreerEvenement extends CI_Controller {
	/**
	 * Maps to the following URL
	 * 		http://dwarves.arda/~reszka/sport/CreerEvenement
	 *	- or -
	 * 		http://dwarves.arda/~reszka/sport/CreerEvenement/index
	 */
	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('ModelEvenements');
		$this->load->model('ModelEquipes');
	}


	public function index() { 
		if($this->session->logged_in == FALSE
		|| $this->ModelEquipes->checkIfEntraineur(
				$_GET["idEquipe"], 
				$this->session->login
			) == FALSE
		) {
			redirect('Login');
		} else {
			$data['title'] = "Créer une evenement";
			$this->load->view('Base',$data);			
			$this->load->view('Navbar',$this->session->userdata());
			$viewData['errorMessage'] = "";
			$viewData['idEquipe'] = $_GET["idEquipe"];
			$this->load->view('CreerEvenement',$viewData);
		}
	}

	public function addEvent() {
		$this->form_validation->set_rules('dateEvenement', 'Date', 'trim|required');
		$this->form_validation->set_rules('typeEvenement', 'Type', 'trim|required');
		$this->form_validation->set_rules('lieu', 'Lieu', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = "Créer une evenement";
			$this->load->view('Base',$data);			
			$this->load->view('Navbar',$this->session->userdata());
			$viewData['errorMessage'] = "Veuillez choisir une date";
			$viewData['idEquipe'] = $_GET["idEquipe"];
			$this->load->view('CreerEvenement',$viewData);
		} else {
			$userdata = $this->security->xss_clean(array(
				'idEquipe' => $_GET["idEquipe"],
				'dateEvenement' => $this->input->post('dateEvenement'),
				'typeEvenement' => $this->input->post('typeEvenement'),
				'lieu' => $this->input->post('lieu'),
				'description' => $this->input->post('description')
			));
			$result = $this->ModelEvenements->addEvent($userdata);
			if ($result == TRUE) {
				redirect("VoirEquipe/index/".$_GET["idEquipe"]);
			} else {
				$data['title'] = "Créer une evenement";
				$this->load->view('Base',$data);			
				$this->load->view('Navbar',$this->session->userdata());
				$viewData['errorMessage'] = "Erreur : cet evenement existe déjà";
				$viewData['idEquipe'] = $_GET["idEquipe"];
				$this->load->view('CreerEvenement',$viewData);
			}
		}	
	}
}
