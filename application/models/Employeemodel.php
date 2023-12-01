<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employeemodel extends CI_Model {

    public function insertEmployee($data)
    {
         $this->db->insert('codeigniter_ajax', $data);

        return $this->db->affected_rows() > 0;

    }
   
    public function getEmployee() {
        // Fetch data from the database
        return $this->db->get('codeigniter_ajax')->result_array();
    }
       
    public function deleteEmployee($id)
{
    $this->db->where('id', $id);
    $this->db->delete('codeigniter_ajax');

    return $this->db->affected_rows() > 0;
}

public function get_employee_by_id($id) {
    return $this->db->get_where('codeigniter_ajax', array('id' => $id))->row();
}


public function update_employee($id, $data) {
    $this->db->set($data);
    $this->db->where('id', $id);
    $this->db->update('codeigniter_ajax');
    return $this->db->affected_rows() > 0;

}

}
?>