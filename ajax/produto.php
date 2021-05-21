<?php     
    include "../Conexao.php";

    $conn = new Conexao();
    $conn->setConexao();
    $resposta = null;
    if(isset($_POST['action'])){
        if($_POST['action'] == 'save'){
            $sSql = "INSERT INTO PRODUTO (COD_BARRAS, DESCRICAO, ESTOQUE, VALOR_UNITARIO) 
                     VALUES ('%s', '%s', %s, %s)";
            $sSql = sprintf($sSql
                            , $_POST["cod_barras"]
                            , $_POST["descricao"]
                            , $_POST["estoque"]
                            , str_replace(',','.',$_POST["valor_unitario"])
            );
            $retorno = $conn->query($sSql, true);
            
            if ($retorno != ''){
                $resposta['status'] = true;
            }else{
                $resposta['status'] = false;
            }
        }
    }
    echo json_encode($resposta);    
?>