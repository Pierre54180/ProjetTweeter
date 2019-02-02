<?php

namespace mf\auth;

Class Authentification extends AbstractAuthentification {

public function  __construct()
	{
		if(isset($_SESSION['user_login'])){
			$this->user_login = $_SESSION['user_login'];
			$this->access_level = $_SESSION['access_level'];
			$this->logged_in = TRUE;}
		else{
			$this->user_login = null;
			$this->access_level =  self::ACCESS_LEVEL_NONE;
			$this->logged_in =  FALSE;}}

public function updateSession($user_name,$level){
	$this->user_login = $user_name;
	$this->access_level = $level;
	$_SESSION['user_login'] = $this->user_login; 
	$_SESSION['access_level'] = $this->access_level; 
	$this->logged_in = TRUE;}

public function logOut(){
	unset($_SESSION['user_login']);
	unset($_SESSION['access_level']);
	$this->user_login = null;
	$this->access_level = self::ACCESS_LEVEL_NONE;
	$this->logged_in = FALSE;}

  public function checkAccessRight($requested){
	if( $requested > $this->access_level){
		return FALSE;}
	else{return TRUE;}}

public function login($user_name, $db_pass, $given_pass, $level){
	$requete = \tweeterapp\model\User::where('username','=',$user_name);
	$res = $requete->first();
    $this->verifyPassword($given_pass,$db_pass);
    $this->updateSession($user_name,$level);}

public function hashPassword($password){
$hash =  password_hash($password, PASSWORD_DEFAULT);
return $hash;}

public function verifyPassword($password,$hash){
   if (!password_verify($password, $hash)) {
   throw new \mf\auth\exception\AuthentificationException("Desolé mais le mot de passe n'est pas valide");}}

}








?>