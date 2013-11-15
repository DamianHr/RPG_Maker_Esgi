<?php
/**
 * Created by IntelliJ IDEA.
 * User: damian
 * Date: 11/8/13
 * Time: 2:21 PM
 * To change this template use File | Settings | File Templates.
 */

class Search extends CI_Controller
{

    /**
     * Main function
     * Called be the router
     * @param string $page
     */
    public function view($page = 'search')
    {
        if (!file_exists('application/views/pages/' . $page . '.php'))
            show_404();

        $data['title'] = 'Rpg Maker - Esgi - Search';

        $this->load->helper('url');

        $author = isset($_POST['author']) ? $_POST['author'] : null;
        $summary = isset($_POST['summary']) ? true : false;

        $list_game_by_user = array();

        if (isset($author)) {
            $list_infos_users = $this->search_users($author);
            if ($list_infos_users !== false) {
                foreach ($list_infos_users as $user) {
                    $list_game_by_user[(string)$user->nickname] = null;
                }
                foreach ($list_infos_users as $user) {
                    $list_game_by_user[(string)$user->nickname] = GameXml::get_Game_By_User_with_meta((int)$user->id);
                }
            }
            if ($summary) {
                $data['summary'] = true;
            }
        }

        $data['list_infos_users'] = $list_game_by_user;

        $is_connected = $this->session->userdata('nickname');
        //var_dump($is_connected);
        //exit;
        if($is_connected)  $this->load->view('templates/header_user', $data);
        else $this->load->view('templates/header', $data);
        $this->load->view('pages/' . $page, $data);
        if($is_connected)$this->load->view('templates/footer_user', $data);
        else $this->load->view('templates/footer', $data);

    }

    public function search_users($login = "")
    {
        $list_users = UserXml::search_users_by_login($login);

        return $list_users ? $list_users : false;
    }

//    public function search_games_by_users($list_id = array())
//    {
//        $list_games = GameXml::search_games_by_users($list_id);
//
//        return $list_games ? $list_games : false;
//    }

//    public function search_summary_by_games($list_files_game)
//    {
//
//        $list_infos_game = GameXml::get_game_all_infos_by_id($list_files_game);
//
//    }
}