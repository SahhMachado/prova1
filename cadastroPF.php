<!DOCTYPE html>
<?php
    include_once "acaoPF.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    if ($acao == 'editar'){
        $pf_id = isset($_GET['pf_id']) ? $_GET['pf_id'] : "";
    if ($pf_id > 0)
        $dados = buscarDados($pf_id);
}
    $title = "Cadastro de pessoa física";
// var_dump($dados);
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title ?></title>
</head>

<body>
    <br>
<a href="indexPF.php">Consulta</a>

        <h3>Insira os dados</h3><hr>
            <form method="post" action="acaoPF.php">
                
            <p>ID:</p>
                <input readonly  type="text" name="pf_id" id="pf_id" value="<?php if ($acao == "editar") echo $dados['pf_id']; else echo 0; ?>"><br>

            <p>CPF:</p>
                <input name="pf_cpf" id="pf_cpf" type="text" required="true" value="<?php if ($acao == "editar") echo $dados['pf_cpf']; ?>" placeholder="Digite o CPF"><br>         
            
            <p>Nome:</p>
                <input name="pf_nome" id="pf_nome" type="text" required="true" value="<?php if ($acao == "editar") echo $dados['pf_nome']; ?>" placeholder="Digite o nome"><br>
            
            <p>Data de Nascimento:</p>
                <input name="pf_dt_nascimento" id="pf_dt_nascimento" type="date" required="true" value="<?php if ($acao == "editar") echo $dados['pf_dt_nascimento']; ?>" placeholder="Digite a data de nascimento"><br>
            <br>
                <button name="acao" value="salvar" id="acao" type="submit">Salvar</button>
            </form>
</body>
</html>