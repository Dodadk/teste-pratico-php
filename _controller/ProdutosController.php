<?php
 /**

* @author Douglas Pierre
* @company BaseTech TI Soluções e Tecnologias
* @mail basetechti@gmail.com
* @packageName Classe de Manipulação da View
* @package v1.0
*/
if($_SERVER['REQUEST_METHOD'] === 'POST'):
	$inc = str_replace("/", DIRECTORY_SEPARATOR, dirname(__FILE__).DIRECTORY_SEPARATOR."Connection.php");
	$inc = str_replace("_controller", "_config",$inc);
	if(file_exists($inc)):
		include_once($inc);
	endif; 	
	$inc =str_replace("_config", "_model", str_replace("Connection", "Produtos", $inc));
	if(file_exists($inc)):
		include_once($inc);
	endif;
endif;
class ProdutosController extends Produtos
{
	public function __construct(){
		parent::__construct(); 		
		if($_SERVER['REQUEST_METHOD'] === 'POST'):
			$iSearch = filter_input(INPUT_POST, "search");
			switch (filter_input(INPUT_POST, "setting")) {
				case 'Search':
				$this->Products($iSearch);
				break;
				case 'saveProducts':
				$id = filter_input(INPUT_POST, "id");
				session_start();
				$_SESSION['sale']['products']['item'][] = array(
					'idp' =>$id,
					'cod' =>filter_input(INPUT_POST, "code"),
					'nome' =>filter_input(INPUT_POST, "name"),
					'qts' =>filter_input(INPUT_POST, "qts"),
					'preco' =>filter_input(INPUT_POST, "price"),
					'fabricante' =>filter_input(INPUT_POST, "manufacturer"),
					'fornecedor' =>filter_input(INPUT_POST, "provider")
				);
				$_SESSION['sale']['products']['subtotal'] = filter_input(INPUT_POST, "subtotal");
				if(sizeof(@$_SESSION['sale']['products']['item'])>0){
					echo json_encode(array("response" => "success"));
				}
				break;
				case 'readSessionProducts':
					echo json_encode(
					array("response"=>'success',"Items"=>$this->readSessionProducts())
					);
					break;
				case 'deleteProducts':
				$id = filter_input(INPUT_POST, "id");
				echo json_encode(
					array("response"=>'success',"Items"=>$this->readSessionProducts(true, $id))
				);
				break;
			}
		endif;
	}
	public function readSessionProducts($saveSession=true, $deleteSession=NULL){
		session_start();
		if($deleteSession!=NULL){			
			@$_SESSION['sale']['products']['item'][$deleteSession] = NULL;
		}
		$subtotal = 0;
		for($i=0;$i<sizeof(@$_SESSION['sale']['products']['item']); ++$i){			
			$arr = $_SESSION['sale']['products']['item'][$i];
			if($arr != NULL){
				$subtotal += ($arr['preco'] * $arr['qts']);
				$newArr['item'][] = array(
					'idp' =>$arr['idp'],
					'cod' =>$arr['cod'],
					'nome' =>$arr['nome'],
					'qts' =>$arr['qts'],
					'preco' =>$arr['preco'],
					'fabricante' =>$arr['fabricante'],
					'fornecedor' =>$arr['fornecedor']
				);
			}
		}
		$newArr['subtotal'] = $subtotal;
		$newArr['countItems'] = sizeof(@$_SESSION['sale']['products']['item']);
		if($saveSession==true){
			$_SESSION['sale']['products'] = $newArr;
		}
		return $newArr;
	}

}
if($_SERVER['REQUEST_METHOD'] === 'POST'):
	new ProdutosController();
endif;