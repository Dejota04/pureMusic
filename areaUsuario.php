<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->

    <title>MelodiaShop</title>
    <link rel="stylesheet" href="./assets/scss/style.css">
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
    
            
</head>

<body>

<?php 
     
    ini_set('display_errors', 0);
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    include 'conexao.php';
    session_start();

 

    //consulta de produtos por categoria

    $consultaG = $cn->query("select id_prod, img_prod, nome_prod, quant_prod, desc_prod, valor from produto where categoria = 'guitarra'");
    $consultaP = $cn->query("select id_prod, img_prod, nome_prod, quant_prod, desc_prod, valor from produto where categoria = 'piano'");
    $consultaB = $cn->query("select id_prod, img_prod, nome_prod, quant_prod, desc_prod, valor from produto where categoria = 'bateria'");
    $consultaV = $cn->query("select id_prod, img_prod, nome_prod, quant_prod, desc_prod, valor from produto where categoria = 'violino'");
    $consultaV2 = $cn->query("select id_prod, img_prod, nome_prod, quant_prod, desc_prod, valor from produto where categoria = 'violão'");
    $consultaS = $cn->query("select id_prod, img_prod, nome_prod, quant_prod, desc_prod, valor from produto where categoria = 'saxofone'");
    $consultaT = $cn->query("select id_prod, img_prod, nome_prod, quant_prod, desc_prod, valor from produto where categoria = 'teclado'");
    $consultaCart = $cn->query("select id_prod, img_prod, nome_prod, quant_prod, desc_prod, valor from produto where cart_prod= 1 ");
    $idCli = $_SESSION['ID'] ;
    $consultaCli = $cn->query("select nome_cli from cliente where id_cli = '$idCli'");
    $exibeCli = $consultaCli->fetch(PDO::FETCH_ASSOC);
    $valorTotal = $cn->query("select Sum(valor) as valor from produto where cart_prod = 1");
    $exibeTotal = $valorTotal->fetch(PDO::FETCH_ASSOC);

    

    ?>

    <!-- Inicio Header -->
    <header class="container-fluid">
        <!-- Container -->
        <section class="container">
            <!-- Row - colunas -->
            <article class="row d-flex align-items-center">
                <!-- "Logo" -->
                <a href="index.php" class="col-md-3  d-flex justify-content-center">
                    <img src="assets/images/Logo branco total.png" class="img-fluid logo" alt="Logo MelodiaShop">
                </a>
                <h1>Área do usuário</h1>
                <!-- login funcionario -->
                <?php 
                
               
                ?>

                <ul class="col-md-3 nav d-flex align-items-center justify-content-around">
                    <li class="nav-item">
                        <?php if (empty($_SESSION['ID'])){?>
                        <a href="login-funcionario.php">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                            </svg>
                            Entrar
                        </a>
                        <?php } else{?>
                            <a href="sair.php">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                            </svg>
                            Logoff
                        </a><?php } ?>
                    </li>

                    <li class="nav-item">
                    <a href="#" id="cart-icon">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" class="bi bi-cart-fill " >
                                <path
                                    d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                    
                            </svg>  
                            Carrinho
                            
                            
                        </a>
                        <!-- Carrinho -->

                        <div class="cart" style="z-index:1000">
                                <h2 class="cart-title">Seu Carrinho</h2>
                                <div class="cart-content">
                                <?php if (isset($_SESSION['ID'])){?>    
                                <?php  while($exibe = $consultaCart->fetch(PDO::FETCH_ASSOC)){ ?>
                                    <div class="cart-box">
                                    <img src="./assets/images/<?php echo $exibe['img_prod'];?>" class="img-fluid cart-img"
                        alt="Guitarras">
                            <div class="detail-box">
                                <div class="cart-product-title"><?php echo $exibe['nome_prod'];?></div>
                                <div class="cart-price">R$<?php echo $exibe['valor'];?></div>
                            </div>
                           
                            <!--Remover-->
                            <a href="Cart0.php?id=<?php echo $exibe['id_prod']; ?>">
                            <i class="bx bxs-trash-alt cart-remove"></i>
                            </a>
                                    </div>   
                                    <?php } ?>                             
                                </div>
                                <?php } else{?>

                            

                                <?php } ?>
                                <!--Fechar Carrinho-->
                                <i class='bx bx-x' id="close-cart"></i>
                                <?php if (isset($_SESSION['ID'])){?> 
                                <div class="total">
                                    <div class="total-title">Total</div>
                                    <div class="total-price">R$<?php echo $exibeTotal['valor'];?></div>
                                </div>
                            <a href="Carrinho.php">   
                                <button type="button" class="btn btn-success col-md-12 finaliza">Finalizar compra</button>
                            </a>
                            <?php } else{?>
                                <h1> loga ai pra poder usar o carrinho, seu feio</h1>
                            <?php }?>
                           

                            </div>
                    </li>
                </ul>
                
                <!-- fim login funcionario -->
            </article>
            <!-- Fim Row -->
        </section>
        <!-- Fim Container -->
    </header>
    <!-- Fim do Header -->

    <div class="container-fluid">
	
	<h6 class="text-center">Início > <b>Minha conta</b></h6>
	<h1 class="text-center" >Minha conta</h1><br>
	<h1>Dados</h1>
	<hr>

	<div class=container>
		<h6><b>Dados pessoais<b/></h6>
	</div>
	
	
