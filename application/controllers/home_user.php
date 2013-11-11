<?php
/**
 * Created by IntelliJ IDEA.
 * User: damian
 * Date: 11/8/13
 * Time: 2:21 PM
 * To change this template use File | Settings | File Templates.
 */
class Home_User extends CI_Controller {

    /**
     * Main function
     * Called be the router
     * @param string $page
     */
    public function view($page = 'home_user') {
        if(!file_exists('application/views/pages/'.$page.'.php'))
            show_404();

        $this->load->library('XmlInterfacer');
        $this->load->library('session');

        $this->load->helper('url');

        $nickname = $this->session->userdata('nickname');
        if(!$nickname)
            $this->authentify();

        $data['title'] = 'Rpg Maker - Esgi';

        $username = $this->session->userdata('nickname');
        $data['nickname'] =  isset($username) ? $username : 'user';

        $this->load->view('templates/header_user', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer_user', $data);
    }

    /**
     * Load the authentification process
     * Redirect to the home page if the great parameters are not set
     */
    public function authentify() {
        $login      = isset($_POST['login'])    ? $_POST['login']   : null;
        $password   = isset($_POST['passwd'])   ? $_POST['passwd']  : null;
        if(!isset($login) || !isset($password))
            redirect('/home');

        $this->verify_Ids($login, $password);
    }

    /**
     * Compare the given ids to the ids saved in databas
     * @param string $login
     * @param string $password
     */
    public function verify_Ids($login, $password) {
        $user = UserXml::get_user_by_login($login);

        if(!($user || ((string)md5($password)) == ((string)$user->passWord)))
             redirect('/home/view', 'retryLogin');
        $this->set_session($user);
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