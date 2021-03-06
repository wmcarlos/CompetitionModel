<?php 
defined('BASEPATH') OR exit ('No direct script access allowed');

class Competencies extends CI_Controller{

	public function __construct(){

		parent::__construct();

		$this->load->model('Competency');
		$this->load->helper('dfcontrol');

	}

	public function index(){
		$data['title'] = 'Competencias';
		$data['path'] = 'admin/competency';
		$data['content'] = 'get';
		$data['items'] = $this->Competency->getData();
		$this->load->view('admin/index', $data);
	}

	public function create(){

		$data['title'] = "Nueva Competencia";
		$data['path'] = 'admin/competency';
		$data['content'] = 'create';
		$data['action'] = 'store';
		$citem = $this->Competency->getData('get_companies');
		$data['companies'] = load_select($citem);
		$clitem = $this->Competency->getData('get_chargelevels');
		$data['chargelevels'] = load_select($clitem);
		$dlitem = $this->Competency->getData('get_developmentlevels');
		$data["developmentlevels"] = load_select($dlitem);
		$this->load->view('admin/index', $data);

	}

	public function store(){

		$this->Competency->company_id = $this->input->post("txtcompany_id");
		$this->Competency->name = strtoupper($this->input->post("txtname"));
		$this->Competency->definition = $this->input->post("txtdefinition");
		$this->Competency->charge_level_id = $this->input->post("txtcharge_level_id");

		$this->Competency->descriptions = $this->input->post("txtdescriptions");
		$this->Competency->developmentlevels = $this->input->post("txtdevelopment_level");
		$this->Competency->positions = $this->input->post("txtpositions");

		if( count($this->Competency->getData("byname")) > 0){
			$string = 'Este Competencia ya se encuentra Registrado!!';
		}else{
			if($this->Competency->add()){
				$string = 'Competencia registrada con Exito!!';
			}else{
				$string = 'Ocurrio un error al intentar registrar la Competencia!!';
			}
		}

		$this->session->set_flashdata('msj',$string);

		redirect('Competencies','refresh');

	}

	public function edit($competency_id){

		$this->Competency->competency_id = $competency_id;

		$data['title'] = "Editar Competencia";
		$data['path'] = 'admin/competency';
		$data['content'] = 'edit';
		$data['action'] = 'update';
		$citem = $this->Competency->getData('get_companies');
		$data['companies'] = load_select($citem, $this->Competency->getData('byid')[0]->company_id);
		$clitem = $this->Competency->getData('get_chargelevels');
		$data['chargelevels'] = load_select($clitem, $this->Competency->getData('byid')[0]->charge_level_id);
		$dlitem = $this->Competency->getData('get_developmentlevels');
		$data["developmentlevels"] = load_select($dlitem);
		$data['dtlitems'] = $this->Competency->getData("get_behavioral_indicators");
		$data['item'] = $this->Competency->getData('byid');
		$this->load->view('admin/index', $data);
	}

	public function update(){

		$this->Competency->competency_id = $this->input->post("txtcompetency_id");
		$this->Competency->company_id = $this->input->post("txtcompany_id");
		$this->Competency->name = strtoupper($this->input->post("txtname"));
		$this->Competency->definition = $this->input->post("txtdefinition");
		$this->Competency->charge_level_id = $this->input->post("txtcharge_level_id");

		$this->Competency->descriptions = $this->input->post("txtdescriptions");
		$this->Competency->developmentlevels = $this->input->post("txtdevelopment_level");
		$this->Competency->positions = $this->input->post("txtpositions");

		if($this->Competency->update()){
			$string = 'Competencia modificada con Exito!!';
		}else{
			$string = 'Ocurrio un error al intentar modificar la Competencia!!';
		}

		$this->session->set_flashdata('msj',$string);

		redirect('Competencies','refresh');	

	}

	public function active($competency_id){
		$this->Competency->competency_id = $competency_id;

		if($this->Competency->isactive('Y')){
			$string = 'Competencia activada con Exito!!';
		}else{
			$string = 'Error al intentar activar la Competencia!!';
		}

		$this->session->set_flashdata('msj',$string);

		redirect('Competencies','refresh');
	}

	public function inactive($competency_id){

		$this->Competency->competency_id = $competency_id;

		if($this->Competency->isactive('N')){
			$string = 'Competencia Desactivada con Exito!!';
		}else{
			$string = 'Error al intentar Desactivar la Competencia!!';
		}

		$this->session->set_flashdata('msj',$string);

		redirect('Competencies','refresh');
	}
}
