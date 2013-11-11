<?php

class IceBreaker
{

    public static function is_change_allowed($uri = '', $method = 'location', $http_response_code = 302)
    {
        require_once "application/libraries/XmlInterfacer.php";
        require_once "application/core/AvailableUries.php";

        //TODO get the connected user's id
        /**
         * @var SimpleXMLElement $usersRight
         */
        $usersRight = RightXml::get_Right_For_User(0);



        //TODO create a you don't have the right page or something

//        creation
        if(self::containsOneOf($uri,AvailableUries::new_, AvailableUries::create, AvailableUries::creation, AvailableUries::rpg_creation )){
            return 'true'== (string)$usersRight->author ? true : false;
        }

//        rpg_list
        if(self::containsOneOf($uri,AvailableUries::rpg_list, AvailableUries::list_, AvailableUries::rpg)){
            return 'true' == (string)$usersRight->author ? true : false;
        }

        //The rest doesn't required right check so, gotta get there

        return true;


        //home, signout, subscription, //user_home
//        if(self::containsOnOf($uri, default_controller, home, index, empty_chain, signout, subscription, home_user)){
//            redirect($uri,$method,$http_response_code);
//            return;
//        }



    }

    private static function containsOneOf(){
        $i = 0;
        $n = func_num_args();

        $haystack = func_get_arg($i++);
        for(;$i < $n; $i++){
            $needle = func_get_arg($i);
            if(false != strpos($haystack, $needle)){
                return true;
            }
        }
        return false;

    }

}