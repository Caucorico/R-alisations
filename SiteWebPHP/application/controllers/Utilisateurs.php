<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilisateurs extends CI_Controller {
	/**
	 * Maps to the following URL
	 * 		http://dwarves.arda/~reszka/sport/Utilisateurs
	 *	- or -
	 * 		http://dwarves.arda/~reszka/sport/Utilisateurs/index
	 */

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('ModelUtilisateurs');
	}

	public function index() {
		if($this->session->logged_in == FALSE){
			redirect('Login');
		} else {
			$data['title'] = "Utilisateurs";
			$this->load->view('Base',$data);
			$this->load->view('Navbar',$this->session->userdata());
			$this->load->view(
				'Succes',array('message' => "Utilisateurs")
			);
			$this->displayUsers();
		}
	}

	public function displayUsers() {
		$users = $this->ModelUtilisateurs->listUsers($this->session->login);

		foreach ($users as $user) {
			$user->showCongedier = "hide";
			$user->showPromouvoir = "hide";
			$user->showDestituer = "hide";
			$user->showInviter = "";
			$user->idEquipe = "";
			$this->load->view("CardUtilisateur",$user);
		}
	}
}
