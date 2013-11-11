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

        $this->load->model('user');

        $this->authentify();

        $data['title'] = 'Rpg Maker - Esgi';

        $this->load->helper('url');

        $this->load->view('templates/header_user', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer_user', $data);
    }

    public function authentify() {
        $login      = isset($_POST['login'])    ? $_POST['login']   : $_GET['l'];
        $password   = isset($_POST['passwd'])   ? $_POST['passwd']  : $_GET['p'] ;
        if(isset($login) && isset($password))
            $this->check_form($login, $password);
        else $this->check_cookies();
    }

    public function check_form($login, $password) {
        if(!isset($login) && !isset($password))
            redirect('/home');

        $this->verify_Ids($login, $password);
    }

    public function check_cookies() {
        $login = $_COOKIE['rpg_login'];
        $password = $_COOKIE['rpg_pwd'];
        if(!isset($login) && !isset($password))
             redirect('/home');

        $this->verify_Ids($login, $password);
    }

    public function verify_Ids($login, $password) {
        //todo: appel de la vérification des identifiants via XML

        if(true)  {
            var_dump('hello');
            exit;
        }
        else redirect('/home/view');
    }
}