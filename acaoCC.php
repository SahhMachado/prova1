<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    require_once ("classes/ContaCorrente.class.php");
    require_once("classes/PessoaFisica.class.php");
    
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $cc_numero = isset($_GET['cc_numero']) ? $_GET['cc_numero'] : 0;
        
        $contaCorrente = new ContaCorrente("", "", "", "");
        $resultado = $contaCorrente->excluir($cc_numero);
        header("location:indexCC.php");
    }
   
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $cc_numero = isset($_POST['cc_numero']) ? $_POST['cc_numero'] : "";

        try{
        if ($cc_numero == 0){
            $contaCorrente = new ContaCorrente("", $_POST['cc_saldo'], $_POST['cc_pf_id'], $_POST['cc_dt_ultima_alteracao']);      
            $resultado = $contaCorrente->insere();
            header("location:indexCC.php");
        }else     
        $contaCorrente = new ContaCorrente($_POST['cc_numero'], $_POST['cc_saldo'], $_POST['cc_pf_id'], $_POST['cc_dt_ultima_alteracao']);
        $resultado = $contaCorrente->editar($cc_numero);
        header("location:indexCC.php");    
    }catch(Exception $e){
        echo "<h1>Erro ao cadastrar conta.<h1>
        <br> Erro: <br>".$e->getMessage();
    }     
}



//Consultar dados
    function buscarDados($cc_numero){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM conta_corrent WHERE cc_numero = $cc_numero");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['cc_numero'] = $linha['cc_numero'];
            $dados['cc_saldo'] = $linha['cc_saldo'];
            $dados['cc_pf_id'] = $linha['cc_pf_id'];
            $dados['cc_dt_ultima_alteracao'] = $linha['cc_dt_ultima_alteracao'];


        }
        return $dados;
    }
?>