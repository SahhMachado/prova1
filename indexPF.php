<!DOCTYPE html>
<?php 
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    $title = "Consulta de Pessoa Física";
    $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : ""; 
    $cnst = isset($_POST['cnst']) ? $_POST['cnst'] : 1;
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>    
    <script>
        function excluirRegistro(url){
            if (confirm("Confirma Exclusão?"))
                location.href = url;
        }
    </script>
    <style>
        body{
            margin: 20px;
        }
        td{
            padding-right: 20px;
        }
    </style>
</head>
<body>
<header>
    <?php
    include_once('menu.php');
    ?>
</header>

    <form method="post">
        <h3>Procurar Conta Corrente:</h3><br>
        <input type="text" name="procurar" id="procurar" size="25" placeholder="pesquisar"
        value="<?php echo $procurar;?>"><br><br>
    <button name="acao" id="acao" type="submit"  class="btn btn-outline-info">Procurar</button>
    <br><br>
    
    <fieldset>
    <p> Ordernar e pesquisar por:</p><br>
        <form method="post" action="">
            <input type="radio" name="cnst" value="1"<?php if ($cnst == "1") echo "checked" ?>>Id<br>
            <input type="radio" name="cnst" value="2"<?php if ($cnst == "2") echo "checked" ?>>Nome<br>
    <br><br>
    </form>

    <table>
            <tr><td><b>ID</b></td>
                <td><b>CPF</b></td>
                <td><b>Nome</b></td>
                <td><b>Data de Nascimento</b></td>
                <td><b>Editar</b></td>
                <td><b>Excluir</b></td>
    </tr> 

            
    <?php
        $pdo = Conexao::getInstance(); 

        if($cnst == 1){
            $consulta = $pdo->query("SELECT * FROM pessoa_fisica
                                WHERE pf_id LIKE '$procurar%' 
                                ORDER BY pf_id");}

        else if($cnst == 2){
            $consulta = $pdo->query("SELECT * FROM pessoa_fisica
                                WHERE pf_nome LIKE '$procurar%' 
                                ORDER BY pf_nome");}

    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   
        
        ?>
        <tr>
            <td><?php echo $linha['pf_id'];?></td>
            <td><?php echo $linha['pf_cpf'];?></td>
            <td><?php echo $linha['pf_nome'];?></td>
            <td><?php echo date("d/m/Y",strtotime($linha['pf_dt_nascimento']));?></td>

            <td><a href='cadastroPF.php?acao=editar&pf_id=<?php echo $linha['pf_id'];?>'>Editar</a></td>
            <td><?php echo " <a href=javascript:excluirRegistro('acaoPF.php?acao=excluirpf_id={$linha['pf_id']}')>Excluir</a><br>"; ?></td>
        
        </tr>
    <?php } ?>       
    </table>
    </fieldset>
    </form>
</body>
</html>