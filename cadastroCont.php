<!DOCTYPE html>

<?php
    include_once "acaoCont.php";
    require_once "utils.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    if ($acao == 'editar'){
        $cont_id = isset($_GET['cont_id']) ? $_GET['cont_id'] : "";
    if ($cont_id > 0)
        $dados = buscarDados($cont_id);
}
    $title = "Cadastro de contatos";

    
//var_dump($dados);
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title ?></title>
</head>


<body>
<a href="indexCont.php">Consulta</a>

<h3>Insira os dados</h3><hr>

        <form method="post" action="acaoCont.php">
        <div class="form-group col-lg-3">
        <label>ID:</label>
            <input readonly  type="text" name="cont_id" id="cont_id"
            value="<?php if ($acao == "editar") echo $dados['cont_id']; else echo 0; ?>">
            <br><br>

        <label>Tipo:</label>
            <input name="cont_tipo" id="cont_tipo" type="text" required="true" 
                value="<?php if ($acao == "editar") echo $dados['cont_tipo']; ?>" 
                placeholder="Digite o tipo">
                <br><br>
                
        <label>Descrição:</label>
                <input name="cont_descricao" id="cont_descricao" type="text" required="true"
                value="<?php if ($acao == "editar") echo $dados['cont_descricao']; ?>" 
                placeholder="Digite a descrição">
                <br><br>
                   

        <label> Insira a pessoa:</label><br>
            <select name="cont_pf_id"  id="cont_pf_id">
                <?php
                echo lista_pessoa(0);
                ?>
            </select>
<br><br>
      <button name="acao" value="salvar" id="acao" type="submit">Salvar</button>     
    </form>
</body>
</html>