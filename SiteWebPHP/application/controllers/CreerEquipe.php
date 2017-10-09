<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CreerEquipe extends CI_Controller {
	/**
	 * Maps to the following URL
	 * 		http://dwarves.arda/~reszka/sport/CreerEquipe
	 *	- or -
	 * 		http://dwarves.arda/~reszka/sport/CreerEquipe/index
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
			$data['title'] = "Créer une equipe";
			$this->load->view('Base',$data);			
			$this->load->view('Navbar',$this->session->userdata());
			$viewData['errorMessage'] = "";
			$this->load->view('CreerEquipe',$viewData);
		}
	}

	public function createEquipe() {
		$this->form_validation->set_rules('nom', 'Nom', 'trim|required');
		$this->form_validation->set_rules('sports', 'Sports', 'trim|required');
		$this->form_validation->set_rules('ville', 'Ville', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$userdata = $this->security->xss_clean(array(
				'id' => '',
				'nom' => $this->input->post('nom'),
				'pwd' => $this->input->post('pwd'),
				'sports' => $this->input->post('sports'),
				'ville' => $this->input->post('ville'),
				'description' => $this->input->post('description'),
				'mixite' => $this->input->post('mixite'),
				'logo' => $this->input->post('logo'),
				'photo' => $this->input->post('photo'),
				'administrateur' => $this->session->login
			));
			$result = $this->ModelEquipes->createEquipe($userdata);
			if ($result == TRUE) {
				redirect("MesEquipes");
			} else {
				$data['title'] = "Créer une equipe";
				$this->load->view('Base',$data);			
				$this->load->view('Navbar',$this->session->userdata());
				$viewData['errorMessage'] = "Erreur : ce nom d'équipe à déjà été enregistré";
				$this->load->view('CreerEquipe',$viewData);
			}
		}	
	}
}