</div>

    <!-- Footer -->
    <footer class="container-fluid">
        <!-- Container -->
        <section class="container">
            <!-- Menus -->
            <section class="row">
                <!-- Atendimento -->
                <article class="col-md-4">
                    <h4>
                        Atendimento
                    </h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="#">(11) 9 9999-9999</a>
                        </li>
                        <li class="nav-item">
                            <a href="mailto:contato@loja.com.br">contato@loja.com.br</a>
                        </li>
                        <li class="nav-item">
                            Horario de Atendimento on-line: Segunda à sexta da 9:00 as 19:00
                        </li>

                    </ul>
                </article>
                <!-- Fim Atendimento -->

                <!-- Acesso Rápido -->
                <article class="col-md-3">
                    <h4>
                        Acesso Rápido
                    </h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="#">Minha Conta</a>
                        </li>
                        <li class="nav-item">
                            <a href="#">Meus Pedidos</a>
                        </li>
                        <li class="nav-item">
                            <a href="#">Rastrear meu Pedido</a>
                        </li>
                        <li class="nav-item">
                            <a href="#">Troca e Devoluções</a>
                        </li>
                    </ul>
                </article>
                <!-- Fim Acesso Rápido -->

                <!-- Institucional -->
                <article class="col-md-3">
                    <h4>
                        Institucional
                    </h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="#">Sobre a Loja</a>
                        </li>
                        <li class="nav-item">
                            <a href="#">Politica e Privacidade</a>
                        </li>
                    </ul>
                </article>
                <!-- Fim Institucional -->

                <!-- Mais Acessados-->
                <article class="col-md-2">
                    <h4>
                        Mais Acessados
                    </h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="#">Guitarra Ibanez</a>
                        </li>
                        <li class="nav-item ellipsis">
                            <a href="#">Guitarra Tagima</a>
                        </li>
                        <li class="nav-item">
                            <a href="#">Guitarra Special Tribute</a>
                        </li>
                        <li class="nav-item">
                            <a href="#">Guitarra Les Paul Vintage</a>
                        </li>
                    </ul>
                </article>
                <!-- Fim Mais Acessados -->

            </section>
            <!-- Fim Menus -->
        </section>
        <!-- Fim Container -->
    </footer>
    <!-- Fim Footer -->


    <!-- Arquivos do Bootstrap -->
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/jquery.js"></script>
    <script src="./assets/js/pooper.js"></script>
    <script src="./assets/js/bootstrap.js"></script>
</body>



</html>