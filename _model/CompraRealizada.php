<?php
/**

* @author Douglas Pierre
* @company BaseTech TI Soluções e Tecnologias
* @mail basetechti@gmail.com
* @packageName Classe de Manipulação de tabelas SQL
* @package v1.0
*/
class CompraRealizada extends Connection
{
	public $Fullname, $Dateofbirth, $NumberInvoice, $PurchaseDate, $address, $SubTotal, $QtsTotal, $table;

	public function viewInvoice(){ 		
		$invoice = $this->prepare("SELECT v.*, v.id vendas_code, ic.*, c.*, c.nome cliente_nome, e.*, p.*, p.id produto_id, p.nome produto_nome, fa.*, fa.nome fabricante_nome, fo.*, fo.nome fornecedor_nome
			FROM vendas v INNER JOIN itemscompras ic ON v.id=ic.Vendas_id INNER JOIN clientes c ON ic.Clientes_id=c.id
			INNER JOIN enderecos_entregas e ON v.Enderecos_Entregas_id=e.id INNER JOIN produtos p ON ic.Produtos_id=p.id
			INNER JOIN fabricantes fa ON p.fabricantes_id=fa.id INNER JOIN fornecedores fo ON p.fornecedores_id=fo.id 
			WHERE v.token = '".UrlAttr."' ");
		$invoice->execute();
		$div = "";

		$table = '<table class="table table-striped table-sm">';
		$table .= '<thead>';
		$table .= '<tr>';
		$table .= '<th>Código</th>';
		$table .= '<th>Item</th>';
		$table .= '<th>Preço</th>';
		$table .= '<th>Quantidade</th>';
		$table .= '<th>Total</th>';
		$table .= ' </tr>';
		$table .= '</thead>';
		$table .= '<tbody>';
		while($k = $invoice->fetch(PDO::FETCH_OBJ)){
			$end = $k->endereco."&nbsp;".$k->numero.($k->complemento==""?"":",&nbsp;".$k->complemento).",&nbsp;".$k->bairro."&nbsp;-&nbsp;".$k->cidade."/".$k->uf."&nbsp;|&nbsp;".$k->cep;
			$this->Fullname = $k->cliente_nome ;	
			$this->Dateofbirth =  date("d/m/Y", strtotime($k->data_nascimento));	
			$this->NumberInvoice = "#".str_pad($k->vendas_code, 5, '0', STR_PAD_LEFT) ;	
			$this->PurchaseDate = date("d/m/Y", strtotime($k->data_venda))." ás ".date("H:i", strtotime($k->data_venda)) ;
			$this->address =  $end;					
			$this->QtsTotal += $k->item_qts;	
			$this->SubTotal = "R$ ".number_format($k->valor_total,2,",",".");	
			$table .= '<tr>';
			$table .= '<td>'."#".str_pad($k->produto_id, 5, '0', STR_PAD_LEFT).'</td>';
			$table .= '<td>'.$k->produto_nome.'<br/>';
			$table .= '<small class="text-wrap">Fabricante:&nbsp;'.$k->fabricante_nome.'&nbsp;-&nbsp;Fornecedor:&nbsp;'.$k->fornecedor_nome.' </small>';
			$table .= '</td>';
			$table .= '<td>R$&nbsp;'.number_format($k->item_valor,2,",",".").'</td>';
			$table .= '<td>'.$k->item_qts.'</td>';
			$table .= '<td>'."R$ ".number_format(($k->item_valor * $k->item_qts),2,",",".").'</td>';
			$table .= '</tr>';

		}		
		$table .= '</tbody>';
		$table .= ' </table>';
		$this->table = $table;
	}

	public function listRows(){
		$Produto = $this->prepare("SELECT * FROM Produtos");
		$Produto->execute();
		return $Produto->rowCount(); 		
	}	
}