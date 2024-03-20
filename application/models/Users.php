<?php

class Users extends CI_Model
{
	function __construct(){
		$this->load->database();
	}

//admin
	//Consultar admin
	public function searchAdmin($iden){
		$admin = $this->db->get_where('user', array('user.identification' => $iden), 1);
		return $admin->row_array();
	}

	//Registrar Admin
	public function createAdmin($datos){
		if($this->input->server('REQUEST_METHOD')==='POST'){
			if (!$this->db->insert('user', $datos)){
				return false;
			}
			return true;
		}else{
			show_404();
		}
	}

//user

	//listar usuario específico
	public function searchUser($iden){
		$this->db->join('role','role.id_Role = user.id_Role');
		$user = $this->db->get_where('user', array('user.identification' => $iden, 'user.state'=>1), 1);
		if(!$user->result()){
			return false;
		}
		return $user->row_array();
	}

	//Listar usuarios sin salida
	public function searchUsers(){
		$this->db->join('user','user.identification = history.id_user');
		$this->db->join('role','role.id_Role = user.id_Role');
		$user = $this->db->get_where('history', array('history.date_checkout' => null));
		if(!$user->result()){
			return false;
		}return $user->result();
	}

	//Registrar usuario / registro entrada
	public function create($datosE, $datosF){
		if($this->db->insert('user', $datosE)){
			if($this->db->insert('history', $datosF)){
				return true;
			};
		}return false;
	}

	//registrar entrada
	public function createF($datosF){
		if($this->db->insert('history', $datosF)){
				return true;
		}return false;
	}

	//registrar salida
	public function registerExi($id_his,$date_checkout,$time_checkout){
		$this->db->set('date_checkout', $date_checkout);
		$this->db->set('time_checkout', $time_checkout);
		$this->db->where('id_his', $id_his);

		if($this->db->update('history')){
			return true;
		} return false;
	}

	
	//Eliminar registro
	public function dropHist($id_his){
		$this->db->delete('history', array('id_his' => $id_his));
	}


//empleados

	//listar historial empleados
	public function searchEmp(){
		$this->db->join('user','user.identification = history.id_user');
		$this->db->join('role','role.id_Role = user.id_Role');
		$user = $this->db->get_where('history', array('history.date_checkout  IS NOT NULL', 'role.id_Role' => 3));
		if(!$user->result()){
			return false;
		}return $user->result();
	}

	//listar empleados
	public function searchEmpl(){
		$this->db->join('role','role.id_Role = user.id_Role');
		$user = $this->db->get_where('user', array('role.id_Role' => 3, 'user.state'=>1));
		if(!$user->result()){
			return false;
		}return $user->result();
	}

	//consultar empleado
	public function searchEm($iden){
		$this->db->join('user','user.identification = history.id_user');
		$this->db->join('role','role.id_Role = user.id_Role');
		$user = $this->db->get_where('history', array('history.date_checkout  IS NOT NULL', 'role.id_Role' => 3, 'user.identification' =>$iden));
		if(!$user->result()){
			return false;
		}return $user->result();
	}

	
	//Contar empleados
	public function getEmp(){
		$this->db->from('user');
		$this->db->where('id_Role', 3);
		$this->db->where('state',1);
		$count = $this->db->count_all_results();
		return $count;
	}

	//Contar visitas por mes
	public function getfecE($mes){
		$this->db->from('history');
		$this->db->join('user','user.identification = history.id_user');
		$this->db->join('role','role.id_Role = user.id_Role');
		$this->db->where('date_checkout IS NOT NULL' );
		$this->db->where('role.id_Role',3 );
		$this->db->like('date_checkin','-' . $mes . '-');
		$this->db->like('date_checkout','-' . $mes . '-');
		$count = $this->db->count_all_results();
		return $count;
	}

	//empleados lista
	//consultar empleado
	public function searchEmId($iden){
		$this->db->join('role','role.id_Role = user.id_Role');
		$user = $this->db->get_where('user', array('role.id_Role' => 3, 'user.identification' =>$iden, 'user.state'=>1));
		if(!$user->result()){
			return false;
		}return $user->result();
	}
	

	//inactivar empleado
	public function inacEm($iden, $state){
		$this->db->set('state', $state);
		$this->db->where('identification', $iden);

		if($this->db->update('user')){
			return true;
		} return false;
	}

