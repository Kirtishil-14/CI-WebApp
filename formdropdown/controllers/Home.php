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
        $post = json_decode($post);

        $response = [];

        if ($post->name != "") {
            $formData = [
                'name' => $post->name,
                'email' => $post->email,
                'country' => $post->country,
                'state' => $post->state,
                'city' => $post->city,
            ];

            $this->Common_model->add($formData);
            $response['status'] = 1;
            $this->session->set_flashdata('success', 'Client successfully added');
        } else {
            $response['msg'] = 'Please fill all the fields';
            $response['status'] = 0; #error
        }
        echo json_encode($response);
    }
}