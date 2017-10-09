<?php
class VoirInvitation extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('ModelInvitation');
		$this->load->model('ModelEquipes');
	}

	public function index(){
		if($this->session->logged_in == FALSE){
			redirect('Login');
		} else {
			$data['title'] = "Invitations";
			$this->load->view('Base',$data);
			$this->load->view('Navbar',$this->session->userdata());
			$this->load->view(
				'Succes',array('message' => "Invitations")
			);

			$invitations = $this->ModelInvitation->getInvitations($this->session->login);
			
			if ($invitations != false) {
				foreach ($invitations as $invitation){
					$equipe = $this->ModelEquipes->getEquipe($invitation->idEquipe);
					$this->load->view("CardInvitation",$equipe[0]);
				}
			} else {
				$this->load->view(
					'Succes',array('message' => "Vous n'avez aucune invitation")
				);
			}
		}
	}

	public function accept() {
		$userdata = array(
			'login' => $this->session->login,
			'entraineur' => FALSE,
			'id' => $_GET['idEquipe']
		);
		$result = $this->ModelInvitation->acceptInvitation($userdata);
		if ($result == FALSE) {
			$data['title'] = "Invitations";
			$this->load->view('Base',$data);
			$this->load->view('Navbar',$this->session->userdata());
			$this->load->view(
    			"Erreur",
    			array(
    				'message' => "Erreur..."
    			)
    		);
		} else {
			$this->index();
		}
	}

	public function refuse() {
		$userdata = array(
			'login' => $this->session->login,
			'id' => $_GET['idEquipe']
		);
		$result = $this->ModelInvitation->refuseInvitation($userdata);
		$this->index();
	}
}
?>
