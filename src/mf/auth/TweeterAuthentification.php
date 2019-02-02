<?php

namespace mf\auth;

class TweeterAuthentification extends \mf\auth\Authentification {
    const ACCESS_LEVEL_USER  = 100;   
    const ACCESS_LEVEL_ADMIN = 200;

    public function __construct(){
        parent::__construct();}

    public function createUser($user_name, $pass, $full_name,$level=self::ACCESS_LEVEL_USER) { 
        $requete = \tweeterapp\model\User::where('username','=',$user_name);
        $res = $requete->first();
        $tt = new \mf\auth\exception\AuthentificationException();
        if($res !== null){
            throw new \mf\auth\exception\AuthentificationException("Désolé mais ce nom d'utilisateur existe deja");}
            $user = new \tweeterapp\model\User();
            $user->username = $user_name;
            $hash =  password_hash($pass, PASSWORD_DEFAULT);
            $user->password = $hash;
            $user->fullname = $full_name;
            $user->level = $level;
            $user->followers = 0;
            $user->save();}

    public function loginUser($user_name, $password){
        $requete = \tweeterapp\model\User::where('username','=',$user_name);
        $res = $requete->first();
        if($res == null){
        throw new \mf\auth\exception\AuthentificationException("Désolé mais l'utilisateur n'est pas conny");}
        $db_pass = $res->password;
        $given_pass = $password;
        $level = $res->level;
        $this->login($user_name,$db_pass,$given_pass,$level);}

}