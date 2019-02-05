<?php
 /**

* @author Douglas Pierre
* @company BaseTech TI Soluções e Tecnologias
* @mail basetechti@gmail.com
* @packageName Classe de Manipulação de tabelas SQL
* @package v1.0
*/
class Vendas extends Connection
{
	public function saveInvoice(){
		session_start();
		$complete = false;
		$token = md5(@$_SESSION['user']['ids'].@$_SESSION['user']['fullname'].round(date("YmdHis")).date("YmdHis"));
		$save = $this->prepare("INSERT INTO enderecos_entregas (endereco,numero,complemento,cep,bairro,cidade,uf,token) 
			VALUES (?,?,?,?,?,?,?,?) ");
		$save1=$save->execute(array(
			filter_input(INPUT_POST, "endereco"),
			filter_input(INPUT_POST, "numero"),
			filter_input(INPUT_POST, "complemento"),
			filter_input(INPUT_POST, "cep"),
			filter_input(INPUT_POST, "bairro"),
			filter_input(INPUT_POST, "cidade"),
			filter_input(INPUT_POST, "uf"),
			$token,
		));
		$save = $this->prepare("INSERT INTO vendas (Enderecos_Entregas_id, valor_total, data_venda, token) 
			VALUES ((SELECT id FROM enderecos_entregas WHERE token = '".$token."'),?,NOW(),?) ");
		$save2=$save->execute(array($_SESSION['sale']['products']['subtotal'],$token));

		for($i=0;$i<sizeof(@$_SESSION['sale']['products']['item']); ++$i){	
			$arr = @$_SESSION['sale']['products']['item'][$i];
			if($arr != NULL){
				$save = $this->prepare("INSERT INTO itemscompras (Clientes_id, Vendas_id, Produtos_id, item_qts, item_valor, DataDeCompra) 
					VALUES (?, (SELECT id FROM vendas WHERE token = '".$token."'), ? , ?, ?, NOW())");
				$save3=$save->execute(array(@$_SESSION['user']['ids'], $arr['idp'], $arr['qts'], $arr['preco']));
				$complete = true;
				
			}

		}if($complete)$_SESSION['sale'] = NULL;
		echo json_encode(array("response"=>(!$save1 || !$save2 || !$save3 ? "fail" : "success"),"token"=>$token));
	}

}