<!DOCTYPE html>
<?php 
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    $title = "Operação saque e depósito";
    $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : ""; 
    $cnst = isset($_POST['cnst']) ? $_POST['cnst'] : 1;
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
</head>
<body>
    <?php
    include_once "menu.php";
    require_once "utils.php";
    ?>
<h3>Insira os dados</h3>
<hr>
<br>
    <form action="acaoOP.php" method="post">
    <label for="pf_id">Pessoa: </label>
        <select name="cc_pf_id="cc_pf_id">
            <?php
            echo lista_pessoa(0);
            ?>
        </select>
        <br><br>
    
    <label for="cc_numero">Conta Corrente: </label>
        <select name="cc_numero"  id="cc_numero">
            <?php
            $pessoa = isset($_POST['pf_id'])?$_POST['pf_id']:0;
            echo lista_conta($pessoa);
            ?>
        </select>
        <br>
    <br>
    
        <label for="op">Operação:</label>
        <input type="radio" name="cnst" value="1" <?php if ($cnst == "1") echo "checked" ?>> Saque 
        <input type="radio" name="cnst" value="2" <?php if ($cnst == "2") echo "checked" ?>> Depósito<br><br>

        <label for="valor">Valor:</label>
        <input type="text" name="valor" id="valor"><br><br>

      <button name="acao" value="salvar" id="acao" type="submit">Salvar</button>     
    </form>
<header>
</body>
</html>