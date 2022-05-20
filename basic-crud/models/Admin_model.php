<?php
class Admin_model extends CI_Model
{
    public function demo()
    {
        $admins[0] = 'Kirtishil';
        $admins[1] = 'Sushil';
        return $admins;
    }

    public function example()
    {
        // $users = $this->db->query("SELECT * FROM users")->result_array();

        #or

        $users = $this->db->select('id,name,email')->where('id', 1)->get('users')->result_array();
        return $users;
    }

    public function get_data()
    {
        $query = $this->db->get('users');

        foreach ($query->result() as $row) {
            echo $row->name;
            echo " : ";
            echo $row->email;
            echo "<br>";
        }

        return $query->result_array();
    }

    public function insert_data($name, $email)
    {
        $data = array(
            'name' => $name,
            'email' => $email,
        );

        $res = $this->db->insert('users', $data);
        return $res;

        /* 
        $data = array('name' => $name, 'email' => $email);
        $this->db->insert_string('table_name', $data);
        */
    }

    public function update_data($name, $email, $id)
    {
        $data = array('name' => $name, 'email' => $email);

        $res = $this->db->where('id', $id);

        return $res->update('users', $data);
    }

    public function delete_data($name)
    {
        $res = $this->db->delete('users', array('name' => $name));
        return $res;
    }
}
