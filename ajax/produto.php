<?php
include "../Conexao.php";

$oConn = new Conexao();
$oConn->setConexao();
$resposta = null;

if (isset($_POST['action'])) {
  if ($_POST['action'] == 'save') {
    $sSql = "INSERT INTO PRODUTO (COD_BARRAS, DESCRICAO, ESTOQUE, VALOR_UNITARIO) 
                  VALUES ('%s', '%s', %s, %s)
    ";
    $sSql = sprintf($sSql
                    , $_POST["cod_barras"]
                    , $_POST["descricao"]
                    , $_POST["estoque"]
                    , str_replace(',', '.', str_replace('.', '', $_POST["valor_unitario"]))
    );
    $retorno = $oConn->query($sSql, true);

    if ($retorno != '') {
      $resposta['status'] = true;
    } else {
      $resposta['status'] = false;
    }

  } elseif ($_POST['action'] == 'edit') {
    $sSql = "UPDATE PRODUTO 
                SET DESCRICAO = '%s'
                    , ESTOQUE = %s
                    , VALOR_UNITARIO = %s
              WHERE COD_BARRAS = '%s'";
    $sSql = sprintf($sSql
                    , $_POST["descricao"]
                    , $_POST["estoque"]
                    , str_replace(',', '.', str_replace('.', '', $_POST["valor_unitario"]))
                    , $_POST["cod_barras"]
    );

    $retorno = $oConn->query($sSql, true);

    if ($retorno != '') {
      $resposta['status'] = true;
    } else {
      $resposta['status'] = false;
    }

  } elseif ($_POST['action'] == 'delete') {
    $sSql = "UPDATE PRODUTO 
                SET EXCLUIDO = 'S' 
              WHERE ID = %s";
    $sSql = sprintf($sSql, $_POST["id_produto"]);

    $retorno = $oConn->query($sSql, true);

    if ($retorno != '') {
      $resposta['status'] = true;
    } else {
      $resposta['status'] = false;
    }
  } elseif ($_POST['action'] == 'restore') {
    $sSql = "UPDATE PRODUTO 
                SET EXCLUIDO = 'N' 
              WHERE ID = %s";
    $sSql = sprintf($sSql, $_POST["id_produto"]);

    $retorno = $oConn->query($sSql, true);

    if ($retorno != '') {
      $resposta['status'] = true;
    } else {
      $resposta['status'] = false;
    }
  }

  echo json_encode($resposta);
} elseif (isset($_GET['action'])) {
  if ($_GET['action'] == 'select') {
    $sSql = "SELECT P.VALOR_UNITARIO
                    , P.ESTOQUE 
               FROM PRODUTO P 
              WHERE P.ID = %s";
    $sSql = sprintf($sSql, $_GET["id_produto"]);

    $oConn->query($sSql);
    $retorno = $oConn->getArrayResults();

    if ($retorno != '') {
      $resposta['status'] = true;
    } else {
      $resposta['status'] = false;
    }
    echo json_encode($retorno);
  }
}
