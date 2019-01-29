<?php
/**

* @author Douglas Pierre
* @company BaseTech TI Soluções e Tecnologias
* @mail basetechti@gmail.com
* @packageName Classe de Auto Construção de Paginas
* @package v1.0
*/
$PageView = filter_input(INPUT_GET, "view");	
$View = explode("/", $PageView);
define("WWWROOT",str_replace($View[0],"","http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"));
define("UrlPage",@$View[0]);
define("UrlAttr",@$View[1]);
class Constructor 
{	

	private $AppDir, $AppView, $AppAttribute;
	private $ConfigFolder = "_config/";
	private $ControllerFolder = "_controller/";
	private $ModelFolder = "_model/";
	private $ViewFolder = "_view/";
	public $Model, $Controller, $View, $Page, $Attribute;
	
	public function __construct()
	{
		$this->AppDir = dirname(__FILE__);
		
		$this->AppPage();
		

	}
	public function AppPage(){
		$PageView = filter_input(INPUT_GET, "view");	
		$View = explode("/", $PageView);
		$this->Page = $View[0];
		$this->Attribute = @$View[1];
		if(empty($this->Page)){
			$index = str_replace("/", DIRECTORY_SEPARATOR, 
				$this->AppDir.DIRECTORY_SEPARATOR.$this->ViewFolder."VendasView.php");
			if(file_exists($index)){
				include_once($index);
			}else{
				include_once("Error404.html");
			}
		}else{
			include_once("_model/Login.php");
			include_once("_controller/LoginController.php");
			$user = new LoginController();
			if($user->checkaccess(true,false) == true){
				$this->__autoload($this->Page);
				$this->Model = new $this->Page();
			}else{
			$View = str_replace("/", DIRECTORY_SEPARATOR, $this->AppDir.DIRECTORY_SEPARATOR.$this->ViewFolder."LoginView.php");
				if(file_exists($View)):
					include_once($View);
				else:			
					echo "<div>O Arquivo de Views: <b style='color:red;text-color:red;'>( ".$View. " ) </b> não encontrado por favor contate o administrador do sistema.</div>";
				endif;
			}
		}
	}
	public function __autoload($fileClass){
		$Traits = str_replace("/", DIRECTORY_SEPARATOR, $this->AppDir.DIRECTORY_SEPARATOR.$this->ConfigFolder."Traits.php");
		$View = str_replace("/", DIRECTORY_SEPARATOR, $this->AppDir.DIRECTORY_SEPARATOR.$this->ViewFolder.$fileClass."View.php");
		$Controller = str_replace("/", DIRECTORY_SEPARATOR, $this->AppDir.DIRECTORY_SEPARATOR.$this->ControllerFolder.$fileClass."Controller.php");
		$Model = str_replace("/", DIRECTORY_SEPARATOR, $this->AppDir.DIRECTORY_SEPARATOR.$this->ModelFolder.$fileClass.".php");

		if(file_exists($Traits)):
			include_once($Traits);
		else:			
			echo "<div>O Arquivo do Traços: <b style='color:red;text-color:red;'>( ".$Traits. " ) </b> não encontrado por favor contate o administrador do sistema.</div>";
		endif;
		if(file_exists($Model)):
			include_once($Model);
			//$this->Model = new $this->Page();
		else:			
			echo "<div>O Arquivo do Modulo: <b style='color:red;text-color:red;'>( ".$Model. " ) </b> não encontrado por favor contate o administrador do sistema.</div>";
		endif;
		if(file_exists($Controller)):
			include_once($Controller);
			$ctl = $this->Page."Controller";
			$this->Controller = new $ctl();
		else:			
			echo "<div>O Arquivo de Controle: <b style='color:red;text-color:red;'>( ".$Controller. " ) </b> não encontrado por favor contate o administrador do sistema.</div>";
		endif;
		if(file_exists($View)):
			include_once($View);
		else:			
			echo "<div>O Arquivo de Views: <b style='color:red;text-color:red;'>( ".$View. " ) </b> não encontrado por favor contate o administrador do sistema.</div>";
		endif;
	}
	public function iClass($type, $fileClass){
		$Controller = str_replace("/", DIRECTORY_SEPARATOR, $this->AppDir.DIRECTORY_SEPARATOR.$this->ControllerFolder.$fileClass."Controller.php");
		$Model = str_replace("/", DIRECTORY_SEPARATOR, $this->AppDir.DIRECTORY_SEPARATOR.$this->ModelFolder.$fileClass.".php");
		if(file_exists($Model)):
			include_once($Model);
			$this->Model = new $fileClass();
		endif;
		if(file_exists($Controller)):
			include_once($Controller);
			$ctl = $fileClass."Controller";
			$this->Controller = new $ctl();
		endif;
		return (strtolower($type)==strtolower("Model")?$this->Model : $this->Controller);

	}

}