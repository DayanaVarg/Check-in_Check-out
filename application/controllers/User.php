<?php
defined ('BASEPATH') OR exit ('No direct script acces allowed');
require 'vendor/autoload.php';
class User extends CI_Controller{

	public function __construct(){
        parent::__construct();
        $this->load->database();
		$this->load->model('Users');
        $this->load->library(array('session'));
		$this->load->helper('date');
        $this->load->helper('file');
		date_default_timezone_set('America/Bogota');
		
    }
	
	
	//functions
	//Crear usuario / registro entrada
	public function create(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role') == 1){
			if($this->input->server('REQUEST_METHOD')==='POST') {
				$iden = $this->input->post('iden');
				$name = $this->input->post('name');
				$lastname = $this->input->post('lastname');
				$gender = $this->input->post('gender');
				$phone = $this->input->post('phone');
				$rh = $this->input->post('rh');
				$id_Role = $this->input->post('id_Role');
				$reason = $this->input->post('reason');
				$password = password_hash($this->input->post('iden'), PASSWORD_DEFAULT);

				$date_checkin = $this->input->post('date_E');
				$time_checkin = $this->input->post('time_E');

				if (!$res = $this->Users->searchUser($iden)) {
					if ($id_Role == 2) {
						$datosE = array(
							'identification' => $iden,
							'name' => $name,
							'lastname' => $lastname,
							'gender' => $gender,
							'phone' => $phone,
							'RH' => $rh,
							'id_role' => $id_Role,
						);

						$datosF = array(
							'date_checkin' => $date_checkin,
							'time_checkin' => $time_checkin,
							'reason' => $reason,
							'id_user' => $iden,
						);

						if (!$this->Users->create($datosE, $datosF)) {
							$this->session->set_flashdata('error', 'Ha ocurrido un error al registrarlo, intenta de nuevo');
							redirect('user/registerUser');
						}
						$this->session->set_flashdata('msg', 'Se ha registrado con éxito');
						redirect('user/dashboardAdmin');

					}
					if ($id_Role == 3) {
						$datosE = array(
							'identification' => $iden,
							'name' => $name,
							'lastname' => $lastname,
							'gender' => $gender,
							'phone' => $phone,
							'RH' => $rh,
							'id_role' => $id_Role,
							'password' => $password,
						);

						$datosF = array(
							'date_checkin' => $date_checkin,
							'time_checkin' => $time_checkin,
							'id_user' => $iden,
						);
						if (!$this->Users->create($datosE, $datosF)) {
							$this->session->set_flashdata('error', 'Ha ocurrido un error al registrarlo, intenta de nuevo');
							redirect('user/registerUser');
						}
						$this->session->set_flashdata('msg', 'Se ha registrado con éxito');
						redirect('user/dashboardAdmin');
					}
				}else {
						$datosF = array(
							'date_checkin' => $date_checkin,
							'time_checkin' => $time_checkin,
							'reason' => $reason,
							'id_user' => $iden,
						);

						if (!$this->Users->createF($datosF)) {
							$this->session->set_flashdata('error', 'Ha ocurrido un error al registrarlo, intenta de nuevo');
							redirect('user/registerUser');
						}
						$this->session->set_flashdata('msg', 'Entrada registrada exitósamente');
						redirect('user/dashboardAdmin');

				}
			}else{
					show_404();
			}
		}else{
			redirect('login');
		}
	}

	//Consultar usuario
	public function searchU(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role') == 1){
			$iden = $this->input->post('iden');
			if($this->Users->searchUser($iden)){
				$data = array(
					'navbar' => $this->load->view('layout/navbar', '', TRUE),
					'footer'=>$this->load->view('layout/footer', '', TRUE),
					'user'=> $this->Users->searchUser($iden),
					'fecha_actual'=>date('Y-m-d'),
					'hora_actual'=>date('H:i:s'),
				);
				$this->load->view('user/registerEn',$data);
			}else{
				$this->session->set_flashdata('msg', 'Usuario no encontrado o se encuentra inactivo, verifique');
				redirect('user/registerUser');
			}

		}else{
			redirect('login');
		}
	}

	public function modal(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role') == 1){
			$data = array(
				'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
			);
			$this->load->view('layout/modal.php',$data);
		}else{
			redirect('login');
		}
	}

	//Registro Salida
	public function registerExit(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role')== 1) {
			$id_his = $this->input->post('id_his');
			$date_checkout = $this->input->post('date_Ex');
			$time_checkout = $this->input->post('time_Ex');

			if (!$this->Users->registerExi($id_his, $date_checkout, $time_checkout)) {
				$this->session->set_flashdata('error', 'Ha ocurrido un error, intente de nuevo');
				redirect('user/dashboardAdmin');
			}
			$this->session->set_flashdata('msg', 'Salida registrada con éxito');
			redirect('user/dashboardAdmin');
		}else{
		 redirect('login');
		}
	}

