<?php
/**
 * Created by IntelliJ IDEA.
 * User: damian
 * Date: 11/8/13
 * Time: 2:21 PM
 * To change this template use File | Settings | File Templates.
 */

class Home extends CI_Controller {

    /**
     * Main function
     * Called be the router
     * @param string $page
     */

    function __construct()
    {
        parent::__construct();
        $this->myNameIs = 'home';
    }

    public function view($page = 'home') {
        if(!file_exists('application/views/pages/'.$page.'.php'))
            show_404();

        $data['title'] = 'Rpg Maker - Esgi';

        $this->load->helper('url');

        $this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }
}