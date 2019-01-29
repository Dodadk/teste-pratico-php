<?php
/**

* @author Douglas Pierre
* @company BaseTech TI Soluções e Tecnologias
* @mail basetechti@gmail.com
* @packageName Classe de Manipulação de tabelas SQL
* @package v1.0
*/
class Produtos extends Connection
{
	public $ListProducts, $execute;

	public function Products($Input = NULL){ 		
		$Produto = $this->prepare("SELECT p.*,p.id as ProdutoId, p.nome Produto, fa.*, fa.nome Fabricante, fo.*, fo.nome Fornecedor
			FROM produtos as p INNER JOIN fabricantes as fa ON p.fabricantes_id = fa.id INNER JOIN fornecedores as fo ON p.fornecedores_id=fo.id  WHERE p.nome LIKE '%".$Input."%' or p.referencia LIKE '%".$Input."%' ORDER BY p.preco");
 				$Produto->execute();
 				$div = "";
 				while($k = $Produto->fetch(PDO::FETCH_OBJ)){
 					$div .= '
 					<div class="list-product card mx-auto themed-grid-col text-center" style="padding: 10px;margin: 5px; width: 12rem;">
 					<img src="'.$k->img.'" height="168" class="card-img-top" alt="">
 					<div class="card-body">
 					<div>
 					<h6 class="my-0">'.$k->Produto.'</h6>
 					<span class="text-success product-price" style="font-size: 18px;font-weight: bold;">R$ '.number_format($k->preco,2,",",".").'</span>
 					<product'.$k->ProdutoId.' style="display:none;">'.$k->ProdutoId.'</product'.$k->ProdutoId.'>
 					<span class="text-success product-id" style="display:none;">'.$k->ProdutoId.'</span>
 					<span class="text-success product-code" style="display:none;">'.$k->referencia.'</span>
 					<span class="text-success product-provider" style="display:none;">'.$k->Fornecedor.'</span>
 					<span class="text-success product-manufacturer" style="display:none;">'.$k->Fabricante.'</span>
 					
 					</div>
 					</div>
 					<div class="container">
 					<div class="row">
 					<div class="col-sm">
 					<div class="d-inline-block text-justify badge badge-light align-middle  justify-content-center" style="margin-bottom:5px;margin-top:-5px;">
 					 <table>
 					 <style type="text/css">
						i.fa-minus-square:hover, i.fa-plus-square:hover{
							cursor:pointer;
							color:#28a745;
							text-color:#28a745;
						}
 					 </style>
 					 	<tr>
 					 		<td><a class="btn-qts-product" id="decrease"><i class="fas fa-minus-square" style="font-size:18px;margin:5px;"></i></a></td>
 					 		<td><a class="a-qts-product" class="d-inline-block align-middle" style="font-size:14px;margin:5px;">1</a></td>
 					 		<td><a class="btn-qts-product" id="increase"><i class="fas fa-plus-square" style="font-size:18px;margin:5px;"></i></a></td>
 					 	</tr>
 					 </table>	
 					</div>
 					<a style="color:white;text-color:white;" class="product-add-list btn btn-success">Adicionar&nbsp;<i class="fas fa-plus-circle"></i></a>
 					</div>
 					</div>
 					</div>
 					</div>';
 				}if($Produto->rowCount() <= 0){
 					$div = '<div class="py-5 text-center">
				<h3>-{ Sem Resultado }-</h3>
				<p class="lead">Não conseguimos encontrar nenhum produto em nosso estoque com referência na sua busca.</p>
			</div>';
 				}

 				echo $div;
	}

	public function listRows(){
		$Produto = $this->prepare("SELECT * FROM Produtos");
		$Produto->execute();
		return $Produto->rowCount(); 		
	}	
}