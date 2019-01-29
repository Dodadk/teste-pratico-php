<?php
 /**
  * 
  */
 class Login extends Connection
 {
 	public $credentialsId = NULL;
 	public $credentialsUser = NULL;
 	public $credentialsPasswd = NULL; 
 	public $credentialsFullname = NULL;
 	public $credentialsDateofbirth = NULL;

 	public function newUser($user=NULL, $passwd=NULL){
 		$new = $this->prepare("INSERT INTO clientes (login,senha) VALUES (?,?)");
 		$new->bindValue(1, $user, PDO::PARAM_STR);
 		$new->bindValue(2, $passwd, PDO::PARAM_STR);
 		if($new->execute()){
 			return true;
 		}else{
 			return false;
 		}
 	}
 	public function SignIn($user=NULL, $passwd=NULL){
 		$new = $this->prepare("SELECT * FROM clientes WHERE login = ? AND senha = ?");
 		$new->bindValue(1, $user, PDO::PARAM_STR);
 		$new->bindValue(2, $passwd, PDO::PARAM_STR);
 		$new->execute();
 		$credentials = $new->fetch(PDO::FETCH_OBJ);
 		$this->credentialsId = @$credentials->id;
 		$this->credentialsUser = @$credentials->login;
 		$this->credentialsPasswd = @$credentials->senha;
 		$this->credentialsFullname = @$credentials->nome;
 		$this->credentialsDateofbirth = @$credentials->data_nascimento;
 		if($new->rowCount()==1){
 			return true;
 		}else{
 			return false;
 		}
 	} 	
 	
 }