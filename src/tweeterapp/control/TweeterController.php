<?php

namespace tweeterapp\control;

class TweeterController extends \mf\control\AbstractController {

    public function __construct(){
        parent::__construct();
    }

    public function viewFormTweet(){
        $view = new \tweeterapp\view\TweeterView(null);
        return $view->render('renderFormTweet');
    }

public function viewSendF(){
        $tweet = new  \tweeterapp\model\Tweet(); 
        $tweet->author = 1;
        var_dump($_POST["tweet"]);
        $nettoyage = filter_var($_POST["tweet"], FILTER_SANITIZE_STRING);
        $tweet->text = $nettoyage;
        $tweet->save();
    }   

    public function viewHome(){
    $requete = \tweeterapp\model\Tweet::with('User')->get();
    $view = new \tweeterapp\view\TweeterView($requete);
    return $view->render('');
    }

    public function viewTweet(){
       $id = $_GET['id']; 
       $requete = \tweeterapp\model\Tweet::where('id','=',$id)->first();
        $view = new \tweeterapp\view\TweeterView($requete);
        return $view->render("renderViewTweet");
    }

    public function viewUserTweets(){
    $id = $_GET['id'];
    $hihi = \tweeterapp\model\User::find($id);
    $view = new \tweeterapp\view\TweeterView($hihi);
    return $view->render('UserTweets');   
    }
}