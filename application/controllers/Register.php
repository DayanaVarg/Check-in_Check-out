<?php

class Register extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('Users');
		$this->load->library(array('session'));
	}
	public function index(){
		$this->load->view('user/registerAdmin');
	}

	public function create(){
		$iden = $this->input->post('iden');
		$name = $this->input->post('name');
		$lastname = $this->input->post('lastname');
		$gender = $this->input->post('gender');
		$phone= $this->input->post('phone');
		$RH = $this->input->post('RH');
		$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);;
		$role = $this->input->post('id_role');

		if(!$this->Users->searchAdmin($iden)){
			$datos=array(
				'identification' => $iden,
				'name' => $name,
				'lastname' => $lastname,
				'gender' => $gender,
				'phone' => $phone,
				'RH' => $RH,
				'password' => $password,
				'id_role' => $role,
			);
			if(!$this->Users->createAdmin($datos)){
				$data['msg'] = 'Ocurrió un error al insertar los datos, vuelve a intentarlo';
				$this->load->view('user/registerAdmin', $data);
			}
			$this->session->set_flashdata('mnsg', 'Registrado con éxito');
			redirect('login');
		}
		$data['msg'] = 'El usuario ya se encuentra registrado';
		$this->load->view('user/registerAdmin', $data);

	}

}
