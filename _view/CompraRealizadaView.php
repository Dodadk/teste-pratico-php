<?php
$user = $this->iClass("Controller","Login");
$sale = $this->iClass("Controller","CompraRealizada");
$sale->viewInvoice();
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
  <script type="text/javascript" src="_resources/js/main.js"></script>
</head>
<body>
 <body class="bg-light">
   <main role="main" class="container">
    <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm"> 
      <img class="mr-3" src="<?=str_replace($this->Attribute,"",WWWROOT);?>_resources/img/logo_onehost.png" alt=""  height="48">
      <div class="mx-auto text-muted" style='font-size: 18px;font-weight: bold;'>Detalhes da Compra</div>
      <div class="lh-100 text-muted">
        <h6 class="mb-0  lh-100 text-muted">Data de Emissão</h6>
        <small><?=$sale->PurchaseDate;?></small>
      </div>

    </div>

    <div class="my-3 p-3 bg-white rounded shadow-sm">
      <h5 class="border-bottom border-gray pb-2 mb-0">Informações detalhada</h5>
      <div class="media text-muted pt-3">
       <i class="fas fa-user-tag" style="font-size: 32px;margin-right: 5px;"></i>
       <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <div class="container">
          <div class="row justify-content-md-center">
            <div class="col col-sm-8"><span style="font-size: 14px;">
              <strong class="text-gray-dark">Nome Completo:&nbsp;</strong><?=$sale->Fullname;?><br/>
              <strong class="text-gray-dark"">Data de Nascimento:&nbsp;</strong><?=$sale->Dateofbirth;?><br/>
              <strong class="text-gray-dark">Endereço de Entrega</strong><br/><?=$sale->address;?>
            </span>
          </div>
          <div class="col col-sm-4"><span style="font-size: 14px;">
            <strong class="text-gray-dark">Numero do Pedido: </strong><?=$sale->NumberInvoice;?><br/>
            <strong class="text-gray-dark">Data de Compra: </strong><?=$sale->PurchaseDate;?>
          </span>
        </div>
      </div>
    </div>        
  </p>
</div><br><br>
<div class="media text-muted pt-3">
  <div class="table-responsive">
<h5 class=" pb-2 mb-0 text-muted">Produtos</h5>
    <?=$sale->table;?>
  </div>
</div>
<small class="d-block text-right mt-3">
  <h5>Valor total da Compra: <b class="text-danger"><?=$sale->SubTotal;?></b></h5>
</small>
</div>
</main>

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