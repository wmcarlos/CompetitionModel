<?php
class Competency extends CI_Model{
	
	public $competency_id,
		   $company_id,
		   $name,
		   $definition,
		   $charge_level_id,
		   $descriptions,
		   $developmentlevels,
		   $positions,
		   $created,
		   $updated,
		   $isactive;

	public function __construct(){
		parent::__construct();
	}

	public function add(){

		$query = "INSERT INTO cm_competency(company_id,name,definition,charge_level_id) VALUES ($this->company_id,'$this->name','$this->definition',$this->charge_level_id)";

		$this->db->trans_start();

		$this->db->query($query);

		$tdata = $this->getData("byname");

		$this->competency_id = $tdata[0]->competency_id;
		for($i = 1; $i < count($this->descriptions); $i++){
			$this->db->query("INSERT INTO cm_behavioral_indicator(competency_id,description,development_level_id,position) 
				VALUES ($this->competency_id,'".$this->descriptions[$i]."',".$this->developmentlevels[$i].",".$this->positions[$i].")");
		}

		$this->db->trans_complete();

		if($this->db->trans_status() === TRUE){
			return true;
		}else{
			return false;
		}
	}

	public function getData($type = "all"){

		switch ($type) {
			case 'all':
				$query = "SELECT  
						  c.competency_id,
						  c.name,
						  c.isactive,
						  cl.name AS charge_level,
						  co.name AS company
						  FROM cm_competency as c
						  INNER JOIN cm_company AS co ON (co.company_id = c.company_id)
						  INNER JOIN cm_charge_level AS cl ON (cl.charge_level_id = c.charge_level_id)
						  ORDER BY c.name ASC";
			break;
			case 'byname':
				$query = "SELECT * FROM cm_competency WHERE name = '$this->name' ORDER BY name ASC";
			break;
			case 'byid':
				$query = "SELECT * FROM cm_competency WHERE competency_id = $this->competency_id ORDER BY name ASC";
			break;
			case 'get_companies':
				$query = "SELECT company_id AS value, name AS text FROM cm_company ORDER BY name ASC";
			break;
			case 'get_chargelevels':
				$query = "SELECT charge_level_id AS value, name AS text FROM cm_charge_level ORDER BY name ASC";
			break;
			case 'get_developmentlevels':
				$query = "SELECT development_level_id AS value, name AS text FROM cm_development_level ORDER BY name ASC";
			break;
			case 'get_behavioral_indicators':
				$query = "SELECT 
						  bi.description,
						  bi.development_level_id,
						  dl.name AS development_level,
						  bi.position
					      FROM cm_behavioral_indicator AS bi
					      INNER JOIN cm_development_level AS dl ON (dl.development_level_id = bi.development_level_id)
					      WHERE bi.competency_id = $this->competency_id";
			break;
		}

		$query = $this->db->query($query);

		return $query->result();

	}

	public function update(){

		$query = "UPDATE cm_competency SET company_id = $this->company_id, name = '$this->name', definition = '$this->definition', charge_level_id = '$this->charge_level_id' WHERE competency_id = $this->competency_id";

		$this->db->trans_start();

		$this->db->query($query);

		$this->db->query("DELETE FROM cm_behavioral_indicator WHERE competency_id = $this->competency_id");
		
		for($i = 1; $i < count($this->descriptions); $i++){

			$this->db->query("INSERT INTO cm_behavioral_indicator(competency_id,description,development_level_id,position) 
				VALUES ($this->competency_id,'".$this->descriptions[$i]."',".$this->developmentlevels[$i].",".$this->positions[$i].")");
		}

		$this->db->trans_complete();

		if($this->db->trans_status() === TRUE){
			return true;
		}else{
			return false;
		}
	}

	public function isactive($val){

		$query = "UPDATE cm_competency SET isactive='$val' WHERE competency_id = $this->competency_id";

		$this->db->trans_start();

		$this->db->query($query);

		$this->db->trans_complete();

		if($this->db->trans_status() === TRUE){
			return true;
		}else{
			return false;
		}		

	}
}