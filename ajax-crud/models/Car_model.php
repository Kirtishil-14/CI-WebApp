<?php
class car_model extends CI_Model
{
    public function create($formArray)
    {
        $this->db->insert('car_models', $formArray);
        return $id = $this->db->insert_id();
    }

    public function all()
    {
        $result = $this->db->order_by('id', 'ASC')
            ->get('car_models')
            ->result_array();
        return $result;
    }

    public function getRow($id)
    {
        $this->db->where('id', $id);
        $row = $this->db->get('car_models')->row_array();
        return $row;
    }

    public function update($id, $formArray)
    {
        $this->db->where('id', $id);
        $this->db->update('car_models', $formArray);
        return $id;
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('car_models');
    }
}