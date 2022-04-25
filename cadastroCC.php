<!DOCTYPE html>

<?php
    include_once "acaoCC.php";
    require_once "utils.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    if ($acao == 'editar'){
        $cc_numero = isset($_GET['cc_numero']) ? $_GET['cc_numero'] : "";
    if ($cc_numero > 0)
        $dados = buscarDados($cc_numero);
}
    $title = "Cadastro de conta corrente";
    $cc_saldo = isset($_POST['cc_saldo']) ? $_POST['cc_saldo'] : "";
    
//var_dump($dados);
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title ?></title>
    <style>
         body{
            background-color: #e5ddee;
            margin: 20px;
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

        a{
            text-decoration: none;
            color: black;
        }

        a:hover{
            color: #b4a0cd;
        }
    </style>
</head>


<body>
<a href="indexCC.php">Consulta</a>

<h3>Insira os dados</h3><hr>

        <form method="post" action="acaoCC.php">
        <p>ID:</p>
            <input readonly  type="text" name="cc_numero" id="cc_numero" value="<?php if ($acao == "editar") echo $dados['cc_numero']; else echo 0; ?>"><br>
            
        <p>Saldo:</p>
            <input name="cc_saldo" id="cc_saldo" type="text" required="true" value="<?php if ($acao == "editar") echo $dados['cc_saldo']; ?>" placeholder="Digite o saldo"><br>
                   

        <p> Insira a pessoa: </p>
            <select name="cc_pf_id"  id="cc_pf_id">
                <?php
                echo lista_pessoa(0);
                ?>
            </select>
<br>
       <p>Última alteração: </p>
            <input name="cc_dt_ultima_alteracao" id="cc_dt_ultima_alteracao" type="date" required="true" 
            value="<?php if ($acao == "editar") echo $dados['cc_dt_ultima_alteracao']; ?>" 
            placeholder="Digite a Data"><br>
        <br><br>
        
        <button name="acao" value="salvar" id="acao" type="submit">Salvar</button>
</form>
</html>