	//listar empleados inactivos
	public function empInac(){
		$this->db->join('role','role.id_Role = user.id_Role');
		$user = $this->db->get_where('user', array('role.id_Role' => 3, 'user.state'=>0));
		if(!$user->result()){
			return false;
		}return $user->result();
	}

	//activar empleado
	public function actEm($iden, $state){
		$this->db->set('state', $state);
		$this->db->where('identification', $iden);

		if($this->db->update('user')){
			return true;
		} return false;
	}

	//consultar empleado inactivo
	public function searchEmIdI($iden){
		$this->db->join('role','role.id_Role = user.id_Role');
		$user = $this->db->get_where('user', array('role.id_Role' => 3, 'user.identification' =>$iden, 'user.state'=>0));
		if(!$user->result()){
			return false;
		}return $user->result();
	}

	//Actualizar empleado
	public function updateUs($iden,$name,$lastname,$gender,$phone,$rh,$photo){
		$this->db->set('name', $name);
		$this->db->set('lastname', $lastname);
		$this->db->set('gender', $gender);
		$this->db->set('phone', $phone);
		$this->db->set('rh', $rh);
		$this->db->set('photo', $photo);
		$this->db->where('identification', $iden);
	
		if($this->db->update('user')){
			return true;
		} return false;
		
	}

	//insertar csv
	
	function insert_user($data) {
        $this->db->insert_batch('user', $data);
    }
	
//visitantes

	//listar historial visitantes
	public function searchVis(){
		$this->db->join('user','user.identification = history.id_user');
		$this->db->join('role','role.id_Role = user.id_Role');
		$user = $this->db->get_where('history', array('history.date_checkout  IS NOT NULL', 'role.id_Role' => 2));
		if(!$user->result()){
			return false;
		}return $user->result();
	}

	//listar visitantes
	public function listVist(){
		$this->db->join('role','role.id_Role = user.id_Role');
		$user = $this->db->get_where('user', array('role.id_Role' => 2 ,'user.state'=>1));
		if(!$user->result()){
			return false;
		}return $user->result();
	}


	//consultar visitante
	public function searchVist($iden){
		$this->db->join('user','user.identification = history.id_user');
		$this->db->join('role','role.id_Role = user.id_Role');
		$user = $this->db->get_where('history', array('history.date_checkout  IS NOT NULL', 'role.id_Role' => 2, 'user.identification' =>$iden));
		if(!$user->result()){
			return false;
		}return $user->result();
	}


	//Contar visitantes
	public function getVis(){
		$this->db->from('user');
		$this->db->where('id_Role', 2);
		$count = $this->db->count_all_results();
		return $count;
	}

	//Contar visitas por mes visitantes
	public function getfecV($mes){
		$this->db->from('history');
		$this->db->join('user','user.identification = history.id_user');
		$this->db->join('role','role.id_Role = user.id_Role');
		$this->db->where('date_checkout IS NOT NULL' );
		$this->db->where('role.id_Role',2);
		$this->db->like('date_checkin','-' . $mes . '-');
		$this->db->like('date_checkout','-' . $mes . '-');
		$count = $this->db->count_all_results();
		return $count;
	}

	//visitantes lista
	//consultar visitante
	public function searchVistId($iden){
		$this->db->join('role','role.id_Role = user.id_Role');
		$user = $this->db->get_where('user', array('role.id_Role' => 2, 'user.identification' =>$iden,'user.state'=>1));
		if(!$user->result()){
			return false;
		}return $user->result();
	}

	
	//inactivar visitante
	public function inacVis($iden, $state){
		$this->db->set('state', $state);
		$this->db->where('identification', $iden);

		if($this->db->update('user')){
			return true;
		} return false;
	}

	//activar visitante
	public function actVis($iden, $state){
		$this->db->set('state', $state);
		$this->db->where('identification', $iden);

		if($this->db->update('user')){
			return true;
		} return false;
	}

	//listar visitantes inactivos
	public function listVistI(){
		$this->db->join('role','role.id_Role = user.id_Role');
		$user = $this->db->get_where('user', array('role.id_Role' => 2 ,'user.state'=>0));
		if(!$user->result()){
			return false;
		}return $user->result();
	}

	


}
?>
