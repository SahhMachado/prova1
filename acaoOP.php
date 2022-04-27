<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    require_once("classes/ContaCorrente.class.php");
    require_once("Operacao.php");
    
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $cc_numero = isset($_POST['cc_numero']) ? $_POST['cc_numero'] : "";

        try{
        if ($cnst == "1"){
            $dados = buscarDados($_POST['cc_numero']);
            $contaCorrente = new ContaCorrente("", $_POST['cc_saldo'], $_POST['cc_pf_id'], $_POST['cc_dt_ultima_alteracao']);      
            $resultado = $contaCorrente->saque($_POST['valor']);
            header("location:indexCC.php");
        }else   
        $dados = buscarDados($_POST['cc_numero']);
        $contaCorrente = new ContaCorrente($_POST['cc_numero'], $_POST['cc_saldo'], $_POST['cc_pf_id'], $_POST['cc_dt_ultima_alteracao']);
        $resultado = $contaCorrente->deposito($_POST['valor']);
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


/*
include_once "conf/default.inc.php";
require_once "conf/Conexao.php";
require_once "Operacao.php";
require_once "classes/ContaCorrente.class.php";
require_once "classes/PessoaFisica.class.php";

$acao = isset($_POST['acao']) ? $_POST['acao'] : "";
function fazer(){
    if ($acao == "salvar") {
        require_once "classes/ContaCorrente.class.php";
        if($_POST['cnst'] == "1"){
            $dados = buscarDados($_POST['cc_numero']);
            $contaCorrente = new ContaCorrente($_POST['cc_numero'], $dados['cc_saldo'], $_POST['cc_pf_id'], "");
            $contaCorrente->saque($_POST['valor']);
            header("location:indexCC.php");
        } else if($_POST['cnst'] == "2"){
            $dados = buscarDados($_POST['cc_numero']);
            $contaCorrente = new ContaCorrente($_POST['cc_numero'], $dados['cc_saldo'], $_POST['cc_pf_id'], "");
            $contaCorrente->deposito($_POST['valor']);
            header("location:indexCC.php");
        }
    }
}

function buscarDados($id,$seletor){
    if($seletor == 'ContaCorrente'){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM conta_corrent, pessoa_fisica WHERE cc_numero = $id");
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['cc_saldo'] = $linha['cc_saldo'];
            $dados['cc_pf_id'] = $linha['cc_pf_id'];
            $dados['cc_dt_ultima_alteracao'] = $linha['cc_dt_ultima_alteracao'];
        }

    }
}
*/
?>

