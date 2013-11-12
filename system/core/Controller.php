<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package        CodeIgniter
 * @author        ExpressionEngine Dev Team
 * @copyright    Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license        http://codeigniter.com/user_guide/license.html
 * @link        http://codeigniter.com
 * @since        Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package        CodeIgniter
 * @subpackage    Libraries
 * @category    Libraries
 * @author        ExpressionEngine Dev Team
 * @link        http://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller
{

    private static $instance;



    function my_name_is() {
        return get_class($this);
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        self::$instance =& $this;

        // Assign all the class objects that were instantiated by the
        // bootstrap file (CodeIgniter.php) to local class variables
        // so that CI can run as one big super object.
        foreach (is_loaded() as $var => $class) {
            $this->$var =& load_class($class);
        }

        $this->load =& load_class('Loader', 'core');

        $this->load->initialize();

        $this->load->library('XmlInterfacer');
        $this->load->library('AvailableUries');
        $this->load->library('session');

        log_message('debug', "Controller Class Initialized");
    }

    public static function &get_instance()
    {
        return self::$instance;
    }

    public function _remap($method, $params = array()){

        if($this->is_change_allowed($this->my_name_is())){
//            $this->$method();
//            $method = 'process_'.$method;
            if (method_exists($this, $method))
            {
                return call_user_func_array(array($this, $method), $params);
            }

            $this->$method();

        }
        else
        {
            echo "You are not allowed to view this page, sorry :/";
            exit;
        }
    }

    public function is_change_allowed($uri)
    {
        /**
         * @var SimpleXMLElement $usersRight
         */

        $user_id = $this->session->userdata('id');



        if(false === $user_id)
            return true;

        $usersRight = RightXml::get_Right_For_User($user_id);

//        creation
        if($this->containsOneOf($uri,AvailableUries::new_, AvailableUries::create, AvailableUries::creation, AvailableUries::rpg_creation )){
            return 'true'== (string)$usersRight->author ? true : false;
        }

//        rpg_list
        if($this->containsOneOf($uri,AvailableUries::rpg_list, AvailableUries::list_, AvailableUries::rpg)){
            return 'true' == (string)$usersRight->author ? true : false;
        }


        //The rest doesn't required right check so, gotta get there

        return true;
    }

    private function containsOneOf(){
        $i = 0;
        $n = func_num_args();

        $haystack = strtolower(func_get_arg($i++));
        for(;$i < $n; $i++){
            $needle = strtolower(func_get_arg($i));
            if($haystack == $needle || false != strpos($haystack, $needle)){
                return true;
            }
//            echo "$haystack --> $needle<br>";
        }
        return false;

    }
}
// END Controller class

/* End of file Controller.php */
/* Location: ./system/core/Controller.php */