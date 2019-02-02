<?php 

namespace mf\router;

class Router extends AbstractRouter{
	public function __construct()
	{parent::__construct();}

	public function run(){
		$Utilisateur = new \mf\auth\Authentification;
		if(!isset($_SERVER['PATH_INFO'])){
			$this->executeRoute('All');
		}

		else{
		$path_info = $this->http_req->path_info = $_SERVER['PATH_INFO'];
			foreach(self::$routes as $name => $array){
			
				if ($path_info === $name  and $Utilisateur->checkAccessRight($array[2]) === TRUE ){
					$classe = $array[0];
					$methode = $array[1];
					$classeIns = new $classe();
					return $classeIns->$methode();}
				}
			$this->executeRoute('All');
			}
		}

	public static function executeRoute($string){
		foreach(self::$aliases as $alias => $url){
			if ($alias === $string){
				foreach(self::$routes as $name => $array){
					if($url === $name){
						$classe = $array[0];
						$methode = $array[1];
						$classeIns = new $classe();
						return $classeIns->$methode();}
					}
				}		
			}	
		}

	public  function urlFor($route_name,$param_list=[]){
	foreach(self::$aliases as $alias => $url){
		
			if ($alias === $route_name){
				foreach(self::$routes as $nameroute => $tab){
					if($url === $nameroute){
						if(!empty($param_list)){
							foreach($param_list as $name => $valeur){
								$_GET[$name] = $valeur;							
								$url_return = $_SERVER['SCRIPT_NAME'].$nameroute."?".$name."=".$_GET[$name];	
								return $url; 
							}
						}
						else{
					$url_return = $_SERVER['SCRIPT_NAME'].$nameroute;
					return $url_return;
						}	
					}
				}
			}	
		}
	}

	public function setDefaultRoute($url){	
		self::$aliases += ['Default' => $url];
	}
	public function addRoute($name, $url, $ctrl, $mth,$level){
		$tableau = [$ctrl,$mth,$level];
		self::$routes[$url] = $tableau;
		self::$aliases += [$name => $url];
	}

}