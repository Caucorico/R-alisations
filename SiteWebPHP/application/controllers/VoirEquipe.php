<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VoirEquipe extends CI_Controller {
	/**
	 * Maps to the following URL
	 * 		http://iut-fbleau.fr/~reszka/sport/VoirEquipe
	 *	- or -
	 * 		http://iut-fbleau.fr/~reszka/sport/VoirEquipe/index
	 */
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('ModelEquipes');
		$this->load->model('ModelEvenements');
		$this->load->helper('date');
	}

	public function index() {
		if($this->session->logged_in == FALSE) {
			redirect('Login');
		} else {
			$equipe = $this->ModelEquipes->getEquipe($this->uri->segment(3));
			if ($equipe == FALSE) {
				$data['title'] = "Equipe non trouvée";
				$this->load->view('Base',$data);			
				$this->load->view('Navbar',$this->session->userdata());
				$this->load->view("Erreur",array('message' => "Cette equipe n'existe pas"));

			} else {
				$data['title'] = $equipe[0]->nom;
				$this->load->view('Base',$data);			
				$this->load->view('Navbar',$this->session->userdata());

				if ($this->ModelEquipes->checkIfJoined(
					$equipe[0]->id, $this->session->login
				)) {
					$preferences = array(
						'start_day'    => 'monday',
						'show_next_prev'  => TRUE,
						'next_prev_url' => base_url() . 'index.php/VoirEquipe/index/'.$equipe[0]->id
					);
					$this->load->library('calendar',$preferences);
					if ($this->uri->segment(4) != null && $this->uri->segment(5) != null) {
						$year = $this->uri->segment(4);
						$month = $this->uri->segment(5);
					} else {
						$year = date("Y");
						$month = date("m");
					}
					
					$queryData = array(
						'idEquipe' => $equipe[0]->id, 
						'year' => $year,
						'month' => $month
					);
					$calendarData = $this->ModelEvenements->getEvenements($queryData);
					$equipe[0]->calendrier = $this->generateCalendar(
						$year, $month, $calendarData
					);
					if ($this->ModelEquipes->checkIfEntraineur(
						$equipe[0]->id, $this->session->login
					)) {
						$equipe[0]->showEntraineur = "";
					} else {
						$equipe[0]->showEntraineur = "hide";
					}
				} else {
					$equipe[0]->showEntraineur = "hide";
				}
				$this->load->view('VoirEquipe',$equipe[0]);

				$membres = $this->ModelEquipes->getEquipeMembres($this->uri->segment(3));
				if ($membres != FALSE) {
					$this->load->view("Succes",array('message' => "Membres"));
					foreach ($membres as $membre) {
						if ($this->session->login == $equipe[0]->administrateur
						&& $membre->login != $this->session->login) {
							$membre->showCongedier = "";
							if ($membre->entraineur == FALSE) {
								$membre->showPromouvoir = "";
								$membre->showDestituer = "hide";
							} else {
								$membre->showPromouvoir = "hide";
								$membre->showDestituer = "";
							}
						} else {
							$membre->showCongedier = "hide";
							$membre->showPromouvoir = "hide";
							$membre->showDestituer = "hide";
						}
						$membre->showInviter = "hide";
						$membre->idEquipe = $equipe[0]->id;
						$this->load->view("CardUtilisateur",$membre);
					}
				} 
				
			}
		}
	}

	public function generateCalendar($annee = null,$mois = null,$data) {
		$days = array();
		foreach ($data as $day) {
			$days[date('d', strtotime($day->dateEvenement))] = (
				base_url() 
				. 'index.php/VoirEvenement/index/'
				.  $day->idEquipe
				. '/' 
				. $day->dateEvenement
			);
			
		}
		return $this->calendar->generate($annee,$mois,$days);
	}

	public function promouvoir() {
		$userdata = array(
			'idEquipe' => $_GET['idEquipe'],
			'login' => $_GET['login']
		);
		$result = $this->ModelEquipes->promouvoir($userdata,$this->session->login);
		redirect("VoirEquipe/index/".$_GET['idEquipe']);
	}

	public function destituer() {
		$userdata = array(
			'idEquipe' => $_GET['idEquipe'],
			'login' => $_GET['login']
		);
		$result = $this->ModelEquipes->destituer($userdata,$this->session->login);
		redirect("VoirEquipe/index/".$_GET['idEquipe']);
	}

	public function congedier() {
		$userdata = array(
			'idEquipe' => $_GET['idEquipe'],
			'login' => $_GET['login']
		);
		$result = $this->ModelEquipes->congedier($userdata,$this->session->login);
		redirect("VoirEquipe/index/".$_GET['idEquipe']);
	}
}
