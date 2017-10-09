<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModifierEquipe extends CI_Controller {
	/**
	 * Maps to the following URL
	 * 		http://iut-fbleau.fr/~reszka/sport/ModifierEquipe
	 *	- or -
	 * 		http://iut-fbleau.fr/~reszka/sport/ModifierEquipe/index
	 */
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('ModelEquipes');
	}

	public function index() {
		if($this->session->logged_in == FALSE 
		|| !isset($_GET['equipeID'])) {
			redirect('Login');
		} else {
			$equipe = $this->ModelEquipes->getEquipe($_GET['equipeID']);
			if ($equipe == FALSE 
			|| $equipe[0]->administrateur != $this->session->login) {
				redirect("MesEquipes");
			} else {
				$data['title'] = "Modifier ".$equipe[0]->nom;
				$this->load->view('Base',$data);			
				$this->load->view('Navbar',$this->session->userdata());
				$equipe[0]->errorMessage = "";
				$equipe[0]->successMessage = "";
				$this->load->view('ModifierEquipe',$equipe[0]);
			}
		}
	}

	public function updateEquipe() {
		$this->form_validation->set_rules('nom', 'Nom', 'trim|required');
		$this->form_validation->set_rules('sports', 'Sports', 'trim|required');
		$this->form_validation->set_rules('ville', 'Ville', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$userdata = $this->security->xss_clean(array(
				'id' => $this->input->post('id'),
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
			$result = $this->ModelEquipes->updateEquipe($userdata);
			if ($result == TRUE) {
				$data['title'] = "Modifier ".$userdata['nom'];
				$this->load->view('Base',$data);			
				$this->load->view('Navbar',$this->session->userdata());
				$userdata['errorMessage'] = "";
				$userdata['successMessage'] = "Equipe modifiée avec succès";
				$this->load->view('ModifierEquipe',$userdata);
			} else {
				$data['title'] = "Modifier ".$userdata['nom'];
				$this->load->view('Base',$data);			
				$this->load->view('Navbar',$this->session->userdata());
				$userdata['errorMessage'] = "Erreur : ce nom à déjà été enregisté";
				$userdata['successMessage'] = "";
				$this->load->view('ModifierEquipe',$userdata);
			}
		}	
	}

	public function deleteEquipe() {
		$this->ModelEquipes->deleteEquipe($_GET['id']);
		redirect("MesEquipes");
	}
}
