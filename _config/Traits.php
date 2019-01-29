<?php
/**

* @author Douglas Pierre
* @company BaseTech TI Soluções e Tecnologias
* @mail basetechti@gmail.com
* @packageName Classe de Manipulação de tabelas SQL
* @package v1.0
*/
 Trait Traits
 {
 	private $AppDir, $AppView, $AppAttribute;
	private $ConfigFolder = "_config/";
	private $ControllerFolder = "_controller/";
	private $ModelFolder = "_model/";
	private $ViewFolder = "_view/";
	private $Instances;
	public $Model, $Controller, $View, $Page, $Attribute;
 	public $Produtos,$Compras,$Vendas,$Fabricante,$Fornecedor,$Login,$Cliente;
 	public function __construct(){
 		/**$this->Instances = [
 			"Model"=>"Produtos"
 		];*/
 		
 	}

 }