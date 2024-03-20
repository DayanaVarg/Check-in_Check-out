<?php

class Graphs extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('Users');
		$this->load->library(array('session'));
	}
	
//Vista estadísticas
	public function index(){
		if($this->session->userdata('is_logged') and $this->session->userdata('id_Role')== 1){
			$emp = $this->Users->getEmp();
			$vis = $this->Users->getVis();
			$total = $emp + $vis;

			$data = array(
				'graph_data' => array(
					array('label' => 'Employee', 'value' => $emp, 'color' => '#3366cc'),
					array('label' => 'Vsitor', 'value' => $vis, 'color' => '#dc3912'),
					array('label' => 'Total', 'value' => $total, 'color' => '#ff9900'),
				),
				'graph_dat' => array(
					array('Mes', 'Empleados', 'Visitantes'),
					array('En',  $this->Users->getfecE('01'), $this->Users->getfecV('01')),
					array('Feb', $this->Users->getfecE('02'), $this->Users->getfecV('02')),
					array('Mar', $this->Users->getfecE('03'), $this->Users->getfecV('03')),
					array('Abr', $this->Users->getfecE('04'), $this->Users->getfecV('04')),
					array('May', $this->Users->getfecE('05'), $this->Users->getfecV('05')),
					array('Jun', $this->Users->getfecE('06'), $this->Users->getfecV('06')),
					array('Jul', $this->Users->getfecE('07'), $this->Users->getfecV('07')),
					array('Ago', $this->Users->getfecE('08'), $this->Users->getfecV('08')),
					array('Sep', $this->Users->getfecE('09'), $this->Users->getfecV('09')),
					array('Oct', $this->Users->getfecE('10'), $this->Users->getfecV('10')),
					array('Nov', $this->Users->getfecE('11'), $this->Users->getfecV('11')),
					array('Dec', $this->Users->getfecE('12'), $this->Users->getfecV('12')),
				),
				'navbar' => $this->load->view('layout/navbar', '', TRUE),
				'footer'=>$this->load->view('layout/footer', '', TRUE),
				'emp' => $this->Users->getEmp(),
				'vis' => $this->Users->getVis(),
				'total' => $emp + $vis,
				

			);

			$this->load->view('user/viewStatis',$data);
		}else{
			redirect('login');
		}
	}
}
