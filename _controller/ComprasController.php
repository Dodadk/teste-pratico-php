<?php
 /**
  * 
  */
 class ComprasController
 {	

 		use Traits;
 		
 		public function ListProducts(){
 			include_once("_model/Produtos.php");
 			$product = new Produtos();
 			return $product->fetch();
 		}
 	
 }