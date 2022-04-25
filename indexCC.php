<!DOCTYPE html>
<?php 
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    $title = "Consulta de Conta Corrente";
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
            <input type="radio" name="cnst" value="1" <?php if ($cnst == "1") echo "checked" ?>> Id<br>
            <input type="radio" name="cnst" value="2" <?php if ($cnst == "2") echo "checked" ?>> Saldo da Conta<br>
            <input type="radio" name="cnst" value="3" <?php if ($cnst == "3") echo "checked" ?>> Pessoa física<br>
    <br><br>
    </form>

    <table>
            <tr><td><b>ID</b></td>
                <td><b>Saldo</b></td>
                <td><b>Pessoa Física</b></td>
                <td><b>Data da última alteração</b></td>
                <td><b>Editar</b></td>
                <td><b>Excluir</b></td>
    </tr> 

            
    <?php
        $pdo = Conexao::getInstance(); 

        if($cnst == 1){
            $consulta = $pdo->query("SELECT * FROM pessoa_fisica, conta_corrent 
                                WHERE conta_corrent.cc_numero LIKE '$procurar%' 
                                AND pessoa_fisica.pf_id = conta_corrent.cc_pf_id
                                ORDER BY conta_corrent.cc_numero");}

        else if($cnst == 2){
            $consulta = $pdo->query("SELECT * FROM pessoa_fisica, conta_corrent 
                                WHERE conta_corrent.cc_saldo LIKE '$procurar%' 
                                AND pessoa_fisica.pf_id = conta_corrent.cc_pf_id
                                ORDER BY conta_corrent.cc_saldo");}

        else if($cnst == 3){
            $consulta = $pdo->query("SELECT * FROM pessoa_fisica, conta_corrent  
                                WHERE conta_corrent.cc_pf_id LIKE '$procurar%'
                                AND pessoa_fisica.pf_id = conta_corrent.cc_pf_id
                                ORDER BY pessoa_fisica.pf_nome");}


    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   
        
        ?>
        <tr>
            <td><?php echo $linha['cc_numero'];?></td>
            <td><?php echo number_format($linha['cc_saldo'],2,',','.');?></td>
            <td><?php echo $linha['pf_nome'];?></td>
            <td><?php echo date("d/m/Y",strtotime($linha['cc_dt_ultima_alteracao']));?></td>

            <td><a href='cadastroCC.php?acao=editar&cc_numero=<?php echo $linha['cc_numero'];?>'>Editar</a></td>
            <td><?php echo " <a href=javascript:excluirRegistro('acaoCC.php?acao=excluir&cc_numero={$linha['cc_numero']}')>Excluir</a><br>"; ?></td>
        
        </tr>
    <?php } ?>       
    </table>
    </fieldset>
    </form>
</body>
</html>