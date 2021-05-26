<?php
include "../Conexao.php";

$oConn = new Conexao();
$oConn->setConexao();
$retorno = null;

if (isset($_POST["action"])) {
  if ($_POST["action"] == 'save') {

    $sSql = "INSERT INTO VENDA (DATA, VALOR_TOTAL, ID_PRODUTO, QUANTIDADE) 
                  VALUES ('%s', %s, %s, %s)";
    
    $sSql = sprintf($sSql
                    , date('Y-m-d')
                    , str_replace(',', '.', str_replace('.', '', $_POST["valor_total"]))
                    , $_POST["id_produto"]
                    , $_POST["quantidade"]
    );
    
    $retorno = $oConn->query($sSql, true);

    if ($retorno != '') {
      $resposta['status'] = true;

      $iQuantidade = (int) $_POST["quantidade_disponivel"] - (int) $_POST["quantidade"];
      
      if ($_POST["edit_valor_unitario"] == 'true') {
        $sSqlUpdade = "UPDATE PRODUTO 
                          SET VALOR_UNITARIO = %s 
                              , ESTOQUE = %s
                        WHERE ID = %s";

        $sSqlUpdade = sprintf(
          $sSqlUpdade,
          str_replace(',', '.', str_replace('.', '', $_POST["valor_unitario"])),
          $iQuantidade,
          $_POST["id_produto"]
        );
      } else {
        $sSqlUpdade = "UPDATE PRODUTO 
                          SET ESTOQUE = %s
                        WHERE ID = %s";

        $sSqlUpdade = sprintf($sSqlUpdade
                              , $iQuantidade
                              , $_POST["id_produto"]
        );
      }

      $retornoUpdate = $oConn->query($sSqlUpdade, true);

      if ($retornoUpdate != '') {
        $resposta['status_update'] = true;
      } else {
        $resposta['status_update'] = false;
      }
    } else {
      $resposta['status'] = false;
    }

  } elseif ($_POST['action'] == 'select_all') {
    $sSql = "SELECT V.ID_PRODUTO
                    , P.DESCRICAO
                    , V.QUANTIDADE
                    , V.VALOR_TOTAL 
               FROM VENDA V 
               JOIN PRODUTO P 
                 ON P.ID = V.ID_PRODUTO";

    $oConn->query($sSql);
    $aVendas = $oConn->getArrayResults();
    $sTabela = '';

    for ($i = 0; $i < sizeof($aVendas); $i++) {
      $sTabela .= '
        <tr>
          <td><span class="text-muted">%s</span></td>
          <td>%s</td>
          <td>%s</td>
          <td>R$ %s</td>
          <td>R$ %s</td>
        </tr>
        ';

      $sTabela = sprintf(
        $sTabela,
        $aVendas[$i]["ID_PRODUTO"],
        $aVendas[$i]["DESCRICAO"],
        $aVendas[$i]["QUANTIDADE"],
        number_format(($aVendas[$i]["VALOR_TOTAL"]/$aVendas[$i]["QUANTIDADE"]), 2, ',', '.'),
        number_format($aVendas[$i]["VALOR_TOTAL"], 2, ',', '.')
      );
    }

    if ($sTabela != '') {
      $resposta['status'] = true;
      $resposta['tabela'] = $sTabela;
    } else {
      $resposta['status'] = false;
    }
  }
  echo json_encode($resposta);
}
