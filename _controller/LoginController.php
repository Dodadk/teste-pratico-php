<?php
 /**
  * 
  */
 if($_SERVER['REQUEST_METHOD'] === 'POST'):
 	$inc = str_replace("/", DIRECTORY_SEPARATOR, dirname(__FILE__).DIRECTORY_SEPARATOR."Connection.php");
 	$inc = str_replace("_controller", "_config",$inc);
 	if(file_exists($inc)):
 		include_once($inc);
 	endif; 	
 	$inc =str_replace("_config", "_model", str_replace("Connection", "Login", $inc));
 	if(file_exists($inc)):
 		include_once($inc);
 	endif;
 endif;
 class LoginController extends Login
 {
 	public function __construct(){
 		parent::__construct();
 		if($_SERVER['REQUEST_METHOD'] === 'POST'){

 			switch (filter_input(INPUT_POST, "setting")) {
 				case 'SignIn':
 				echo $this->checkaccess(false,true,true);
 				break;
 				case 'Logout':
 				echo $this->Logout(false,true);
 				break;
 				
 			}

 		}
 	}
 	public function Logout($text=false,$json=false,$redirect=false){
 		if($text==true){
 			echo 'Olá <b>'.$_SESSION['user']['fullname'].'</b> Bem Vindo&nbsp;&nbsp;   
 			<a class="btn-logout btn btn-success text-white">Sair</a>';
 		}else{
 			session_start();
 			session_destroy();
 			if($redirect==true){
 				header("Location: Login");
 			}elseif($json==true){
 				return json_encode(array("response"=> "unlogged"));
 			}
 		}
 	}
 	public function checkaccess($loadinSessiong = false, $createSession=false, $json=false,$redirect = false){
 		$response = null;
 		if($loadinSessiong == true){
 			$response = $this->SignIn(@$_SESSION['user']['user'], @$_SESSION['user']['passwd']);
 		}else{
 			$response = $this->SignIn(filter_input(INPUT_POST, "user"), filter_input(INPUT_POST, "passwd"));
 		}
 		if($createSession == true){
 			session_start(); 			
 			$_SESSION['user']['ids'] = $this->credentialsId;
 			$_SESSION['user']['user'] = $this->credentialsUser;
 			$_SESSION['user']['passwd'] = $this->credentialsPasswd;
 			$_SESSION['user']['fullname'] = $this->credentialsFullname;
 			$_SESSION['user']['dateofbirth'] = $this->credentialsDateofbirth; 			
 		}
 		if($redirect == true){
 			if($response){
 				header("Location: Vendas");
 			}else{
 				header("Location: Login");
 			}
 		}elseif($json == true){
 			return json_encode(array("response"=>($response == true? "authorized" : "unauthorized")));
 		}else{
 			return $response;
 		}

 	}
 	
 }
 if($_SERVER['REQUEST_METHOD'] === 'POST'){
 	$user = new LoginController();
 }