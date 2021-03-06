<?php
include "./Conexao.php";

$oConn = new Conexao();
$oConn->setConexao();

$sSql = "SELECT P.DESCRICAO
                , P.VALOR_UNITARIO
                , P.ESTOQUE
                , P.COD_BARRAS
           FROM PRODUTO P
          WHERE P.COD_BARRAS = %s";
$sSql = sprintf($sSql, $_GET["cod_barras"]);
$oConn->query($sSql);

$aProdutos = $oConn->getArrayResults();
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Content-Language" content="pt-br" />
  <meta name="msapplication-TileColor" content="#2d89ef">
  <meta name="theme-color" content="#4188c9">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <link rel="icon" href="./favicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
  <!-- Generated: 2018-04-16 09:29:05 +0200 -->
  <title>Novo produto</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
  <script src="./assets/js/require.min.js"></script>
  <script>
    requirejs.config({
      baseUrl: '.'
    });
  </script>
  <!-- Dashboard Core -->
  <link href="./assets/css/dashboard.css" rel="stylesheet" />
  <script src="./assets/js/dashboard.js"></script>
  <!-- c3.js Charts Plugin -->
  <link href="./assets/plugins/charts-c3/plugin.css" rel="stylesheet" />
  <script src="./assets/plugins/charts-c3/plugin.js"></script>
  <!-- Google Maps Plugin -->
  <link href="./assets/plugins/maps-google/plugin.css" rel="stylesheet" />
  <script src="./assets/plugins/maps-google/plugin.js"></script>
  <!-- Input Mask Plugin -->
  <script src="./assets/plugins/input-mask/plugin.js"></script>
  <script src="./assets/js/vendors/jquery-3.2.1.min.js"></script>
</head>

<body class="">
  <div class="page">
    <div class="page-main">
      <div class="header py-4">
        <div class="container">
          <div class="d-flex">
            <a class="header-brand" href="./index.html">
              <img src="./demo/brand/tabler.svg" class="header-brand-img" alt="tabler logo">
            </a>
            <div class="d-flex order-lg-2 ml-auto">
              <div>
                <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                  <span class="avatar" style="background-image: url(./demo/faces/female/25.jpg)"></span>
                  <span class="ml-2 d-none d-lg-block">
                    <span class="text-default">Jane Pearson</span>
                    <small class="text-muted d-block mt-1">Administrator</small>
                  </span>
                </a>
              </div>
            </div>
            <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
              <span class="header-toggler-icon"></span>
            </a>
          </div>
        </div>
      </div>
      <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-3 ml-auto">
              <form class="input-icon my-3 my-lg-0">
                <input type="search" class="form-control header-search" placeholder="Search&hellip;" tabindex="1">
                <div class="input-icon-addon">
                  <i class="fe fe-search"></i>
                </div>
              </form>
            </div>
            <div class="col-lg order-lg-first">
              <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                <li class="nav-item">
                  <a href="./index.php" class="nav-link"><i class="fe fe-home"></i> Home</a>
                </li>
                <li class="nav-item">
                  <a href="./produtos.php" class="nav-link active"><i class="fe fe-package"></i> Produtos</a>
                </li>
                <li class="nav-item">
                  <a href="./form-venda.php" class="nav-link"><i class="fe fe-dollar-sign"></i> Venda</a>
                </li>
                <li class="nav-item">
                  <a href="./produtos-excluidos.php" class="nav-link"><i class="fe fe-trash"></i> Lixeira</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="my-3 my-md-5">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <form class="card">
                <div class="alert alert-icon alert-success" role="alert">
                  <i class="fe fe-check mr-2" aria-hidden="true"></i>
                </div>
                <div class="alert alert-icon alert-danger" role="alert">
                  <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i>
                </div>
                <div class="card-body">
                  <h3 class="card-title">Editar produto - <?php echo $aProdutos[0]["DESCRICAO"]; ?></h3>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-label">Descri????o</label>
                        <input id="descricao" type="text" class="form-control" name="example-text-input" placeholder="Arroz.." value="<?php echo $aProdutos[0]["DESCRICAO"]; ?>">
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Estoque</label>
                        <input id="estoque" type="number" class="form-control" placeholder="10.." value="<?php echo $aProdutos[0]["ESTOQUE"]; ?>">
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">C??digo de barras</label>
                        <input id="cod_barras" type="number" class="form-control" value="<?php echo $aProdutos[0]["COD_BARRAS"]; ?>" disabled>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Valor unit??rio</label>
                        <div class="input-group">
                          <span class="input-group-prepend">
                            <span class="input-group-text">R$</span>
                          </span>
                          <input id="valor_unitario" type="text" class="form-control text-right" aria-label="Valor" value="<?php echo number_format($aProdutos[0]["VALOR_UNITARIO"], 2, ',', '.'); ?>">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-left" style="display: flex; justify-content: space-between">
                  <div>
                    <a href="./produtos.php" class="btn btn-secondary">Voltar para produtos</a>
                  </div>
                  <div class="submit-row">
                    <button type="submit" class="btn btn-primary">Confirmar altera????o</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $(".alert-success").hide();
      $(".alert-danger").hide();

      $('.submit-row button').click(function(e) {
        e.preventDefault();

        var descricao = $("#descricao").val();
        var estoque = $("#estoque").val();
        var valor_unitario = $("#valor_unitario").val();
        var cod_barras = $("#cod_barras").val();

        $.ajax({
          url: 'ajax/produto.php',
          type: 'POST',
          contentType: 'application/x-www-form-urlencoded; charset=utf-8',
          dataType: 'json',
          data: {
            descricao: descricao,
            valor_unitario: valor_unitario,
            estoque: estoque,
            cod_barras: cod_barras,
            action: "edit"
          },
          success: function(data) {
            if (data.status) {
              $(".alert-success").text("Produto alterado com sucesso!").slideDown();
            } else {
              $(".alert-danger").text("N??o foi poss??vel alterar o produto").slideDown();
            }

            setTimeout(function() {
              $(".alert-success").fadeOut();
              $(".alert-danger").fadeOut();
            }, 3000);
          }
        });
      });
    });
  </script>
</body>

</html>