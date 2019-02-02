<?php

namespace tweeterapp\view;

class TweeterView extends \mf\view\AbstractView {

    public function __construct($data){
        parent::__construct($data);
    }

    private function renderHeader(){
        $html = <<<EOT
        <div class="container">
            <header>
                <div class="row heeader">
                    <div class="elementImage col-md-12"><h1>Tweeter by Pierre!</h1></div>
                    <div class="Img col-md-2"><a href="/iut/tweeter/main.php"> <img src="/iut/tweeter/open-iconic-master/svg/home.svg" alt="home" ></a></div>
                    <div class="Img offset-md-3 col-md-2"><a href="/iut/tweeter/main.php/formlogin"> <img src="/iut/tweeter/open-iconic-master/svg/account-login" href=""alt="account-login" ></a></div>
                    <div class="Img offset-md-3 col-md-2"><a href="/iut/tweeter/main.php/signup"><img src="/iut/tweeter/open-iconic-master/svg/plus" alt="plus" ></a></div>
                </div>
            </header>
EOT;
        return $html; 
    }

    private function renderHeaderUser(){
        $html = <<<EOT
            <div class="container">
            <header>
                <div class="row heeader">
                    <div class="elementImage col-md-12"><h1>Tweeter by Pierre!</h1></div>
                    <div class="Img col-md-2"><a href="/iut/tweeter/main.php"> <img src="/iut/tweeter/open-iconic-master/svg/home.svg" alt="home" ></a></div>
                    <div class="Img offset-md-3 col-md-2"><a href="/iut/tweeter/main.php/TweeterView"> <img src="/iut/tweeter/open-iconic-master/svg/person" alt="person" ></a></div>
                    <div class="Img offset-md-3 col-md-2"><a href="/iut/tweeter/main.php/logout"> <img src="/iut/tweeter/open-iconic-master/svg/ban" href=""alt="ban" ></a></div>
                </div>
            </header>
EOT;
        return $html;
    }

    private function renderFooter(){
        $html = '<div class="row footer">
        <div class="offset-md-2 col-md-7">La super app crÃ©Ã©e en Licence Pro en 2018</div>
        </div>';
        return $html;
    }

    private function renderButtonNew(){
        $html ='<div class="row post">
        <div class="post offset-md-6 col-md-2"><a href="/iut/tweeter/main.php/formtweet"> NEW </a></div>
        </div>'; 
    return $html;
    }

    private function renderHome(){
        $route = new \mf\router\Router();
        $html = "<h2> Latest Tweets</h2>";
        $data_tweets = $this->data;
        $html .= '<div class ="row tweet">';
       foreach($data_tweets as $tweet){
            $html.= '<div class = "tweeterrow col-md-10 offset-md-1">';    
            $html .='<div class = "row">';  
            $html.='<div class="Message col-md-12"><a href='.$route->Urlfor('OneTweet',["id"=>$tweet->id]).'>'.$tweet->text.'</a></div>';
            $html.= '<div class="Auteur  col-md-3"><a href='.$route->Urlfor('Atweet',["id"=>$tweet->User->id]).'>'.$tweet->User->username.'</a></div>';
            $html .=' <div class="Date offset-md-6 col-md-3">'.$tweet->updated_at.'</div>';
            $html .= '</div>';
            $html .= '</div>';
        } 
         $html .="</div>";
         return $html;  
    }

    private function renderUserTweets(){    
        $data_user = $this->data;
        $html = "<h2>$res->fullname</h2>";
        $html .= '<div class ="row tweet">';
        foreach($data_user->tweets as $tweet){
            $html.= '<div class = "tweeterrow col-md-10 offset-md-1">';      
            $html .='<div class = "row">';
            $html.='<div class="Message col-md-12">'.$tweet->text.'</div>';
            $html.= '<div class="Auteur  col-md-3">'.$data_user->fullname.'</div>';
            $html .=' <div class="Date offset-md-6 col-md-3">'.$tweet->updated_at.'</div>';
            $html .= '</div>';
            $html .= '</div>';
        }
        $html .="</div>";
        return $html;
    }
  
    private function renderViewTweet(){
        $rr = new \mf\router\Router();
        $html = "<h2> Latest Tweets</h2>";
        $tweet = $this->data;
        $user = $requete->user()->first();
        $html .= '<div class ="row tweet">';
        $html.= '<div class = "tweeterrow col-md-10 offset-md-1">';    
        $html .='<div class = "row">';  
        $html.='<div class="Message col-md-12">'.$tweet->text.'</a></div>';
        $html.= '<div class="Auteur  col-md-3"><a href='.$rr->Urlfor('Atweet',["id"=>$user->id]).'>'.$user->fullname.'</a></div>';
        $html .=' <div class="Date offset-md-6 col-md-3">'.$tweet->updated_at.'</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .="</div>";
        return $html;
    }
  
    protected function renderPostTweet(){
    }

    private function renderformlogin(){
        $body = <<<EOT
            <form name=login action="login" method="post"><br>
            Login<input type name="login">
            Password<input type="password" name ="password">
            <input type="submit" value="Connection">
            </form>
EOT;
        return $body;
    }
    
    private function renderFormulaireTweet(){
        $html = <<<EOT
        <form name=registertweeter action="sendt" method="post"><br>
        <textarea name='tweet'>Redigez vous tweet</textarea>
       <input type="submit" value="Create">
        </form>
EOT;
    return $html;
    }

    private function renderFollowers(){
        $route = new \mf\router\Router();
        $followers = $this->data;
        $html = '<div class ="row tweet">';
        foreach($followers as $follower){
            $html .= '<div class = "tweeterrow col-md-10 offset-md-1"><a href='.$route->Urlfor('Atweet',["id"=>$follower->id]).'>'.$follower->fullname.'</a>';
            $html .= '</div>';
        }
        $html .= '</div>';
        return $html;
    }

    private function renderSignUp(){
        $body = <<<EOT
            <form name=signup action="checksignup" method="post"><br>
            <input type="text" name="fullname">
            <input type="text" name="username">
            <input type="password" name="password">
            <input type="submit" value="Create">
EOT;
        return $body;
    }

    protected function renderBody($selector=null){
        $User = new \mf\auth\TweeterAuthentification();
        if($User->logged_in === TRUE){
            $main = $this->renderHeaderUser();
        }
        else{
            $main = $this->renderHeader();
        }

        switch($selector){
        case 'view':
            $main = $this->renderView();
            break;
            
        case 'UserTweets':
            $main .= $this->renderUserTweets();
            break;
            
        case 'renderViewTweet':
            $main .= $this->renderViewTweet();
            break;

         case 'renderFormTweet':
            $main .= $this->renderFormulaireTweet();
            break;

         case 'renderFormLogin':
            $main .= $this->renderFormLogin();
            break;

        case 'renderFollowers':
            $main .= $this->renderFollowers();
            break;
        
        case 'renderSignUp':
            $main .= $this->renderSignUp();
            break;

        default:  
            $main .= $this->renderHome();
            break;
        }
        if($User->logged_in === TRUE){
            $main .= $this->renderButtonNew();
        }
        $main .= $this->renderFooter();
        return $main;
    }
}

