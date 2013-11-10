<?php
/**
 * Created by IntelliJ IDEA.
 * User: damian
 * Date: 11/8/13
 * Time: 2:21 PM
 * To change this template use File | Settings | File Templates.
 */

class Rpg_List extends CI_Controller {

    public function view($page = 'rpg_list') {
        if(!file_exists('application/views/pages/'.$page.'.php'))
            show_404();

        $this->load->model();
        $this->load->helper('url');

        $data['title'] = 'Rpg Listing';

        $data['games'] =



        $this->load->view('templates/header_user', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer_user', $data);
    }

    public function get_users_games($user_id) {

    }
}