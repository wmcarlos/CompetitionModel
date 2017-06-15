<?php
class User extends CI_Model{
	
	public $user_id,
		   $company_id,
		   $role_id,
		   $value,
		   $name,
		   $email,
		   $phone,
		   $password,
		   $avatar,
		   $created,
		   $updated,
		   $isactive;

	public function __construct(){
		parent::__construct();
	}

	public function add(){

		$query = "INSERT INTO cm_user(company_id,role_id,value,name,email,phone,password) VALUES ($this->company_id,$this->role_id,'$this->value','$this->name','$this->email','$this->phone','$this->password')";

		$this->db->trans_start();

		$this->db->query($query);

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
						  u.user_id,
						  u.value,
						  u.name,
						  u.email,
						  c.name AS company,
						  r.name AS role,
						  u.isactive
						  FROM cm_user AS u 
						  INNER JOIN cm_company AS c ON (c.company_id = u.company_id)
						  INNER JOIN cm_role AS r ON (r.role_id = u.role_id)
						  ORDER BY u.name ASC";
			break;
			case 'byemail':
				$query = "SELECT * FROM cm_user WHERE email = '$this->email' ORDER BY name ASC";
			break;
			case 'byid':
				$query = "SELECT * FROM cm_user WHERE user_id = $this->user_id ORDER BY name ASC";
			break;
			case 'get_companies':
				$query = "SELECT company_id AS value, name AS text FROM cm_company ORDER BY name ASC";
			break;
			case 'get_roles':
				$query = "SELECT role_id AS value, name AS text FROM cm_role ORDER BY name ASC";
			break;
			case 'bypassword':
				$query = "SELECT password FROM cm_user WHERE user_id = $this->user_id";
			break;
		}

		$query = $this->db->query($query);

		return $query->result();

	}

	public function update(){

		$query = "UPDATE cm_user SET company_id = $this->company_id, role_id = $this->role_id, value = '$this->value', name = '$this->name', email = '$this->email', phone = '$this->phone', password = '$this->password' WHERE user_id = $this->user_id";

		$this->db->trans_start();

		$this->db->query($query);

		$this->db->trans_complete();

		if($this->db->trans_status() === TRUE){
			return true;
		}else{
			return false;
		}
	}

	public function isactive($val){

		$query = "UPDATE cm_user SET isactive = '$val' WHERE user_id = $this->user_id";

		$this->db->trans_start();

		$this->db->query($query);

		$this->db->trans_complete();

		if($this->db->trans_status() === TRUE){
			return true;
		}else{
			return false;
		}		

	}

	public function verify_user(){

		$query = $this->db->query("SELECT
								   u.user_id,
								   u.company_id,
								   c.name AS company,
								   c.short_name,
								   u.role_id, 
								   r.name as role,
								   u.name, 
								   u.email 
								   FROM cm_user AS u
								   INNER JOIN cm_company AS c ON (c.company_id = u.company_id)
								   INNER JOIN cm_role AS r ON (r.role_id = u.role_id)
								   WHERE u.email = '$this->email' 
								   AND u.password = MD5('$this->password')");

		return $query->row();
	}

	public function change_password(){

		$query = "UPDATE cm_user SET password = '$this->password' WHERE user_id = $this->user_id";

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