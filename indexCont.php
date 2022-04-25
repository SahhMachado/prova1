<!DOCTYPE html>
<?php 
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    $title = "Consulta de contatos";
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

        td{
            padding-right: 20px;
        }

        div{
            padding: 20px;
        }
    </style>
</head>
<body>
<header>
    <?php
    include_once('menu.php');
    ?>
</header>

<div>
    <form method="post">
        <h3>Procurar contato:</h3><br>
            <input type="text" name="procurar" id="procurar" size="25" placeholder="pesquisar"
            value="<?php echo $procurar;?>"> <br><br>
        <button name="acao" id="acao" type="submit">Procurar</button>
<br><br>

<fieldset>
    <p> Ordernar e pesquisar por:</p><br>
        <form method="post" action="">
            <input type="radio" name="cnst" value="1"<?php if ($cnst == "1") echo "checked" ?>>Id<br>
            <input type="radio" name="cnst" value="2"<?php if ($cnst == "2") echo "checked" ?>>Tipo<br>
            <input type="radio" name="cnst" value="3"<?php if ($cnst == "3") echo "checked" ?>>Pessoa Física<br>
    <br><br>
    </form>
    <table>
        <tr><td><b>ID</b></td>
            <td><b>Tipo</b></td>
            <td><b>Descrição</b></td>
            <td><b>Pessoa Física</b></td>
            <td><b>Editar</b></td>
            <td><b>Excluir</b></td>
    </tr> 
</div>
            
    <?php
        $pdo = Conexao::getInstance(); 

        if($cnst == 1){
            $consulta = $pdo->query("SELECT * FROM pessoa_fisica, contatos 
                WHERE contatos.cont_id LIKE '$procurar%' 
                AND pessoa_fisica.pf_id = contatos.cont_pf_id
                ORDER BY contatos.cont_id");}

        else if($cnst == 2){
            $consulta = $pdo->query("SELECT * FROM pessoa_fisica, contatos 
                WHERE contatos.cont_tipo LIKE '$procurar%' 
                AND pessoa_fisica.pf_id = contatos.cc_pf_id
                ORDER BY contatos.cont_tipo");}

        else if($cnst == 3){
            $consulta = $pdo->query("SELECT * FROM pessoa_fisica, contatos  
                WHERE contatos.cont_pf_id LIKE '$procurar%'
                AND pessoa_fisica.pf_id = contatos.cc_pf_id
                ORDER BY pessoa_fisica.pf_nome");}


    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   
        
        ?>
        
        <tr><td><?php echo $linha['cont_id'];?></td>
            <td><?php echo $linha['cont_tipo'];?></td>
            <td><?php echo $linha['cont_descricao'];?></td>
            <td><?php echo $linha['pf_nome'];?></td>
            <td><a href='cadastroCont.php?acao=editar&cont_id=<?php echo $linha['cont_id'];?>'><img src='img/edit.svg'></a></td>
            <td><?php echo "<a href=javascript:excluirRegistro('acaoCont.php?acao=excluir&cont_id={$linha['cont_id']}')>
            <img src='img/excluir.svg'></a><br>"; ?></td>
        
        </tr>
    <?php } ?>       
    </table>
    </fieldset>
    </form>
</body>
</html>