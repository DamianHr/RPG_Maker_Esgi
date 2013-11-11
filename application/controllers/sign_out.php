<?php

class Sign_Out extends CI_Controller {

    public function view($page = 'home') {
        if(!file_exists('application/views/pages/'.$page.'.php'))
            show_404();

        $this->load->helper('url');
        $this->signout();
        redirect(site_url("home"));
    }

    public function signout() {
        setcookie('rpg_login', '', time()-3600);
        setcookie('rpg_pwd', '', time()-3600);
    }
}