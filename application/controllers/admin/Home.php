<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $admin = $this->session->userdata('admin');
        if (empty($admin)) {
            $this->session->set_flashdata('errors', 'You must login first');
            redirect(base_url() . 'admin/login/index');
        }
    }
    public function index()
    {
        // print_r($this->session->userdata('admin'));
        $this->load->view('admin/dashboard');
    }
}
