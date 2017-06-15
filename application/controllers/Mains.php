<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Mains extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model("User");

		$this->load->library("form_validation");
	}

	public function index(){
		$data['title'] = "Dashboard";
		$data['path'] = "admin/main";
		$data['content'] = "dashboard";
		$this->load->view("admin/index.php",$data);
	}

	public function profile(){
		$data['title'] = 'Profile';
		$data['path'] = 'admin/main';
		$data['action'] = 'change_password';
		$data['content'] = 'edit';
		$this->User->email = $this->session->userdata("logged_in")->email;
		$data['item'] = $this->User->getData('byemail');
		$this->load->view('admin/index', $data);
	}

	public function change_password(){

		$this->form_validation->set_rules('txtcurrent_password','Contrase&ntilde;a Actual','required');
		$this->form_validation->set_rules('txtnew_password','Nueva Contrase&ntilde;a','required');
		$this->form_validation->set_rules('txtrepeat_new_password','Confirmacion de la Nueva Contrase&ntilde;a','required|matches[txtnew_password]');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>', '</div>');

		if($this->form_validation->run() == FALSE){

				$data['title'] = 'Profile';
				$data['path'] = 'admin/main';
				$data['action'] = 'change_password';
				$data['content'] = 'edit';
				$this->User->email = $this->session->userdata("logged_in")->email;
				$data['item'] = $this->User->getData('byemail');
				$this->load->view('admin/index', $data);

		}else{

			$string = 'Perfil Actualizado con Exito!!';
			$this->session->set_flashdata('msj',$string);
			redirect("Mains/profile");
			
		}
	}
}