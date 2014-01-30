<?php
/**
 * Created by IntelliJ IDEA.
 * User: Damian
 * Date: 1/30/14
 * Time: 8:03 PM
 */

class Service_Login extends CI_Controller {

    function __construct()
    {
        parent::__construct();
    }

    public function view($page = 'service_login') {
        if(!file_exists('application/views/pages/'.$page.'.php'))
            show_404();


        $this->load->helper('url');

        if($this->authentify()) {
            $user_id = $this->session->userdata('id');
            $data['user_id'] = $user_id;
            $data['xml_list'] = GameXml::get_Game_XML_By_User_with_meta($user_id);
        }else {
                $data['xml_list'] = array();
        }

        $this->load->view('pages/'.$page, $data);
    }

    /**
     * Load the authentification process
     * Redirect to the home page if the great parameters are not set
     */
    public function authentify() {
        $login      = isset($_POST['login'])    ? $_POST['login']   : null;
        $password   = isset($_POST['passwd'])   ? $_POST['passwd']  : null;
        if(!isset($login) || !isset($password)) {
            $login      = isset($_GET['login'])    ? $_GET['login']   : null;
            $password   = isset($_GET['passwd'])   ? $_GET['passwd']  : null;
            if(!isset($login) || !isset($password))
                return false;
        }

        return $this->verify_Ids($login, $password);
    }

    /**
     * Compare the given ids to the ids saved in databas
     * @param string $login
     * @param string $password
     *
     * @return bool
     */
    public function verify_Ids($login, $password) {
        $user = UserXml::get_user_by_login($login);
        if ($user && ((string)md5($password)) == ((string)$user->passWord)){
            $this->set_session($user);
            return true;
        }
        return false;
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