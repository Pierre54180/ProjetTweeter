<?php

namespace tweeterapp\control;
class TweeterAdminController extends \mf\control\AbstractController
{
	public function __construct(){
        parent::__construct();
	}
	
	public function viewLogin(){
		if(!empty($_SESSION)){
			header('Location: /iut/tweeter/main.php');
			exit();
		}
		$view = new \tweeterapp\view\TweeterView(null);
		return $view->render('renderFormLogin');
	}

	public function viewFollowTweet(){
		$data = \tweeterapp\model\User::find('10')->follows;
		$view = new \tweeterapp\view\TweeterView($data);
		return $view->render('renderFollowers');
	}

	public function checklogin(){
		$login = $_POST["login"];
		$pass = $_POST["password"];
		$User = new \mf\auth\TweeterAuthentification();
		try {
		$User->loginUser($login,$pass);	
		}
		catch (\mf\auth\exception\AuthentificationException $e){
			echo $e->getmessage();
			return $this->viewLogin();
		}
		$this->viewFollowTweet();
	}

	public function logoutUser(){
		$User = new \mf\auth\TweeterAuthentification();
		$User->logout();
		$route = \mf\router\Router::executeRoute("signUp");
	}

	public function signUp(){
		$view = new \tweeterapp\view\TweeterView(null);
		return $view->render('renderSignUp');
	}

	public function checkSignUp(){
		$login = $_POST["username"];
		$pass = $_POST["password"];
		$fullname = $_POST["fullname"];
		$User = new \mf\auth\TweeterAuthentification();
		try{
			$User->createUser($login,$pass,$fullname);	
		}
		catch (\mf\auth\exception\AuthentificationException $e){
			echo $e->getmessage();
			return $this->signup();
		}
		$route = \mf\router\Router::executeRoute("All");
	}

}



