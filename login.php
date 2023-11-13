<?php

    if(isset($_POST['logar'])){
                
        $lembrar = isset($_POST['lembrar']) ? $_POST['lembrar'] : '';
        if($objLogin->logar($_POST['email'],$_POST['senha'],$lembrar)){
            header('Location: ./');
            exit;
        }else{
            echo $objLogin->erro;
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TIK TOK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="css/w3.css">
    <script src="js/jquery-3.6.0.min.js"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="author" content="LUMAMAX | LUIZ BRUNO R. T.">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

</head>
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Trebuchet MS"}
</style>
<body class="w3-light-grey">
    <div class="w3-bar w3-content" style="height:100px;">
        <div class="w3-mobile">
            <img class="w3-bar-item w3-mobile" src="img/download.png" height="100" alt="LUMAMAX">
        </div>
        <div class="w3-mobile">
            <div class="w3-bar-item w3-right w3-mobile">
                <h1><b>TIK TOK</b></h1>
                <p>O video ao seu alcance</p> 
            </div>
        </div>
    </div>
        
    <div class="w3-mobile border border-1 w3-round w3-white w3-content w3-padding">
        <h4 class="w3-center">Faça login:</h4>
        <form name="login" class="w3-padding " method="post" enctype="multipart/form-data" action="">
            <?php
				if(isset($_GET['recuperar']) && $_GET['recuperar'] == 'sim'){
			?>

            <div class="input-group mb-3">
                <input type="hidden" name="acao" value="recuperar">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-at"></i></span>
                <input type="text" class="form-control" name="emailRecupera" required placeholder="E-mail ..." aria-label="E-mail ..." aria-describedby="basic-addon1">
                <span><input class="input-group-text" id="basic-addon2" type="submit" value="Recuperar Senha"></span>
            </div>
            
            <?php }else{?>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-at"></i></span>
                <input type="text" class="form-control" name="email" required placeholder="E-mail ..." aria-label="E-mail ..." aria-describedby="basic-addon1">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-key"></i></span>
                <input type="password" class="form-control" name="senha" required placeholder="Senha ..." aria-label="Senha ..." aria-describedby="basic-addon1">
            </div>

            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="check2" name="lembrar">
                <label class="form-check-label" for="check2">Lembrar de mim</label>
            </div>
            <br>
            <div class="w3-bar">
                <div class="w3-left">
                    <a class="btn btn-success w3-block w3-bar-item" href="../"><i class="fa-solid fa-chevron-left"></i> Voltar</a>
                </div>
                <div class="col-sm-3">
                    
                </div>
                <div class="w3-right">
                    <input type="submit" class="w3-button w3-round w3-blue w3-block w3-bar-item" value="Entrar" name="logar">
                </div>
            </div>
            <?php }?>


        </form>
        <div class="w3-bar w3-padding">
            <span class="w3-bar-item w3-left">Vamos se cadastrar clique em: <a href="../cadastro.php">Cadastrar</a></span>
            <a class="w3-bar-item w3-right" href="?recuperar=sim">Esqueceu a senha?</a>
        </div>
    </div>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>    
</body>
</html>