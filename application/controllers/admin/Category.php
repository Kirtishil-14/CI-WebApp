<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{
    public function index()
    {
        $this->load->view('admin/category/list');
    }

    public function create()
    {
    }

    public function edit()
    {
    }

    public function delete()
    {
    }
}
