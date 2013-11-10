<?php
/**
 * Created by IntelliJ IDEA.
 * User: damian
 * Date: 11/8/13
 * Time: 2:21 PM
 * To change this template use File | Settings | File Templates.
 */

class Subscription extends CI_Controller {

    public function view($page = 'subscription') {

        if(!file_exists('application/views/pages/'.$page.'.php'))
            show_404();

        //$this->load->model('user');
        $this->load->helper('url');

        $data['title'] = 'Rpg Maker - Subscription';

        $this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }

    public function create_user() {
        $email = ($_POST['mail']);
        $login = ($_POST['login']);
        $password = ($_POST['login']);
        //todo : Create the user, and redirect to home_user
        //User.createUser($email, $login, $password);
        //redirect(site_url("home_user"));
    }
}