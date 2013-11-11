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
        $this->load->library('XmlInterfacer');

        $this->load->helper('url');

        if(isset($_POST['email'])){
            $this->create_user();
        }

        $data['title'] = 'Rpg Maker - Subscription';

        $this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }

    public function create_user() {
        $email = ($_POST['email']);
        $login = ($_POST['login']);
        $password = ($_POST['passwd']);

        $password = md5($password);

        UserXml::create_user($email,$login,$password);
        $this->set_cookies($login,md5($password));
        redirect(site_url("home_user"));

        //User.createUser($email, $login, $password);
        //redirect(site_url("home_user"));
    }

    public function set_cookies($login, $password) {
        setcookie('rpg_login', $login, time()+60*60*24);
        setcookie('rpg_pwd', $password, time()+60*60*24);
    }
}