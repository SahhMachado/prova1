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
    <style>
        body{
            background-color: #e5ddee;
            margin: 0px;
            font-family: Arial, Helvetica, sans-serif;
        }

        button{
            background-color: #9178af;
            border-radius: 10px;
            border: none;
            font-weight: bold;
        }

        input{
            background-color: #b4a0cd;
            border-radius: 10px;
            border: none;
        }

        header{
            background-image: url("img/header1.jpg");
            padding: 20px;
            font-weight: bold;
        }

        a{
            text-decoration: none;
            color: black;
        }

        a:hover{
            color: #b4a0cd;
        }

        div{
            padding: 20px;
        }
    </style>
</head>
<body>
    <header>
    <?php
    include_once "menu.php";
    require_once "utils.php";
    ?>
    </header>

<div>
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
        <input type="text" name="valor" id="valor" placeholder="insira um valor"><br><br>

      <button name="acao" value="salvar" id="acao" type="submit">Salvar</button>     
    </form>
    </div>
</body>
</html>