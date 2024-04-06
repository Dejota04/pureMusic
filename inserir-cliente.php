<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo-insert.css"/>
    <title>Cadastrar cliente</title>
    <script src="./assets/js/jquery.js"></script>
    <script src="jquery.mask.js"></script>

    <script>
	
	
	
    $(document).ready(function(){
        
        $("#cpf").mask("000.000.000-00");
        $("#tel").mask("(00) 00000-0000");
        
        
    });
	
</script>
</head>
<body>

<?php
	ini_set('display_errors', 0);
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
	session_start();

	include 'conexao.php';	
	
	?>

    <section class="area-login">

        <!--tela de cadastro-->
       
    <div class="login">
        <div class="titulo">
            <p >Cadastrar Cliente</p>
        </div>

        <form method="post" action="inserir-cliente.php" >
            <input type="email" name="txtemail"  placeholder="insira o e-mail..." autofocus required id="txtemail"/>
            <input type="text" name="txtnome"  placeholder="insira o nome..." required id="txtnome"/>
            <input type="text" name="txtcpf"  placeholder="insira o cpf..." required id="cpf"/>
            <input type="text" name="txtTel"  placeholder="insira o telefone..." required id="tel"/>
            <input class="button" type="submit" name="submit" value="CADASTRAR" />
        </form>
        <a href="selecionar.php"><h3 class="voltar">Voltar</h3></a> 

        <?php

				 
					include 'conexao.php';
					$nome = $_POST['txtnome'];
					$email = $_POST['txtemail'];
					$telefone = $_POST['txtTel'];
					$cpf = $_POST['txtcpf'];

					$consultar = $cn->query("select cpf_cli, email_cli from cliente where cpf_cli='$cpf' or email_cli='$email'");
					$exibe = $consultar->fetch(PDO::FETCH_ASSOC);

                    if($consultar->rowCount()>=1 && isset($_POST['submit']))
					{
						echo "<script lang='JavaScript'> window.alert('Esse cliente já foi cadastrado!'); window.location.href='inserir-cliente.php';</script>";
					} else if (isset($_POST['submit'])){

						$inserirFunc = $cn->query("insert into cliente (nome_cli, email_cli, CPF_cli)
						values ('$nome','$email', '$cpf')");    
						echo "<script lang='JavaScript'> window.alert('Cliente cadastrado com sucesso!'); window.location.href='selecionar.php';</script>";
					}
?>
    </div>

    </section>

    
</body>
</html>