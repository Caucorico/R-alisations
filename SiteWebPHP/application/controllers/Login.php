<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Maps to the following URL
	 * 		http://dwarves.arda/~reszka/sport/Login
	 *	- or -
	 * 		http://dwarves.arda/~reszka/sport/Login/index
	 */

	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('ModelUtilisateurs');
		//$this->load->library('security');
	}

	public function index() {
		if($this->session->logged_in == TRUE){
			redirect('Equipes');
		} else {
			$data['title'] = "Connexion";
			$this->load->view('Base', $data);
			$viewData = array(
				'loginError' => '',
				'registerError' => '',
				'registerSuccess' => ''
			);
			$this->load->view('Login',$viewData);
		}
	}


	public function register() {
		$this->form_validation->set_rules('firstname', 'Prénom', 'trim|required');
		$this->form_validation->set_rules('lastname', 'Nom', 'trim|required');
		$this->form_validation->set_rules('login', 'Login', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('pwd', 'Password', 'trim|required');
		$this->form_validation->set_rules('confirmpwd', 'Confirm Password', 'trim|required|matches[pwd]');

		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$userdata = $this->security->xss_clean(array(
				'nom' => $this->input->post('lastname'),
				'prenom' => $this->input->post('firstname'),
				'login' => $this->input->post('login'),
				'pwd' => $this->input->post('pwd'),
				'email' => $this->input->post('email'),
				'avatar' => $this->input->post('avatar')
			));
			$result = $this->ModelUtilisateurs->register($userdata);
			if ($result == TRUE) {
				$viewData = array(
					'loginError' => '',
					'registerError' => '',
					'registerSuccess' => 'Votre compte à bien été créé'
				);
			} else {
				$viewData = array(
					'loginError' => '',
					'registerError' => 'Nom d\'utilisateur ou email déjà enregistré',
					'registerSuccess' => ''
				);
			}
			$data['title'] = "Connexion";
			$this->load->view('Base', $data);
			$this->load->view('Login',$viewData);
		}	
	}

	public function login() {
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('loginpwd', 'Password', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$userdata = $this->security->xss_clean(array(
				'email' => $this->input->post('email'),
				'pwd' => $this->input->post('loginpwd')
			));
			$user = $this->ModelUtilisateurs->login($userdata);
			if ($user == FALSE) {
				$viewData = array(
					'loginError' => 'Email ou mot de passe incorrect',
					'registerError' => '',
					'registerSuccess' => ''
				);
				$data['title'] = "Connexion";
				$this->load->view('Base', $data);
				$this->load->view('Login',$viewData);
			} else {
				$sessionData = array(
					'nom'  => $user[0]->nom,
					'prenom' => $user[0]->prenom,
					'login' => $user[0]->login,
					'email'     => $user[0]->email,
					'logged_in' => TRUE
				);
				$this->session->set_userdata($sessionData);
				redirect('Equipes');
			}
		}	
	}

	public function logout() {
		session_destroy();
		redirect('Login');
	}
}

