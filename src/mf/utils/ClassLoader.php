<?php 
class ClassLoader
{
	private $prefix;

	public function __construct($prefix){
	$this->prefix = $prefix;
	}

	public function loadClass($chaine){
		$pat = str_replace(DIRECTORY_SEPARATOR,"/",$chaine);
		$pat = $this->prefix."/".$pat.".php";
		if(file_exists($pat)){
			require_once($pat);
		}
		else{
			echo "";
		}
	}

	public function register(){
		spl_autoload_register(array($this,'loadClass'));
	}

}

?>