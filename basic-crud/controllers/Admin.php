<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	#default method
	public function index()
	{
		$data = array();
		// $data['names'] = array('Kirtishil', 'Sushil');
		$admins = $this->Admin_model->demo();
		$data['names'] = $admins;
		$this->load->view('admin_welcome', $data);

		$users = $this->Admin_model->example();
		echo "<pre>";
		print_r($users);
		echo "</pre>";

		/* $this->load->library(array('form_validation'));
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required'); */

		$this->load->helper('text');
		$string = 'Kirtishil Nana Patil';
		echo word_limiter($string, 1);
		echo "<br>";

		#custom helper
		$this->load->helper('common_helper');
		common();

		#extending helper
		$this->load->helper('html');
		mytest();
		echo "<br>";

		#custom library
		$this->load->library('Hello');
		echo $this->hello->sayHello();
		echo "<br>";

		#extending library
		$this->load->library('email');
		echo $this->email->mytest();
		echo "<br>";
	}

	#------------------CRUD------------------------
	public function getdata()
	{
		$this->Admin_model->get_data();
	}

	public function insertdata($name, $email)
	{
		$res = $this->Admin_model->insert_data($name, $email);
		echo $res;
	}

	public function updatedata($name, $email, $id)
	{
		$res = $this->Admin_model->update_data($name, $email, $id);
		echo $res;
	}

	public function deletedata($name)
	{
		$res = $this->Admin_model->delete_data($name);
		echo $res;
	}
	#--------------------------------------------------


	public function test()
	{
		echo "test";
	}

	public function add($param1, $param2)
	{
		echo $param1 + $param2;
	}
}
