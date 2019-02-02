<?php

namespace mf\view;

abstract class AbstractView {

    static protected $style_sheets = []; /* un tableau de fichiers style */
    static protected $app_title    = "MF app Title"; /* un titre de document */
    protected $data        = null; /* le modÃ¨le de donnÃ©es nÃ©cessaire */
    
    public function __construct($data){
        $this->data = $data;
    }
    
    static public function addStyleSheet($path_to_css_files){
        self::$style_sheets[] = $path_to_css_files;
    }

    static public function setAppTitle($title){
        self::$app_title = $title;
    }

    abstract protected function renderBody($selector=null);

    public function render($selector){

        $title = self::$app_title;
        $app_root = (new \mf\utils\HttpRequest())->root;
       //$this->addStyleSheet('html/style.css');
       //$this->addStyleSheet('html/style-project.css');
       //$this->addStyleSheet('html/php-code.css');
          $this->addStyleSheet('html/pierre.css');
        $styles = '';
        foreach ( self::$style_sheets as $file )
            $lien =$file;
            $de = "/html/pierre.css";
            $styles .= '<link rel="stylesheet" href="/iut/tweeter/html/pierre.css" ';
            $body = $this->renderBody($selector);
            $html = <<<EOT
            <!doctype html>
            <html>
            <head>    
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
                    ${styles}
            </head>
            <body>
                ${body}
                </div>
            </body>
            </html>
EOT;
        echo $html;
    }
    
}