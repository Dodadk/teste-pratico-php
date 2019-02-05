<?php
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
    <title>Vendas - OneHost</title>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="<?=WWWROOT;?>_resources/js/main.js"></script>
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
    <img class="d-block mx-auto mb-4" src="<?=WWWROOT;?>_resources/img/logo_onehost.png">
    <h2>Faça sua compra</h2>
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
            <div id="produts-list">
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
          <button class="btn-next-page-last btn btn-lg btn-success btn-block text-white" disabled>Finalizar Compra <i class="fas fa-shopping-cart"></i></button> 
          <a href="<?=WWWROOT;?>Compras" class="btn btn-lg btn-primary btn-block text-white"><i class="fas fa-arrow-circle-left"></i> Voltar Etapa Anterior
          </a> 
        </div>
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Dados do Cliente</h4>
      <form class="needs-validation" novalidate>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="nome">Nome Completo</label>
            <input type="text" class="form-control" id="NomeCompleto" name="NomeCompleto" placeholder="" value="<?=@$_SESSION['user']['fullname'];?>" required>
            <div class="invalid-feedback">
              O Nome Campo é Obrigatório.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="datadenascimento">Data de Nascimento</label>
            <input type="date" class="form-control" id="DataDeNascimento" name="DataDeNascimento" placeholder="" value="<?=@$_SESSION['user']['dateofbirth'];?>" required>
            <div class="invalid-feedback">
              O Campo Data de Nascimento é Obrigatório.
            </div>
          </div>
        </div>

      <h4 class="mb-3">Endereço de Entrega</h4>
<div class="row">
          <div class="col-md-3">
            <label for="cep">Cep:</label>
            <input type="text" class="form-control" id="cep" name="cep" value="<?=@$_SESSION['sale']["address"]["cep"];?>" placeholder="" required>
            <div class="invalid-feedback">
              O Campo Cep é Obrigatório.
            </div>
          </div>
        <div class="col-md-5">
          <label for="endereço">Endereço</label>
          <input type="text" class="form-control" id="endereco" name="endereco" value="<?=@$_SESSION['sale']["address"]["endereco"];?>" placeholder="" required>
          <div class="invalid-feedback">
            O Campo Endereço é Obrigatório.
          </div>
        </div>
        <div class="col-md-2">
          <label for="numero">Numero</label>
          <input type="text" class="form-control" id="numero" name="numero" value="<?=@$_SESSION['sale']["address"]["numero"];?>" placeholder="" required>
          <div class="invalid-feedback">
            O Campo Endereço é Obrigatório.
          </div>
        </div>
        <div class="col-md-2">
          <label for="complemento">Complemento</label>
          <input type="text" class="form-control" id="complemento" name="complemento" value="<?=@$_SESSION['sale']["address"]["complemento"];?>" placeholder="" required>
          <div class="invalid-feedback">
            O Campo Complemento é Obrigatório.
          </div>
        </div>
</div>
        <div class="row">
          <div class="col-md-4 mb-3">
            <label for="bairro">Bairro</label>
          <input type="text" class="form-control" id="bairro" name="bairro" value="<?=@$_SESSION['sale']["address"]["bairro"];?>" placeholder="" required>
            <div class="invalid-feedback">
            O Campo Cidade é Obrigatório.
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="cidade">Cidade</label>
          <input type="text" class="form-control" id="cidade" name="cidade" value="<?=@$_SESSION['sale']["address"]["cidade"];?>" placeholder="" required>
            <div class="invalid-feedback">
            O Campo Cidade é Obrigatório.
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="uf">UF</label>
          <input type="text" class="form-control" id="uf" name="uf" value="<?=@$_SESSION['sale']["address"]["uf"];?>" placeholder="" required>
            <div class="invalid-feedback">
            O Campo UF é Obrigatório.
            </div>
          </div>
        </div>      
        
        
      </form>
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