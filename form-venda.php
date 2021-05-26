<?php
include "./Conexao.php";

$oConn = new Conexao();
$oConn->setConexao();

$sSql = "SELECT P.DESCRICAO
                , P.VALOR_UNITARIO
                , P.ESTOQUE
                , P.COD_BARRAS
                , P.ID
           FROM PRODUTO P
          WHERE P.EXCLUIDO = 'N'";
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
  <title>Venda</title>
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
                  <a href="./produtos.php" class="nav-link"><i class="fe fe-package"></i> Produtos</a>
                </li>
                <li class="nav-item">
                  <a href="./form-produto.php" class="nav-link active"><i class="fe fe-dollar-sign"></i> Venda</a>
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
                  <h3 class="card-title">Realizar venda de um produto</h3>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-label">Produto</label>
                        <select class="form-control custom-select">
                          <?php for ($i = 0; $i < sizeof($aProdutos); $i++) { ?>
                            <option value="<?php echo $aProdutos[$i]["ID"] ?>"><?php echo $aProdutos[$i]["DESCRICAO"] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Quantidade</label>
                        <input id="quantidade" data-estoquedisp="<?php echo $aProdutos[0]["ESTOQUE"]; ?>" type="number" class="form-control" placeholder="Digite aqui a quantidade">
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Valor unitário</label>
                        <div class="input-group">
                          <span class="input-group-prepend">
                            <span class="input-group-text">R$</span>
                          </span>
                          <input id="valor_unitario" type="text" class="form-control text-right" value="<?php echo number_format($aProdutos[0]["VALOR_UNITARIO"], 2, ',', '.'); ?>" aria-label="Valor">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Valor total</label>
                        <div class="input-group">
                          <span class="input-group-prepend">
                            <span class="input-group-text">R$</span>
                          </span>
                          <input id="valor_total" type="text" class="form-control text-right" aria-label="Valor" disabled="disabled" title="Este campo não pode ser alterado">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-12">
                      <div class="form-group">
                        <div class="form-label">&nbsp;</div>
                        <div class="custom-controls-stacked">
                          <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input checkbox" name="example-checkbox1" value="option1" checked>
                            <span class="custom-control-label">Atualizar valor unitário do produto</span>
                          </label>
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
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="my-3 my-md-5">
        <div class="container">
          <div class="row row-cards row-deck">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Últimas vendas realizadas</h3>
                </div>
                <div class="table-responsive">
                  <table class="table card-table table-vcenter text-nowrap">
                    <thead>
                      <tr>
                        <th class="w-1">#</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Valor unitário</th>
                        <th>Valor total da venda</th>
                      </tr>
                    </thead>
                    <tbody class="tabela-vendas">
                      <?php
                      $sSql = "SELECT V.ID AS ID_VENDA
                                      , V.ID_PRODUTO AS ID_RODUTO
                                      , P.DESCRICAO
                                      , V.QUANTIDADE
                                      , V.VALOR_TOTAL
                                 FROM VENDA V 
                                 JOIN PRODUTO P 
                                   ON P.ID = V.ID_PRODUTO";
                      $oConn->query($sSql);

                      $aVendas = $oConn->getArrayResults();

                      for ($i = 0; $i < sizeof($aVendas); $i++) { ?>
                        <tr>
                          <td><span class="text-muted"><?php echo $aVendas[$i]["ID_VENDA"]; ?></span></td>
                          <td><?php echo $aVendas[$i]["DESCRICAO"]; ?></td>
                          <td><?php echo $aVendas[$i]["QUANTIDADE"]; ?></td>
                          <td>R$ <?php echo number_format(($aVendas[$i]["VALOR_TOTAL"]/$aVendas[$i]["QUANTIDADE"]), 2, ',', '.'); ?></td>
                          <td>R$ <?php echo number_format($aVendas[$i]["VALOR_TOTAL"], 2, ',', '.'); ?></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
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

      $('#quantidade').on("keyup", function() {
        calculaValorTotal();
      });

      $('#valor_unitario').on("keyup", function() {        
        calculaValorTotal();
      });

      $('.checkbox').click(function() {
        if ($(this).prop("checked")) {
          $('#valor_unitario').prop('disabled', false);
        } else {
          $('#valor_unitario').prop('disabled', true);
        }
      });      

      $('.custom-select').change(function(e) {
        e.preventDefault();

        var id_produto = $(".custom-select option:selected").val();

        $.ajax({
          url: 'ajax/produto.php',
          type: 'GET',
          contentType: 'application/x-www-form-urlencoded; charset=utf-8',
          dataType: 'json',
          data: {
            id_produto: id_produto,
            action: "select"
          },
          success: function(data) {
            var valor_unitario = parseFloat(data[0].VALOR_UNITARIO);
            var quantidade_disponivel = data[0].ESTOQUE;

            $('#valor_unitario').val(String(valor_unitario.toLocaleString('pt-br', {
              minimumFractionDigits: 2
            })));
          }
        });
      });

      $('.submit-row button').click(function(e) {
        e.preventDefault();
        
        var quantidade = $("#quantidade").val();
        var valor_total = $("#valor_total").val();
        var valor_unitario = $("#valor_unitario").val();
        var id_produto = $(".custom-select option:selected").val();
        var edit_valor_unitario = String($(".checkbox").is(':checked'));        
        var quantidade_disponivel = $('#quantidade').data('estoquedisp');;

        if (parseInt(quantidade) > quantidade_disponivel) {
          $(".alert-danger").text("A quantidade disponível é de " + quantidade_disponivel).slideDown();

          setTimeout(function() {
            $(".alert-danger").fadeOut();
          }, 5000);
        } else if (parseInt(quantidade) < 0) {
          $(".alert-danger").text("Não é possível realizar uma venda com quantidade negativa").slideDown();

          setTimeout(function() {
            $(".alert-danger").fadeOut();
          }, 5000);
        } else {
          $.ajax({
            url: 'ajax/venda.php',
            type: 'POST',
            contentType: 'application/x-www-form-urlencoded; charset=utf-8',
            dataType: 'json',
            data: {
              id_produto: id_produto,
              valor_unitario: valor_unitario,
              quantidade: quantidade,
              quantidade_disponivel: quantidade_disponivel,
              valor_total: valor_total,
              edit_valor_unitario: edit_valor_unitario,
              action: "save"
            },
            success: function(data) {
              if (data.status) {
                $(".alert-success").text("Venda cadastrada com sucesso.").slideDown();
                $("#quantidade").val("");
                $("#valor_total").val("");
                carregaTabela();
              } else {
                $(".alert-danger").text("Não foi possível efetuar o cadastro da venda.").slideDown();
              }
              setTimeout(function() {
                $(".alert-success").fadeOut();
                $(".alert-danger").fadeOut();
              }, 5000);
            }
          });
        }
      });   
      
      function carregaTabela() {
        $.ajax({
          url: 'ajax/venda.php',
          type: 'POST',
          contentType: 'application/x-www-form-urlencoded; charset=utf-8',
          dataType: 'json',
          data: {
            action: "select_all"
          },
          success: function(data) {
            if (data.status) {
              $('.tabela-vendas').html(data.tabela);
            }
          }
        });
      }

      function calculaValorTotal() {
        var quantidade = parseInt($("#quantidade").val());
        var valor_unitario = parseFloat(($("#valor_unitario").val().replace('.','')).replace(',', '.'));

        if ($('#quantidade').val() == '') {
          $("#valor_total").val('');
        } else if ($("#valor_unitario").val() == '') {
          $("#valor_total").val('');
        } else {
          var valor_total_calc = quantidade * valor_unitario;

          $("#valor_total").val(String(valor_total_calc.toLocaleString('pt-br', {
            minimumFractionDigits: 2
          })));
        }

      }
    });
  </script>
</body>

</html>