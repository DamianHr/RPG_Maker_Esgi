<?php
/**
 * Created by IntelliJ IDEA.
 * User: Damian
 * Date: 1/30/14
 * Time: 9:51 PM
 */

class Service_Game extends CI_Controller {
    function __construct()
    {
        parent::__construct();
    }

    public function view($page = 'service_game') {
        if(!file_exists('application/views/pages/'.$page.'.php'))
            show_404();


        $this->load->helper('url');

        if($this->authentify()) {
            $user_id = $this->session->userdata('id');
            $data['user_id'] = $user_id;
            $data['game'] = GameXml::get_Game_XML_By_Id($this->session->userdata('game'));
        }else {
            $data['game'] = array();
        }

        $this->load->view('pages/'.$page, $data);
    }

    /**
     * Load the authentification process
     * Redirect to the home page if the great parameters are not set
     */
    public function authentify() {
        $user_id = isset($_POST['user'])   ? $_POST['user']  : null;
        $game    = isset($_POST['game'])   ? $_POST['game']  : null;
        if(!isset($user_id) || !isset($game)) {
            $user_id = isset($_GET['user'])   ? $_GET['user']  : null;
            $game    = isset($_GET['game'])   ? $_GET['game']  : null;
            if(!isset($user_id) || !isset($game))
                return false;
        }

        return $this->verify_Ids($user_id, $game);
    }

    /**
     * Compare the given ids to the ids saved in databas
     * @param string $user_id
     * @param $game
     * @return bool
     */
    public function verify_Ids($user_id, $game) {
        $user = UserXml::get_User_By($user_id);

        if (!$user) return false;

        $this->set_session($user, $game);
        return true;
    }

    /**
     * Set the information about the user in the session
     * @param SimpleXMLElement $user
     * @param $game
     */
    public function set_session($user, $game) {
        $newdata = array(
            'id'  => (string)$user->id,
            'nickname'  => (string)$user->nickname,
            'creationDate'  => (string)$user->creationDate,
            'email'  => (string)$user->email,
            'game' => (string) $game,
            'logged_in' => TRUE
        );
        $this->session->set_userdata($newdata);
    }
} 