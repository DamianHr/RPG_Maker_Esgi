<?php
/**
 * Created by IntelliJ IDEA.
 * User: damian
 * Date: 11/8/13
 * Time: 2:21 PM
 * To change this template use File | Settings | File Templates.
 */

class Rpg_List extends CI_Controller {

    /**
     * Main function
     * Called be the router
     * @param string $page
     */
    public function view($page = 'rpg_list') {
        if(!file_exists('application/views/pages/'.$page.'.php'))
            show_404();

//        $this->load->library('XmlInterfacer');
//        $this->load->library('session');

        $this->load->helper('url');

        $data['title'] = 'Rpg Listing';

        $user_id = $this->session->userdata('id');
        $data['games'] = GameXml::get_Game_By_User_with_meta($user_id);

        $this->load->view('templates/header_user', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer_user', $data);
    }


    function __construct()
    {
        parent::__construct();
        $this->myNameIs = 'rpg_list';
    }
}