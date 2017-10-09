<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModifierInfos extends CI_Controller {
	/**
	 * Maps to the following URL
	 * 		http://iut-fbleau.fr/~reszka/sport/ModifierInfos
	 *	- or -
	 * 		http://iut-fbleau.fr/~reszka/sport/ModifierInfos/index
	 */
	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('ModelUtilisateurs');
	}

	public function index() {
		if($this->session->logged_in == FALSE){
			redirect('Login');
		} else {
			$data['title'] = "Mon compte";
			$this->load->view('Base',$data);			
			$this->load->view('Navbar',$this->session->userdata());
			$viewData = array(
				'pwdError' => '',
				'pwdSuccess' => '',
				'emailError' => '',
				'emailSuccess' => ''
			);
			$this->load->view('ModifierInfos',$viewData);
		}
	}

	public function changePassord() {
		$this->form_validation->set_rules('oldpwd', 'Old password', 'trim|required');
		$this->form_validation->set_rules('pwd', 'Password', 'trim|required');
		$this->form_validation->set_rules('confirmpwd', 'Confirm Password', 'trim|required|matches[pwd]');
		
		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$userdata = $this->security->xss_clean(array(
				'login' => $this->session->login,
				'oldpwd' => $this->input->post('oldpwd'),
				'pwd' => $this->input->post('pwd')
			));
			$result = $this->ModelUtilisateurs->changePassord($userdata);
			if ($result == TRUE) {
				$viewData = array(
					'pwdError' => '',
					'pwdSuccess' => 'Mot de passe changé avec succcès',
					'emailError' => '',
					'emailSuccess' => ''
				);
			} else {
				$viewData = array(
					'pwdError' => 'Erreur : mauvais mot de passe',
					'pwdSuccess' => '',
					'emailError' => '',
					'emailSuccess' => ''
				);
			}
			$data['title'] = "Mon compte";
			$this->load->view('Base',$data);			
			$this->load->view('Navbar',$this->session->userdata());
			$this->load->view('ModifierInfos',$viewData);
		}	
	}

	public function changeEmail() {
		$this->form_validation->set_rules('oldemail', 'Old email', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('pwd', 'Password', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$userdata = $this->security->xss_clean(array(
				'login' => $this->session->login,
				'oldemail' => $this->input->post('oldemail'),
				'email' => $this->input->post('email'),
				'pwd' => $this->input->post('pwd')
			));
			$result = $this->ModelUtilisateurs->changeEmail($userdata);
			if ($result == -1) {
				$viewData = array(
					'pwdError' => '',
					'pwdSuccess' => '',
					'emailError' => 'Cet email est déjà attribué',
					'emailSuccess' => ''
				);
			} else if ($result == 1) {
				$viewData = array(
					'pwdError' => '',
					'pwdSuccess' => '',
					'emailError' => '',
					'emailSuccess' => 'Email changé avec succcès'
				);
			} else if ($result == 0) {
				$viewData = array(
					'pwdError' => '',
					'pwdSuccess' => '',
					'emailError' => 'Erreur : mauvais email ou mot de passe',
					'emailSuccess' => ''
				);
			}
			$data['title'] = "Mon compte";
			$this->load->view('Base',$data);			
			$this->load->view('Navbar',$this->session->userdata());
			$this->load->view('ModifierInfos',$viewData);
		}	
	}
}
