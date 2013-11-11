<?php
/**
 * Created by IntelliJ IDEA.
 * User: damian
 * Date: 11/8/13
 * Time: 2:21 PM
 * To change this template use File | Settings | File Templates.
 */

class Subscription extends CI_Controller {

    /**
     * Main function
     * Called be the router
     * @param string $page
     */
    public function view($page = 'subscription') {

        if(!file_exists('application/views/pages/'.$page.'.php'))
            show_404();

        $this->load->library('XmlInterfacer');
        $this->load->library('session');

        $this->load->helper('url');

        if(isset($_POST['email'])){
            $this->create_user();
        }

        $data['title'] = 'Rpg Maker - Subscription';

        $this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     *
     */
    public function create_user() {
        $email = ($_POST['email']);
        $login = ($_POST['login']);
        $password = ($_POST['passwd']);

        $password = md5($password);

        $user = UserXml::create_user($email,$login,$password);
        $this->set_session($user);
        redirect(site_url("home_user"));
    }

    /**
     * Set the information about the user in the session
     * @param SimpleXMLElement $user
     */
    public function set_session($user) {
        $newdata = array(
            'id'  => (string)$user->id,
            'nickname'  => (string)$user->nickname,
            'creationDate'  => (string)$user->creationDate,
            'email'  => (string)$user->email,
            'logged_in' => TRUE
        );
        $this->session->set_userdata($newdata);
    }
}