<?php
class Common_model extends CI_Model
{
    public function getCountries()
    {
        $countries = $this->db->get('countries')->result_array();
        return $countries;
    }

    public function getStatesOfCountry($country)
    {
        $this->db->where('country_id', $country);
        $states = $this->db->get('states')->result_array();
        // echo $this->db->last_query();
        return $states;
    }
}
