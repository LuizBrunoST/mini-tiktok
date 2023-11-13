<?php
ini_set('display_errors', 'On');

include('classes/DB.class.php');
include('classes/Login.class.php');

include('classes/Amisade.class.php');
include('classes/Recados.class.php');
include('classes/Allbuns.class.php');
include('functions/userOnline.php');
include('functions/formataData.php');
include('functions/formataNumeros.php');

$objLogin = new Login;

if(!$objLogin->logado()){
	include('login.php');
	exit();
}

if(isset($_GET['sair'])){
	$objLogin->sair();
	header('Location: ./');
    exit;
}

$idExtrangeiro = (isset($_GET['uid'])) ? (int)$_GET['uid'] : $_SESSION['socialbigui_uid'];
$idDaSessao = $_SESSION['socialbigui_uid'];

$idExists = DB::getConn()->prepare('SELECT `id` FROM `usuarios` WHERE `id`=?');
$idExists->execute(array($idExtrangeiro));
if($idExists->rowCount()==0){
	$objLogin->sair();
    header('Location: ./');
    exit;
}

$dados = $objLogin->getDados($idExtrangeiro);

if(is_null($dados)){
	header('Location: ./');
	exit();
}else{
	extract($dados,EXTR_PREFIX_ALL,'user'); 
}

function dd($in, $dump = false){
    echo '<pre>';
    if ($dump) {
        var_dump($in);
    } else {
        print_r($in);
    }
    echo '</pre>';
    exit;
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Life Video</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/padrao.css">
    <script src="js/w3.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="author" content="LUMAMAX | LUIZ BRUNO R. T.">

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
</head>

<body class="w3-light-grey">
    