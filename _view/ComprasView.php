<?php 
$Produtos = $this->iClass("Controller","Produtos");
$user = $this->iClass("Controller","Login");
$arr = @$_SESSION['sale']['products']['item'];
?>

<!doctype html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<title>Compras - OneHost</title>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="<?=WWWROOT;?>_resources/js/main.js"></script>
	<style type="text/css">
	table.Detalhes-Produtos {
		width: 100%;
	}
	table.Detalhes-Produtos td{
		padding: 5px;
	}
	ul.products-list-result li:hover{
		border:1px solid red;
	}
</style>
</head>
<body>
	<body class="bg-light" www="<?=WWWROOT;?>">
		<div class="container" style="max-width: 80%;">
      <div class="d-flex mx-auto">
      <span  class="mx-auto" style="margin-top: 5px;">
        <a href="<?=WWWROOT;?>Compras" class="btn btn-primary text-white">Produtos</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?=WWWROOT;?>Vendas" class="btn btn-primary text-white">Vendas</a>
      </span>
      <span class="mx-auto"  style="margin-top: 5px;"><?=$user->Logout(true);?></span>
    </div>
			<div class="py-5 text-center">
				<img class="d-block mx-auto mb-4" src="<?=WWWROOT;?>_resources/img/logo_onehost.png" alt="">
				<h2>Lista de Produtos</h2>
				<p class="lead">Com a onehost você consegue comprar com facilidade e segurança, pois a onehost trabalha diariamente aperfeiçoando seu sistema com sua equipe para que possamos te fornecer o melhor em conforto e diversidade.</p>
			</div>

			<div class="row">

				<div class="col-md-4 order-md-2 mb-4">
					<h4 class="d-flex justify-content-between align-items-center mb-3">
						<span class="text-muted">Meu Carrinho</span>
						<span class="product-count badge badge-secondary badge-pill" data-count="<?=sizeof(@$arr);?>">Items: <?=sizeof(@$arr);?></span>
					</h4>
					<ul class="list-group mb-3">
						<li id="1" s_hidden="false" class="li-product-hidden list-group-item d-flex justify-content-between lh-condensed bg-white" style="padding-top:25px;padding-bottom: 25px;cursor: pointer;">
								<h6 class="my-0 mx-auto text-center">ESCONDER CARRINHO <i class="fas fa-arrow-circle-up"></i></h6>

						</li>			
					</ul>
					<ul class="product-list-added list-group mb-3">
						<div id="produts-list" count="<?=(sizeof(@$arr)>0 ? sizeof(@$arr) :'0');?>">
						<?php
						//var_dump($_SESSION['products']['item']);
						$subtotal_session = 0;
						for($i=0; $i<sizeof($arr); $i++):
							if(@$arr[$i] != NULL){
							$subtotal_session += (@$arr[$i]['preco'] * @$arr[$i]['qts']); 
							$li = '<li style="cursor:pointer;" id="'.@$arr[$i]['idp'].'" position="'.$i.'" class="li-product-id position-product-'.($i-1).' list-group-item d-flex justify-content-between lh-condensed">';
							$li .= '<div class="text-wrap">';
							$li .= '<h6 class="my-0 text-wrap">'.@$arr[$i]['nome'].'</h6>';
							$li .= '<small class="text-wrap">Fabricante:&nbsp;'.@$arr[$i]['fabricante'].'&nbsp;-&nbsp;Fornecedor:&nbsp;'.@$arr[$i]['fornecedor'].' </small>';
							$li .= '</div>';
							$li .= '<strong class="text-right">'.(@$arr[$i]['qts']>1?'( '.@$arr[$i]['qts']."x )": '').'&nbsp;R$ '.number_format(@$arr[$i]['preco'],2,",",".").'<br><small>Total: R$ '.number_format((@$arr[$i]['preco'] * @$arr[$i]['qts']),2,",",".").'</small></strong>';
							$li .= '</li>';
							echo $li;
						}
							?>	

						<?php endfor; 
						if(sizeof(@$arr) <= 0):		
							?>
							<li id="empity" class=" list-group-item justify-content-between lh-condensed">
								<div>
									<h6 class="text-center" style="font-weight: normal;">Nenhum Item Adicionado !</h6>
								</div>
							</li>
						<?php endif;?>

					</div>
						<li class="product-add-subtotal list-group-item d-flex justify-content-between bg-warning">
							<span><b>SUBTOTAL</b></span>
							<strong>R$ <?=($subtotal_session<=0 ? "0,00" : number_format($subtotal_session,2,",",".")); ?></strong>
						</li>
					</ul>     
					<button class="btn-next-page btn btn-lg btn-primary btn-block" <?=(sizeof($arr)>0?'':'disabled');?>>Proxima Etapa <i class="fas fa-arrow-circle-right"></i></button> 
				</div>

				<div class="col-md-8 order-md-1 text-center">
					<h4 class="d-flex justify-content-between align-items-center mb-3">
						<span class="text-muted  " style="font-weight: bold;">Detalhes do Produto</span>
					</h4>
					<div class="row mb-3 product-detail" style="background-color:#fff;padding: 15px;">
						<div class="col-sm-2 themed-grid-col text-center" style="border: 1px solid rgba(0,0,0,.125);padding: 10px 5px;"><img height="52" src="https://www.asus.com/websites/global/products/wlwpxOCHGKQvVRLb/product_overview.jpg"/></div>
						<div class="col-sm-2 themed-grid-col text-center" style="border: 1px solid rgba(0,0,0,.125);padding: 10px 5px;"><h6 class="my-0">Código</h6>
							<small class="text-muted product-detail-code">#1135</small></div>
							<div class="col-sm-2 themed-grid-col text-center" style="border: 1px solid rgba(0,0,0,.125);padding: 10px 5px;"><h6 class="my-0">Produto</h6>
								<small class="text-muted product-detail-name">Asus M5A97</small></div>
								<div class="col-sm-2 themed-grid-col text-center" style="border: 1px solid rgba(0,0,0,.125);padding: 10px 5px;"><h6 class="my-0">Preço</h6>
									<small class="text-muted product-detail-price">R$ 12,00</small></div>
									<div class="col-sm-2 themed-grid-col text-center" style="border: 1px solid rgba(0,0,0,.125);padding: 10px 5px;"><h6 class="my-0">Fabricante</h6>
										<small class="text-muted product-detail-manufacturer">Asus</small></div>
										<div class="col-sm-2 themed-grid-col text-center" style="border: 1px solid rgba(0,0,0,.125);padding: 10px 5px;"><h6 class="my-0">Fornecedor</h6>
											<small class="text-muted product-detail-provider">All Nations</small></div>
										</div>

										<h4 class="d-flex mx-auto justify-content-between align-items-center">
											<span class="text-muted">Produtos</span>
											<div class="input-group col-sm-6 ">
												<div class="input-group-prepend">
													<span class="input-group-text" id="basic-addon1">Buscar Produto</span>
												</div>
												<input type="text" name="search" class="form-control" aria-describedby="basic-addon1">
											</div>
										</h4>
										
										
										<div class="products-list-result row mb-3 scr align-center">

											<?= $Produtos->Products(); ?>

										</div>

									</div>
								</div>

								<footer class="my-5 pt-5 text-muted text-center text-small">
									<p class="mb-1">&copy; 2019  Douglas Pierre</p>
									<ul class="list-inline">
										<li class="list-inline-item"><a href="#">Privacidade</a></li>
										<li class="list-inline-item"><a href="#">Termos</a></li>
										<li class="list-inline-item"><a href="#">Suporte</a></li>
									</ul>
								</footer>
							</div>

							<!-- Scripts do Bootstrap -->
							<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
							<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
						</body>
						</html>