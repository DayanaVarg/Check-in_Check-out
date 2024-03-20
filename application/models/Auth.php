<?php

class Auth extends  CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function  login($iden){
		if($this->input->server('REQUEST_METHOD')==='POST') {
			$data = $this->db->get_where('user', array('user.identification' => $iden), 1);
			if (!$data->result()) {
				return false;
			}
			return $data->row();
		}else{
			show_404();
		}
	}
}
?>
