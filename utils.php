<?php
require_once ("classes/ContaCorrente.class.php");
require_once("classes/PessoaFisica.class.php");

function exibir($chave, $dados){
    foreach($dados as $linha){
        $str .= "<option value='".$linha[$chave[0]]."'>".$linha[$chave[1]]."</option>";
    }
    return $str;
}

function lista_pessoa($id){
    $pessoa = new Pessoa("","","","");
    $lista = $pessoa->buscar($id);
    return exibir(array('pf_id', 'pf_nome'), $lista);
}

function lista_conta($id){
    try{
        $conta = new ContaCorrente("","","","");
    }catch(Exception $e){
        echo "Erro: ".$e->getMessage();
    }
    $lista = $conta->buscar($id);
    return exibir(array('cc_numero', 'cc_numero'), $lista);
}
?>