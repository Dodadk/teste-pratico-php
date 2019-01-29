<?php
 /**

* @author Douglas Pierre
* @company BaseTech TI Soluções e Tecnologias
* @mail basetechti@gmail.com
* @packageName Classe de Manipulação da Vendas
* @package v1.0
*/
if($_SERVER['REQUEST_METHOD'] === 'POST'):
	$inc = str_replace("/", DIRECTORY_SEPARATOR, dirname(__FILE__).DIRECTORY_SEPARATOR."Connection.php");
	$inc = str_replace("_controller", "_config",$inc);
	if(file_exists($inc)):
		include_once($inc);
	endif; 	
	$inc =str_replace("_config", "_model", str_replace("Connection", "Vendas", $inc));
	if(file_exists($inc)):
		include_once($inc);
	endif;
endif;
class VendasController extends Vendas
{
	public function __construct(){
		parent::__construct(); 		
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			switch (filter_input(INPUT_POST, "setting")) {
				case 'finishInvoice':
				$this->saveInvoice();
				break;
				case 'saveAddress':
				session_start();
				$_SESSION['sale']["address"] = array(
					"endereco"=> filter_input(INPUT_POST, "endereco"),
					"numero"=>filter_input(INPUT_POST, "numero"),
					"complemento"=>filter_input(INPUT_POST, "complemento"),
					"cep"=>filter_input(INPUT_POST, "cep"),
					"bairro"=>filter_input(INPUT_POST, "bairro"),
					"cidade"=>filter_input(INPUT_POST, "cidade"),
					"uf"=>filter_input(INPUT_POST, "uf"));
				break;
			}

		}
	}

}
if($_SERVER['REQUEST_METHOD'] === 'POST'):
	new VendasController();
endif;