<?php
/**
 * Created by IntelliJ IDEA.
 * User: damian
 * Date: 11/8/13
 * Time: 2:21 PM
 * To change this template use File | Settings | File Templates.
 */

class Rpg_Creation extends CI_Controller {


    function __construct()
    {
        parent::__construct();
    }


    /**
     * Main function
     * Called be the router
     * @param string $page
     */
    public function view($page = 'rpg_creation') {
        if(!file_exists('application/views/pages/'.$page.'.php'))
            show_404();


        $this->load->helper('url');

        if(isset($_POST['xml'])) {
            //var_dump($_POST['xml']);
            //exit;
            $user_id = $this->session->userdata('id');

            GameXml::create_game($user_id, $_POST['xml']);
            redirect(site_url('rpg_list'));
        }

        $data['title'] = 'Rpg Creation';

        $this->load->view('templates/header_user', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer_user', $data);
    }

}