//empleados
	//Consultar historial empleado
	public function searchEmpl(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role') == 1){
			$iden = $this->input->post('iden');
			$data = array(
				'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
				'data'=> $this->Users->searchEm($iden),
			);
			$this->load->view('user/historyEmpl',$data);
		}else{
			redirect('login');
		}
	}

	//Eliminar historial empleado
	public function dropHisE(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role')== 1) {
			$id_his = $this->input->post('id_his');
			if (!$this->Users->dropHist($id_his)) {
				$this->session->set_flashdata('msg', 'Registro eliminado con éxito');
				redirect('user/historyEmpl');
			}
			$this->session->set_flashdata('error', 'Ha ocurrido un error, intente de nuevo');
			redirect('user/historyEmpl');

		}else{
			redirect('login');
		}
	}
	
	//Consultar empleado 
	public function searchEmple(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role') == 1){
			$iden = $this->input->post('iden');
			$data = array(
				'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
				'data'=> $this->Users->searchEmId($iden),
			);
			$this->load->view('user/listEmpl',$data);
		}else{
			redirect('login');
		}
	}

	//inactivar Empleado
	public function inacEm(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role')== 1) {
			$iden = $this->input->post('iden');
			$state = $this->input->post('state');
			if(!$this->Users->inacEm($iden,$state)){
				$this->session->set_flashdata('error', 'Ha ocurrido un error, intente de nuevo');
				redirect('user/listEmp');
			}
			$this->session->set_flashdata('msg', 'Empleado inactivado con éxito');
				redirect('user/listEmp');
		
		}
	}

	//activar empleado
	public function actEm(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role')== 1) {
			$iden = $this->input->post('iden');
			$state = $this->input->post('state');
			if(!$this->Users->actEm($iden,$state)){
				$this->session->set_flashdata('error', 'Ha ocurrido un error, intente de nuevo');
				redirect('user/empInac');
			}
			$this->session->set_flashdata('msg', 'Empleado activado con éxito');
				redirect('user/listEmp');
		
		}
	}

	//Consultar empleado inactivo
	public function searchEmpleI(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role') == 1){
			$iden = $this->input->post('iden');
			$data = array(
				'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
				'data'=> $this->Users->searchEmIdI($iden),
			);
			$this->load->view('user/listEmplInac',$data);
		}else{
			redirect('login');
		}
	}
 	//Funcion actualizar empleado
	public function updateUs(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role') == 1){
			$config['upload_path'] = './assets/upload/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';

			$this->load->library('upload', $config);

			$iden = $this->input->post('iden');
			$name = $this->input->post('name');
			$lastname = $this->input->post('lastname');
			$gender = $this->input->post('gender');
			$phone = $this->input->post('phone');
			$rh = $this->input->post('rh');

			
			$nameP = $this->input->post('photo'); // Por defecto, usa el nombre anterior de la foto

			if($_FILES['loadP']['name'] != ""){ // Verifica si se ha subido un archivo
				if ($this->upload->do_upload('loadP')) {
					$data = $this->upload->data();
					$nameP = $data['file_name'];
				} else {
					$error = array('error' => $this->upload->display_errors());
					// Maneja el error de carga de archivos aquí
				}
			}

			if (!$this->Users->updateUs($iden,$name,$lastname,$gender,$phone,$rh,$nameP)) {
				$this->session->set_flashdata('error', 'Ha ocurrido un error, intente de nuevo');
				redirect('user/listEmp');
			}
			$this->session->set_flashdata('msg', 'Se ha actualizado con éxito');
			redirect('user/listEmp');
			
		}else{
			redirect('login');
		}
	}

	//Impotar lista de empleados

	public function import(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role') == 1){
			if($_SERVER['REQUEST_METHOD']=='POST'){
				$upload_status =  $this->uploadDoc();
			if($upload_status!=false)
			{
				$inputFileName = 'uploads/'.$upload_status;
				$inputTileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
				$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputTileType);
				$spreadsheet = $reader->load($inputFileName);
				$sheet = $spreadsheet->getSheet(0);
				$count_Rows = 0;
				$firstRow = true;
				foreach($sheet->getRowIterator() as $row)
				{
					if ($firstRow) {
						$firstRow = false;
						continue; 
					}
					$identification = $spreadsheet->getActiveSheet()->getCell('A'.$row->getRowIndex());
					$name = $spreadsheet->getActiveSheet()->getCell('B'.$row->getRowIndex());
					$lastname = $spreadsheet->getActiveSheet()->getCell('C'.$row->getRowIndex());
					$rh = $spreadsheet->getActiveSheet()->getCell('D'.$row->getRowIndex());
					$phone = $spreadsheet->getActiveSheet()->getCell('E'.$row->getRowIndex());
					$gender = $spreadsheet->getActiveSheet()->getCell('F'.$row->getRowIndex());
					$state = $spreadsheet->getActiveSheet()->getCell('H'.$row->getRowIndex());
					if($state=="Activo"){
						$state = 1;
					}else{
						$state = 0;
					}
					$data = array(
						'identification'=> $identification,
						'name'=> $name,
						'lastname'=> $lastname,
						'rh'=> $rh,
						'phone'=> $phone,
						'gender'=> $gender,
						'id_Role'=> 3,
						'state'=> $state,
					);

					$this->db->insert('user',$data);
					$count_Rows++;
				}
				$this->session->set_flashdata('msg','Importado con éxito');
				redirect(base_url('user/listEmp'));
			}
			else
			{
				$this->session->set_flashdata('error','Ha ocurrido un error');
				redirect(base_url('user/listEmp'));
			}
			}
		}else{
			redirect('login');
		}
	}

	function uploadDoc()
	{
		$uploadPath = 'uploads/';
		if(!is_dir($uploadPath))
		{
			mkdir($uploadPath,0777,TRUE); // FOR CREATING DIRECTORY IF ITS NOT EXIST
		}

		$config['upload_path']=$uploadPath;
		$config['allowed_types'] = 'csv|xlsx|xls';
		$config['max_size'] = 1000000000;
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		if($this->upload->do_upload('file'))
		{
			$fileData = $this->upload->data();
			return $fileData['file_name'];
		}
		else
		{
			return false;
		}
	}

	
	//Impotar historial de visitantes

	public function importHE(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role') == 1){
			if($_SERVER['REQUEST_METHOD']=='POST'){
				$upload_status =  $this->uploadDoc();
			if($upload_status!=false)
			{
				$inputFileName = 'uploads/'.$upload_status;
				$inputTileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
				$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputTileType);
				$spreadsheet = $reader->load($inputFileName);
				$sheet = $spreadsheet->getSheet(0);
				$count_Rows = 0;
				$firstRow = true;
				foreach($sheet->getRowIterator() as $row)
				{
					if ($firstRow) {
						$firstRow = false;
						continue; 
					}
					$identification = $spreadsheet->getActiveSheet()->getCell('A'.$row->getRowIndex());
					$DaCheckin =$spreadsheet->getActiveSheet()->getCell('B'.$row->getRowIndex());
					$TiCheckin =$spreadsheet->getActiveSheet()->getCell('C'.$row->getRowIndex());
					$DaCheckout =$spreadsheet->getActiveSheet()->getCell('D'.$row->getRowIndex());
					$TiCheckout =$spreadsheet->getActiveSheet()->getCell('E'.$row->getRowIndex());
				
					$data = array(
						'id_user'=> $identification,
						'date_checkin'=> $DaCheckin,
						'time_checkin'=> $TiCheckin,
						'date_checkout'=> $DaCheckout,
						'time_checkout'=> $TiCheckout,
						
					);

					$this->db->insert('history',$data);
					$count_Rows++;
				}
				$this->session->set_flashdata('msg','Importado con éxito');
				redirect(base_url('user/historyEmpl'));
			}
			else
			{
				$this->session->set_flashdata('error','Ha ocurrido un error');
				redirect(base_url('user/historyEmpl'));
			}
			}
		}else{
			redirect('login');
		}
	}

	
	//views
	
	//Historial empleados
	public function historyEmpl(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role')== 1){
			$data = array(
				'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
				'data'=> $this->Users->searchEmp(),
			);
			$this->load->view('user/historyEmpl',$data);
		}else{
			redirect('login');
		}
	}

	//Historial empleados tabla
	public function historyEmplT(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role')== 1){
			$data = array(
				'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
				'data'=> $this->Users->searchEmp(),
				'script_url' => base_url('assets/js/exportHisEm.js') 
			);
			$this->load->view('user/historyEmplTable',$data);
		}else{
			redirect('login');
		}
	}

	
	//Listado de empleados
	public function listEmp(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role')== 1){
			$data = array(
				'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
				'data'=> $this->Users->searchEmpl(),
			);
			$this->load->view('user/listEmpl',$data);
		}else{
			redirect('login');
		}
	}

	//Listado empleados tabla
	public function listEmplT(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role')== 1){
			$data = array(
				'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
				'data'=> $this->Users->searchEmpl(),
				'script_url' => base_url('assets/js/exportEmp.js') 
			);
			$this->load->view('user/listEmplTable',$data);
		}else{
			redirect('login');
		}
	}

	
	//Listado de empleados inactivos
	public function empInac(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role')== 1){
			$data = array(
				'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
				'data'=> $this->Users->empInac(),
			);
			$this->load->view('user/listEmplInac',$data);
		}else{
			redirect('login');
		}
	}

	//Listado empleados tabla inactivos
	public function listEmplIT(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role')== 1){
			$data = array(
				'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
				'data'=> $this->Users->empInac(),
				'script_url' => base_url('assets/js/exportEmpI.js') 
			);
			$this->load->view('user/listEmpliTable',$data);
		}else{
			redirect('login');
		}
	}

	//Formulario actualizar
	public function actEmpV(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role')== 1){
			$ide = $this->input->post('iden');
			$data = array(
				'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
				'data'=> $this->Users->searchEmId($ide),
			);
			$this->load->view('user/updateEmp',$data);
		}else{
			redirect('login');
		}
	}
