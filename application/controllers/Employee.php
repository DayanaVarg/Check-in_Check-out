<?php
defined ('BASEPATH') OR exit ('No direct script acces allowed');

class Employee extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('Users');
		$this->load->library(array('session'));
	}



	//views
	//Dashboard Employee
	public function dashboardEmpl(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role') == 3){
			$iden = $this->session->userdata('identification');
			$data = array(
				'navbarEmpl' => $this->load->view('layout/navbarEmpl', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
				'data'=> $this->Users->searchEm($iden),
			);
			$this->load->view('employee/dashboardEmpl',$data);
		}else{
			redirect('login');
		}
	}
}
