<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RejoindreEquipe extends CI_Controller {
	/**
	 * Maps to the following URL
	 * 		http://iut-fbleau.fr/~reszka/sport/RejoindreEquipe
	 *	- or -
	 * 		http://iut-fbleau.fr/~reszka/sport/RejoindreEquipe/index
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
			if ($equipe == FALSE) {
				$data['title'] = "Equipe non trouvée";
				$this->load->view('Base',$data);			
				$this->load->view('Navbar',$this->session->userdata());
				$this->load->view(
        			"Erreur",array('message' => "Cette equipe n'existe pas")
        		);
			} else {
				$result = $this->ModelEquipes->checkIfJoined(
					$equipe[0]->id,
					$this->session->login
				);

				if ($result == FALSE) {
					$data['title'] = "Rejoindre ".$equipe[0]->nom;
					$this->load->view('Base',$data);			
					$this->load->view('Navbar',$this->session->userdata());

					if ($equipe[0]->pwd == "") {
						$userdata = array(
							'login' => $this->session->login,
							'entraineur' => FALSE,
							'id' => $equipe[0]->id,
							'pwd' => ""
						);
						$result = $this->ModelEquipes->joinEquipe($userdata);
						if ($result == FALSE) {
							$this->load->view(
		        				"Erreur",array('message' => "Erreur...")
		        			);
						} else {
							$this->load->view('BienvenueDansEquipe',$equipe[0]);
						}
					} else {
						$equipe[0]->errorMessage = "";
						$this->load->view("RejoindreEquipe",$equipe[0]);
					}	
				} else {
					redirect("Equipes");
				}
			}
		}
	}

	public function joinEquipe() {
		$this->form_validation->set_rules('pwd', 'Password', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$userdata = $this->security->xss_clean(array(
				'login' => $this->session->login,
				'entraineur' => FALSE,
				'id' => $this->input->post('id'),
				'pwd' => $this->input->post('pwd'),
				'nom' => $this->input->post('nom')
			));
			$result = $this->ModelEquipes->joinEquipe($userdata);
			if ($result == FALSE) {
				$data['title'] = "Rejoindre ".$userdata['nom'];
				$this->load->view('Base',$data);			
				$this->load->view('Navbar',$this->session->userdata());
				$userdata['errorMessage'] = "Erreur : mauvais mot de passe";
				$this->load->view("RejoindreEquipe",$userdata);
			} else {
				$data['title'] = "Rejoindre ".$userdata['nom'];
				$this->load->view('Base',$data);			
				$this->load->view('Navbar',$this->session->userdata());
				$this->load->view("BienvenueDansEquipe",$userdata);
			}
		}	
	}
}
