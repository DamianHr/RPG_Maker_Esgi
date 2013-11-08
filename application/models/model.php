<?php
class User extends CI_Model {

	public function __construct() {
		$this->load->database();
	}

    public function get_users() {
        $query = $this->db->get('users');
        return $query->result_array();
    }

    public function get_user_by_id($user_id) {
        $query = $this->db->get_where('users', array('id' => $user_id));
        return $query->row_array();
    }
}