<?php
/**
 * Created by IntelliJ IDEA.
 * User: damian
 * Date: 11/8/13
 * Time: 2:21 PM
 * To change this template use File | Settings | File Templates.
 */

class Home_User extends CI_Controller {

    public function view($page = 'home_user') {
        if(!file_exists('application/views/pages/'.$page.'.php'))
            show_404();

        $data['title'] = 'Rpg Maker - Esgi';

        $this->load->view('templates/header_user', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer_user', $data);
    }

}