<?php include 'includes/header.php'?>

<?php
    if(isset($_GET['usuario'])){
        $idUsuario = $_GET['usuario'];
        $pegaUsuario = DB::getConn()->prepare("SELECT * FROM `usuarios` WHERE `id`=:idUsuario");
        $pegaUsuario->execute(array(':idUsuario' => $idUsuario));


    } else {
        echo '<script>window.history.back();</script>';
    }

?>


<?php while($usuario = $pegaUsuario->fetch(PDO::FETCH_OBJ)){
    $pegaSeguidor = DB::getConn()->prepare("SELECT * FROM `lifevideo_seguidores` WHERE `usuario`=:seguidor");
    $pegaSeguidor->execute(array(':seguidor' => $usuario->id));    
    $contaSeguidor = $pegaSeguidor->rowCount();

    $pegaSeguindo = DB::getConn()->prepare("SELECT * FROM `lifevideo_seguidores` WHERE `seguidor`=:seguidor");
    $pegaSeguindo->execute(array(':seguidor' => $usuario->id));    
    $contaSeguindo = $pegaSeguindo->rowCount();

    // Função para verificar se o usuário está seguindo um comércio específico
    function estaSeguindoComercio($usuario_id, $comercio_id) {
        $conn = DB::getConn();
        $sql = "SELECT COUNT(*) as total FROM lifevideo_seguidores WHERE seguidor = '$usuario_id' AND usuario = '$comercio_id'";
        $result = $conn->query($sql);
        if ($result->rowCount() > 0) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $total = $row["total"];
            return $total > 0;
        }
        return false;
    }
    if (estaSeguindoComercio($idDaSessao, $usuario->id)) {
        $btnSeguir = '<span class="w3-bar-item w3-block w3-right w3-button w3-text-red" onclick="desseguir('.$usuario->id.','.$idDaSessao.')"><i class="fa-solid fa-user-plus w3-xlarge"></i></span>';
    } else {
        $btnSeguir = '<span class="w3-bar-item w3-block w3-right w3-button w3-text-blue" onclick="seguir('.$usuario->id.', '.$idDaSessao.')"><i class="fa-solid fa-user-plus w3-xlarge"></i></span>';
    }
?>
<div class="w3-bar w3-card">
    <a class="w3-bar-item" href="./"><i class="fa-solid fa-house"></i></a>
    <div class="w3-center w3-padding">
        <span class="w3-font-bold">@<?= $usuario->nome?></span>
    </div>
</div>
<div class="w3-container">
    <div class="w3-display-container w3-card w3-round w3-white w3-border w3-margin-top w3-canter" style="height:300px;">
        <img class="w3-circle w3-display-topmiddle w3-margin-top" style="width:100px;height:100px;object-fit:cover;" src="uploads/<?= $usuario->imagem ?>" alt="<?= $usuario->nome ?>">
        <div class="w3-display-bottomleft w3-block">
            <h5 class="w3-font-bold w3-center">@<?= $usuario->nome?></h5>
            <div class="w3-font-bold" style="text-align:center;">
                <?= formatarNumero($contaSeguidor)?> Seguidor | <?= formatarNumero($contaSeguindo)?> Seguindo | 0 Likes
            </div>
            <?php if($idDaSessao<>$usuario->id){?>
            <span class="" id="exibirBtnSeguir"><?= $btnSeguir?></span>
            <?php } ?>
        </div>
    </div>
    <hr>
    <div class="w3-round w3-white w3-card w3-border w3-margin-top w3-canter">
        <div class="w3-row">
            <?php
                $pegaVideo = DB::getConn()->prepare("SELECT * FROM `lifevideo` WHERE `usuario`=:idUsuario ORDER BY `id` DESC");
                $pegaVideo->execute(array(':idUsuario' => $idUsuario));
            ?>
            <?php while($video = $pegaVideo->fetch(PDO::FETCH_OBJ)){?>
                <div class="w3-modal" id="mostreVideo<?= $video->id?>">
                    <div class="w3-modal-content">
                        <div class="w3-display-container">
                            <video style="width:100%;" id="playVideo<?= $video->id?>">
                                <source src="uploads/<?= $video->video?>" type="video/mp4">
                            </video>
                            <div class="w3-display-bottomright">
                                <span class="w3-button w3-red w3-round" onclick="$('#mostreVideo<?= $video->id?>').hide();videoPlay('playVideo<?= $video->id?>')">Fechar</span>
                            </div>
                            <div class="w3-display-hover">
                                <div class="w3-display-middle">
                                    <span class="w3-button w3-blue w3-round" onclick="videoPlay('playVideo<?= $video->id?>')">Play / Pause</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="w3-col m2 s4 w3-padding w3-display-container" style="min-width:108px;min-height:108px;">
                <video class="w3-round w3-card" style="width:100%;" onclick="$('#mostreVideo<?= $video->id?>').show();videoPlay('playVideo<?= $video->id?>')">
                    <source src="uploads/<?= $video->video?>" type="video/mp4">
                </video>
                <span class="w3-small w3-display-bottomleft w3-tag w3-round"><i class="fa-regular fa-eye"></i> <?= formatarNumero($video->views)?></span>
            </div>
            <?php }?>
        </div>
    </div>
</div>

<script>
    function videoPlay(idPlayer){
        var video = document.getElementById(idPlayer);
        // Verifica se o vídeo já está em reprodução
        if (video.paused) {
            // Se estiver pausado, inicie a reprodução
            video.play();
        } else {
            // Se já estiver em reprodução, pause
            video.pause();
        }
    }
   function seguir(usuario, seguidor) {
    $.ajax({
        url: 'seguir.php',
        type: 'POST',
        data: {
            seguidor: seguidor,
            usuario: usuario
        },
        success: function (response) {
            // Processar a resposta da requisição, se necessário
            //console.log(response);
            $('#exibirBtnSeguir').html(response);
            // Atualizar a interface do usuário, exibir mensagem de sucesso, etc.
            //window.location.reload()
        },
        error: function (xhr, status, error) {
            // Tratar erros de requisição, se necessário
            console.error(error);
        }
    });
}

// Função para desseguir um comércio
function desseguir(usuario, seguidor) {
    $.ajax({
        url: 'deseguir.php',
        type: 'POST',
        data: {
            usuario: usuario,
            seguidor: seguidor
        },
        success: function (response) {
            // Processar a resposta da requisição, se necessário
            //console.log(response);
            $('#exibirBtnSeguir').html(response);
            //window.location.reload()
            // Atualizar a interface do usuário, exibir mensagem de sucesso, etc.
        },
        error: function (xhr, status, error) {
            // Tratar erros de requisição, se necessário
            console.error(error);
        }
    });
}

</script>
<?php }?>

<?php include 'includes/footer.php'?>