//visitantes

	//Consultar visitante
	public function searchVis(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role')== 1){
			$iden = $this->input->post('iden');
			$data = array(
				'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
				'data'=> $this->Users->searchVist($iden),
			);
			$this->load->view('user/historyVis',$data);
		}else{
			redirect('login');
		}
	}

	//Eliminar historial visitante
	public function dropHisV(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role')== 1) {
			$id_his = $this->input->post('id_his');
			if (!$this->Users->dropHist($id_his)) {
				$this->session->set_flashdata('msg', 'Registro eliminado con éxito');
				redirect('user/historyVist');
			}
			$this->session->set_flashdata('error', 'Ha ocurrido un error, intente de nuevo');
			redirect('user/historyVist');

		}else{
			redirect('login');
		}
	}

	
	//inactivar Visitante
	public function inacVis(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role')== 1) {
			$iden = $this->input->post('iden');
			$state = $this->input->post('state');
			if(!$this->Users->inacVis($iden,$state)){
				$this->session->set_flashdata('error', 'Ha ocurrido un error, intente de nuevo');
				redirect('user/listVist');
			}
			$this->session->set_flashdata('msg', 'Visitante inactivado con éxito');
				redirect('user/listVist');
		
		}
	}

		
	//activar Visitante
	public function actVis(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role')== 1) {
			$iden = $this->input->post('iden');
			$state = $this->input->post('state');
			if(!$this->Users->actVis($iden,$state)){
				$this->session->set_flashdata('error', 'Ha ocurrido un error, intente de nuevo');
				redirect('user/listVist');
			}
			$this->session->set_flashdata('msg', 'Visitante activado con éxito');
				redirect('user/listVist');
		
		}
	}

	//Función actualizar visitante
	
	public function updateUsV(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role') == 1){
			$config['upload_path'] = './assets/upload/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';

			$this->load->library('upload', $config);

			$iden = $this->input->post('iden');
			$name = $this->input->post('name');
			$lastname = $this->input->post('lastname');
			$gender = $this->input->post('gender');
			$phone = $this->input->post('phone');
			$rh = $this->input->post('rh');

			
			$nameP = $this->input->post('photo'); // Por defecto, usa el nombre anterior de la foto

			if($_FILES['loadP']['name'] != ""){ // Verifica si se ha subido un archivo
				if ($this->upload->do_upload('loadP')) {
					$data = $this->upload->data();
					$nameP = $data['file_name'];
				} else {
					$error = array('error' => $this->upload->display_errors());
					// Maneja el error de carga de archivos aquí
				}
			}

			if (!$this->Users->updateUs($iden,$name,$lastname,$gender,$phone,$rh,$nameP)) {
				$this->session->set_flashdata('error', 'Ha ocurrido un error, intente de nuevo');
				redirect('user/listVist');
			}
			$this->session->set_flashdata('msg', 'Se ha actualizado con éxito');
			redirect('user/listVist');
			
		}else{
			redirect('login');
		}
	}

	//Impotar lista de visitantes

	public function importV(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role') == 1){
			if($_SERVER['REQUEST_METHOD']=='POST'){
				$upload_status =  $this->uploadDoc();
			if($upload_status!=false)
			{
				$inputFileName = 'uploads/'.$upload_status;
				$inputTileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
				$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputTileType);
				$spreadsheet = $reader->load($inputFileName);
				$sheet = $spreadsheet->getSheet(0);
				$count_Rows = 0;
				$firstRow = true;
				foreach($sheet->getRowIterator() as $row)
				{
					if ($firstRow) {
						$firstRow = false;
						continue; 
					}
					$identification = $spreadsheet->getActiveSheet()->getCell('A'.$row->getRowIndex());
					$name = $spreadsheet->getActiveSheet()->getCell('B'.$row->getRowIndex());
					$lastname = $spreadsheet->getActiveSheet()->getCell('C'.$row->getRowIndex());
					$rh = $spreadsheet->getActiveSheet()->getCell('D'.$row->getRowIndex());
					$phone = $spreadsheet->getActiveSheet()->getCell('E'.$row->getRowIndex());
					$gender = $spreadsheet->getActiveSheet()->getCell('F'.$row->getRowIndex());
					$state = $spreadsheet->getActiveSheet()->getCell('H'.$row->getRowIndex());
					if($state=="Activo"){
						$state = 1;
					}else{
						$state = 0;
					}
					$data = array(
						'identification'=> $identification,
						'name'=> $name,
						'lastname'=> $lastname,
						'rh'=> $rh,
						'phone'=> $phone,
						'gender'=> $gender,
						'id_Role'=> 2,
						'state'=> $state,
					);

					$this->db->insert('user',$data);
					$count_Rows++;
				}
				$this->session->set_flashdata('msg','Importado con éxito');
				redirect(base_url('user/listVist'));
			}
			else
			{
				$this->session->set_flashdata('error','Ha ocurrido un error');
				redirect(base_url('user/listVist'));
			}
			}
		}else{
			redirect('login');
		}
	}

	//Impotar historial de visitantes

	public function importHV(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role') == 1){
			if($_SERVER['REQUEST_METHOD']=='POST'){
				$upload_status =  $this->uploadDoc();
			if($upload_status!=false)
			{
				$inputFileName = 'uploads/'.$upload_status;
				$inputTileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
				$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputTileType);
				$spreadsheet = $reader->load($inputFileName);
				$sheet = $spreadsheet->getSheet(0);
				$count_Rows = 0;
				$firstRow = true;
				foreach($sheet->getRowIterator() as $row)
				{
					if ($firstRow) {
						$firstRow = false;
						continue; 
					}
					$identification = $spreadsheet->getActiveSheet()->getCell('A'.$row->getRowIndex());
					$reason = $spreadsheet->getActiveSheet()->getCell('B'.$row->getRowIndex());
					$DaCheckin =$spreadsheet->getActiveSheet()->getCell('C'.$row->getRowIndex());
					$TiCheckin =$spreadsheet->getActiveSheet()->getCell('D'.$row->getRowIndex());
					$DaCheckout =$spreadsheet->getActiveSheet()->getCell('E'.$row->getRowIndex());
					$TiCheckout =$spreadsheet->getActiveSheet()->getCell('F'.$row->getRowIndex());
				
					$data = array(
						'id_user'=> $identification,
						'reason'=> $reason,
						'date_checkin'=> $DaCheckin,
						'time_checkin'=> $TiCheckin,
						'date_checkout'=> $DaCheckout,
						'time_checkout'=> $TiCheckout,
						
					);

					$this->db->insert('history',$data);
					$count_Rows++;
				}
				$this->session->set_flashdata('msg','Importado con éxito');
				redirect(base_url('user/historyVist'));
			}
			else
			{
				$this->session->set_flashdata('error','Ha ocurrido un error');
				redirect(base_url('user/historyVist'));
			}
			}
		}else{
			redirect('login');
		}
	}





	//views

	//Historial visitantes
	public function historyVist(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role')== 1){
			$data = array(
				'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
				'data'=> $this->Users->searchVis(),
			);
			$this->load->view('user/historyVis',$data);
		}else{
			redirect('login');
		}
	}

	//Historial visitantes tabla
	public function historyVistT(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role')== 1){
			$data = array(
				'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
				'data'=> $this->Users->searchVis(),
				'script_url' => base_url('assets/js/exportHisVis.js') 
			);
			$this->load->view('user/historyVisTable',$data);
		}else{
			redirect('login');
		}
	}

	//Listado de visitantes
	public function listVist(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role')== 1){
			$data = array(
				'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
				'data'=> $this->Users->listVist(),
			);
			$this->load->view('user/listVist',$data);
		}else{
			redirect('login');
		}
	}

	//Listado de visitantes tabla
	public function listVistT(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role')== 1){
			$data = array(
				'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
				'data'=> $this->Users->listVist(),
				'script_url' => base_url('assets/js/exportVis.js') 
			);
			$this->load->view('user/listVistTable',$data);
		}else{
			redirect('login');
		}
	}

	//consultar visitante
	public function searchVistId(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role')== 1){
			$iden = $this->input->post('iden');
			$data = array(
				'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
				'data'=> $this->Users->searchVistId($iden),
			);
			$this->load->view('user/listVist',$data);
		}else{
			redirect('login');
		}
	}

	//consultar visitante inactivo
	public function searchVistIdI(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role')== 1){
			$iden = $this->input->post('iden');
			$data = array(
				'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
				'data'=> $this->Users->searchVistId($iden),
			);
			$this->load->view('user/listVistInac',$data);
		}else{
			redirect('login');
		}
	}

	//listado de visitantes inactivos
	public function visInac(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role')== 1){
			$data = array(
				'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
				'data'=> $this->Users->listVistI(),
			);
			$this->load->view('user/listVistInac',$data);
		}else{
			redirect('login');
		}
	}

	//Listado de visitantes inactivos tabla
	public function listVistIT(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role')== 1){
			$data = array(
				'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
				'data'=> $this->Users->listVistI(),
				'script_url' => base_url('assets/js/exportVisI.js') 
			);
			$this->load->view('user/listVistITable',$data);
		}else{
			redirect('login');
		}
	}

	//Formulario actalizar
	public function actvisV(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role')== 1){
			$ide = $this->input->post('iden');
			$data = array(
				'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
				'data'=> $this->Users->searchVistId($ide),
			);
			$this->load->view('user/updateVis',$data);
		}else{
			redirect('login');
		}
	}


//views admin
	//Dashboard Admin
	public function dashboardAdmin(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role') == 1){
			$data = array(
				'fecha_actual'=>date('Y-m-d'),
				'hora_actual'=>date('H:i:s'),
				'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
				'data'=> $this->Users->searchUsers(),
			);
			$this->load->view('user/dashboardAdmin',$data);
		}else{
			redirect('login');
		}
	}

	//Vista RegisterUser -  Entrada
	public function registerUser(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role')== 1){
			$data = array(
				'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
				'fecha_actual'=>date('Y-m-d'),
				'hora_actual'=>date('H:i:s'),
			);
			$this->load->view('user/registerUser',$data);
		}else{
			redirect('login');
		}
	}	
}

?>
