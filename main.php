<?php 
use mf\auth\AbstractAuthentification as AbstractAuthentification;
use mf\auth\Authentification as Authentification;
use mf\utils\AbstractHttpRequest as AbstractHtppRequest;
use tweeterapp\model\Follow as Follow;
use tweeterapp\model\like as Like;
use tweeterapp\model\Tweet as Tweet;
use tweeterapp\model\User as User;
use \tweeterapp\control\TweeterController as TweeterController;
use mf\router\Router as Router;
use mf\auth\TweeterAuthentification as TweeterAuthentification;
use Illuminate\Database\Capsule\Manager as DB; 

echo realpath('main.php');
require_once('src/mf/utils/ClassLoader.php');
require_once ('vendor/autoload.php');
session_start();

$config = parse_ini_file("conf.ini");
/* une instance de connexion  */
$db = new Illuminate\Database\Capsule\Manager();
$db->addConnection($config); /* configuration avec nos paramètres */
$db->setAsGlobal();            /* visible de tout fichier */
$db->bootEloquent();           /* établir la connexion */
$namespace = new ClassLoader('src/');
$namespace->register();
var_dump($_SESSION);
$test = new TweeterController();
$Test = new TweeterAuthentification();
$router = new \mf\router\Router();

$router->addRoute('All','/all','\tweeterapp\control\TweeterController','viewHome',TweeterAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('OneTweet','/tweet','\tweeterapp\control\TweeterController','viewTweet',TweeterAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('Atweet','/author/tweets','\tweeterapp\control\TweeterController','viewUserTweets',TweeterAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('FormTweet','/formtweet','\tweeterapp\control\TweeterController','viewFormTweet',TweeterAuthentification::ACCESS_LEVEL_USER);
$router->addRoute('SendForm','/sendtweet','\tweeterapp\control\TweeterController','viewSendF',TweeterAuthentification::ACCESS_LEVEL_USER);


$router->addRoute('FormLogin','/formlogin','\tweeterapp\control\TweeterAdminController','viewLogin',TweeterAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('FollowTweet','/tweeterview','\tweeterapp\control\TweeterAdminController','viewFollowTweet',TweeterAuthentification::ACCESS_LEVEL_USER);
$router->addRoute('loginUser','/login','\tweeterapp\control\TweeterAdminController','checkLogin',TweeterAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('logOut','/logout','\tweeterapp\control\TweeterAdminController','logoutUser',TweeterAuthentification::ACCESS_LEVEL_USER);
$router->addRoute('signUp','/signup','\tweeterapp\control\TweeterAdminController','signUp',TweeterAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('checkSignUp','/checksignup','\tweeterapp\control\TweeterAdminController','checkSignUp',TweeterAuthentification::ACCESS_LEVEL_NONE);
$router->setDefaultRoute('');
$router->run();

$router->urlFor('OneTweet',['id'=>49]);

?>