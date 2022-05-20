<?php
class Home extends CI_Controller
{
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
        $statestring = $this->load->view('states-select',$data,true); 
    }
}
