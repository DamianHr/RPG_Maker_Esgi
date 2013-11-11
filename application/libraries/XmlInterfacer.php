<?php

class UserXml
{
    const  userDb = 'application/database/user.xml';

    public static function create_user($email, $login, $password)
    {
        $file = simplexml_load_file(self::userDb);
        $user = $file->addChild('user');
        // todo: the login of the user must be unique, check it!
        $id = time();
        $user->addChild('id', $id);
        $user->addChild('nickname', $login);
        $user->addChild('passWord', $password);
        $user->addChild('creationDate', date("Y-m-d"));
        $user->addChild('lastConnexion', date("Y-m-d"));
        $user->addChild('email', $email);

        $file->saveXML(self::userDb);

        RightXml::save_Rights($id, new SimpleXMLElement('<userRight><author>true</author><admin>false</admin><player>true</player><connection>true</connection></userRight>'));

        return $user;
    }

    public static function get_User_By($id)
    {
        $file = simplexml_load_file(self::userDb);

        $user = $file->xpath("/users/user[id=$id]");

        return $user ? $user[0] : false;

    }

    public static function get_user_by_login($login)
    {
        $file = simplexml_load_file(self::userDb);

        $user = $file->xpath("/users/user[nickname='$login']");

        return $user ? $user[0] : false;
    }
}

class GameXml
{
    const gameDb = 'application/database/game.xml';
    const gameFilesDirectory = 'application/database/games';
    const gameFileHeader = "<?xml version=\"1.0\"?>\n<game xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"\n      xsi:noNamespaceSchemaLocation=\"application/schemas/gameFile.xsd\">";

    public static function  get_Game_By_Id($id)
    {
        $file = simplexml_load_file(self::gameDb);

        $game = $file->xpath("/games/game[id=$id]");
        $game = $game ? $game[0] : false;

        if ($game) {
            $gameFile = simplexml_load_file($game->path);
            return $gameFile;
        }

        return false;
    }

    public static function get_game_meta($id){
        $file = simplexml_load_file(self::gameDb);

        $game = $file->xpath("/games/game[id=$id]");

        return  $game ? $game[0] : false;
    }

    public static function get_Game_By_User($id)
    {
        //TODO game with metas
        $file = simplexml_load_file(self::gameDb);

        $games = $file->xpath("/games/game[userId=$id]");

        if (!$games)
            return false;

        $gameFiles = array();
        foreach ($games as $game) {
            $gameFile = simplexml_load_file(self::gameFilesDirectory . "/$game->path");
            if ($gameFile)
                array_push($gameFiles, $gameFile);
        }

        return $gameFiles;
    }


    /**
     * @param SimpleXMLElement $xml_Game
     */
    public static function create_game($author_Id, $xml_Game)
    {
        $file = simplexml_load_file(self::gameDb);
        $game = $file->addChild('game');

        $id = $file->count();
        $name = $id . '.xml';

        $game->addChild('id', $id);
        $game->addChild('userId', $author_Id);
        $game->addChild('creationDate', date("Y-m-d"));
        $game->addChild('path', $name);

        $file->saveXML(self::gameDb);

        $gameFile = new SimpleXMLElement(self::gameFileHeader . $xml_Game->asXml());

        $gameFile->saveXML(self::gameFilesDirectory . $name);
    }
}

class SaveXml
{
    const  saveDb = 'application/database/save.xml';

    public static function get_Save_For($user_Id, $game_Id)
    {
        $file = simplexml_load_file(self::saveDb);

        $save = $file->xpath("/saves/save[userId=$user_Id AND gameId=$game_Id]");


        return $save ? $save[0] : false;
    }

    /**
     * @param SimpleXMLElement $xml_Save
     */
    public static function save_Advancement($user_Id, $xml_Save)
    {
        $file = simplexml_load_file(self::saveDb);

        $save = $file->xpath("/saves/save[userId=$user_Id AND gameId=$xml_Save->gameId]");
        $save = $save ? $save[0] : false;

        if(!$save){
            $save = $file->addChild('userRight');//= new SimpleXMLElement('<userRight></userRight>');
            $save->addChild('userId', $user_Id);
            $save->addChild('gameId', $xml_Save->gameId);
            $save->addChild('score', $xml_Save->score);
            $save->addChild('currentSituation', $xml_Save->currentSituation);
        }else{
            $save->userId = $user_Id;
            $save->gameId = $xml_Save->gameId;
            $save->score = $xml_Save->score;
            $save->currentSituation = $xml_Save->currentSituation;
        }

        $file->saveXML(self::saveDb);
    }
}

class RightXml
{
    const rightDb = 'application/database/right.xml';

    /**
     * @param SimpleXMLElement $xml_Rights
     */
    public static function save_Rights($user_Id, $xml_Rights)
    {
        $file = simplexml_load_file(self::rightDb);

        $right = $file->xpath("/right/userRight[id=$user_Id]");

        $right = $right ? $right[0] : false;

        if(!$right){
            $right = $file->addChild('userRight');//= new SimpleXMLElement('<userRight></userRight>');
            $right->addChild('id', $user_Id);
            $right->addChild('author', empty($xml_Rights->author) ? 'false' : $xml_Rights->author);
            $right->addChild('admin', empty($xml_Rights->admin) ? 'false' : $xml_Rights->admin);
            $right->addChild('player', empty($xml_Rights->player) ? 'false' : $xml_Rights->player);
            $right->addChild('connection', empty($xml_Rights->connection) ? 'false' : $xml_Rights->connection);

//            $file->addChild('userRight', $right);
        }else{
            $right->author = empty($xml_Rights->author) ? 'false' : $xml_Rights->author;
            $right->admin =  empty($xml_Rights->admin) ? 'false' : $xml_Rights->admin;
            $right->player = empty($xml_Rights->player) ? 'false' : $xml_Rights->player;
            $right->connection =  empty($xml_Rights->connection) ? 'false' : $xml_Rights->connection;
            $right->id = $user_Id;
        }

        $file->saveXML(self::rightDb);

        return $right;
    }

    public static function get_Right_For_User($id)
    {
        $file = simplexml_load_file(self::rightDb);

        $right = $file->xpath("/right/userRight[id=$id]");

        return $right ? $right[0] : false;
    }
}

class XmlInterfacer
{

    /**
     * @param $userId
     * @param $gameId
     *
     * returns the specified game with the current save for the specified user
     */
    public static function load_Game($user_Id, $game_Id)
    {
        $game = GameXml::get_Game_By_Id($game_Id);
        $gameMeta = GameXml::get_game_meta($game_Id);
        $save = SaveXml::get_Save_For($user_Id,$game_Id);
        $author = UserXml::get_User_By($gameMeta->userId);


        $answer = new SimpleXMLElement('<game></game>');

        $meta =     $answer->addChild('meta');

        $metaAuthor = $meta->addChild('author');
        $metaAuthor->addChild('nickname', $author->nickname);
        $metaAuthor->addChild('id', $author->id);

        $meta->addChild('creationDate', $gameMeta->creationDate);

        $metaSave = $meta->addChild('save');
        $metaSave->addChild('points', $save->score);
        $metaSave->addChild('currentSituation', $save->currentSituation);



        $answer->addChild('meta', $meta);
        $answer->addChild('game', $game);

        return $answer;
    }
}