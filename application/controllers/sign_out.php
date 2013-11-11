<?php

class Sign_Out extends CI_Controller {

    /**
     * Main function
     * Called be the router
     * @param string $page
     */
    public function view($page = 'home') {
        if(!file_exists('application/views/pages/'.$page.'.php'))
            show_404();

        $this->load->library('session');
        $this->load->helper('url');
        $this->signout();
        redirect(site_url("home"));
    }

    public function signout() {
        $this->session->unset_userdata('nickname');
        $this->session->unset_userdata('session_id');
    }



    function __construct()
    {
        parent::__construct();
        $this->myNameIs = 'home';
    }
}