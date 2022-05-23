<?php
class Home extends CI_Controller
{

    public function index()
    {
        echo "create more";
    }

    public function create()
    {
        $this->load->model('Common_model');
        $countries = $this->Common_model->getCountries();
        /* echo "<pre>";
        print_r($countries);
        echo "</pre>"; */
        $data = [];
        $data['countries'] = $countries;
        $this->load->view('create', $data);
    }

    public function getStates($countryId)
    {
        // $countryId = $this->input->post('countryId');
        $this->load->model('Common_model');
        $states = $this->Common_model->getStatesOfCountry($countryId);
        $data = [];
        $data['states'] = $states;
        $statestring = $this->load->view('states-select', $data, true);
        #third param true means View is not loaded and it will save as string value
        $response['states'] = $statestring;
        $response['result'] = '200';
        echo json_encode($response);
    }

    public function getCities($stateId)
    {
        // $stateId = $this->input->post('stateId'); 
        $this->load->model('Common_model');
        $cities = $this->Common_model->getCitiesOfState($stateId);
        $data = [];
        $data['cities'] = $cities;
        $citystring = $this->load->view('cities-select', $data, true);
        #third param true means View is not loaded and it will save as string value
        $response['cities'] = $citystring;
        $response['result'] = '200';
        echo json_encode($response);
    }

    public function saveUsers()
    {
        $this->load->model('Common_model');
        $this->load->library('form_validation');

        $post = file_get_contents('php://input');
        // $post = json_encode($post);
        $post = json_encode($post);
        print_r($post);
        $response = [];

        /*$this->form_validation->set_rules('name', 'Name', 'required');
         $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('city', 'City', 'required'); */

        if (true) {
            echo json_encode($post['name']);
            $formData = [];
            $formData['name'] = $this->input->post('name');
            $formData['email'] = $this->input->post('email');
            $formData['country'] = $this->input->post('country');
            $formData['state'] = $this->input->post('state');
            $formData['city'] = $this->input->post('city');

            print_r($formData);
            exit();
            $this->Common_model->add($formData);
            $response['status'] = 1;
            $this->session->set_flashdata('success', 'Client successfully added');
        } else {
            $response['name'] = form_error('name');
            $response['email'] = form_error('email');
            $response['country'] = form_error('country');
            $response['state'] = form_error('state');
            $response['city'] = form_error('city');
            $response['status'] = 0; #error
        }
        echo json_encode($response);
    }
}