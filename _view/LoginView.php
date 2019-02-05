<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <title>Login - OneHost</title>   
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="<?=WWWROOT;?>_resources/js/main.js"></script>
  <style>
  .bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
  }

  @media (min-width: 768px) {
    .bd-placeholder-img-lg {
      font-size: 3.5rem;
    }
  }
</style>
<link href="<?=WWWROOT;?>_resources/css/signin.css" rel="stylesheet">
</head>
<body www="<?=WWWROOT;?>">

  <form class="form-signin" onsubmit="return false;">
    <img class="d-block mx-auto mb-4" src="<?=WWWROOT;?>_resources/img/logo_onehost.png">
    <h1 class="h3 mb-3 font-weight-normal text-center">Login OneHost</h1>
    <label for="inputEmail" class="sr-only">Usuario</label>
    <input type="text" id="user" name="user" class="form-control" placeholder="Usuario" style="margin-bottom: 10px;" required autofocus>
    <input type="password" id="passwd" name="passwd" class="form-control" placeholder="Senha" required autofocus>
    <br/>  <div class="alert alert-danger msg-alert" style="display: none;" role="alert"></div>
    <button class="btn-login btn btn-lg btn-primary btn-block">Entrar</button>
    <footer class="my-5 pt-5 text-muted text-center text-small">
      <p class="mb-1">&copy;Copyright 2019  Douglas Pierre</p>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="#">Privacidade</a></li>
        <li class="list-inline-item"><a href="#">Termos</a></li>
        <li class="list-inline-item"><a href="#">Suporte</a></li>
      </ul>
    </footer>
  </form>

  <!-- Scripts do Bootstrap -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>