<?php
class User extends CI_Model {

    public $data;

	public function __construct() {
        $this->load->library('XmlLoader');
        $this->data = XmlLoader::load_xml_file('user');
	}

    public function get_users() {
        //$data->null;
    }

    public function get_user_by_id($user_id) {

    }
}