<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$query=$this->db->query("SELECT * FROM tbl_workshop;");
        $data['data']=$query->result_array();
		$this->load->view('header');
		$this->load->view('home',$data);
		$this->load->view('footer');
	}
	public function login()
	{
		$this->load->view('header');
		$this->load->view('login');
		$this->load->view('footer');
	}
	public function loginvendor()
	{
		$this->load->view('header');
		$this->load->view('loginvendor');
		$this->load->view('footer');
	}
	public function logout(){
		$this->session->sess_destroy();
		$this->load->view('header');
		$this->load->view('login');
		$this->load->view('footer');
		
	}
	public function vendorlogout(){
		$this->session->sess_destroy();
		$this->load->view('header');
		$this->load->view('loginvendor');
		$this->load->view('footer');
		
	}
}
