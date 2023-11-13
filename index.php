<?php include 'includes/header.php'?>
<div class="w3-container w3-center"><span class="w3-spinner-grow w3-blue"></span></div>
<div id="video-container" class="w3-display-container">
    <video id="video-player" autoplay loop playsinline>
        <source id="video-source" src="" type="video/mp4">
    </video>
    <div class="w3-display-topleft">

    </div>
    <div class="w3-display-right">
        <a class="w3-right" id="btnPerfilUp" href="#">
            <img id="imagem" class="w3-circle w3-card" src="" style="border:3px solid #2196F3;width:59px;height:59px;object-fit:cover;" alt="My Perfil">
        </a><br>
        <a class="w3-button w3-bar-item w3-block w3-right w3-text-blue" href="#"><i class="fa-solid fa-share-from-square w3-xlarge"></i></a><br>
        <a class="w3-button w3-bar-item w3-block w3-right w3-text-blue" href="#"><i class="fa-regular fa-heart w3-xlarge"></i></a><br>
        <a class="w3-button w3-bar-item w3-block w3-right w3-text-blue" href="#"><i class="fa-brands fa-stack-exchange w3-xlarge"></i></a><br>
        <span id="exibirBtnSeguir"></span>
    </div>

    <div class="w3-display-bottomleft" style="width:200px;margin-bottom:43px;background:#2196f30a;">
        <span class="w3-text-white"><strong id="userName">@username</strong> - <span id="dataVideo">12h Ago</span></span><br>
        <span class="w3-text-white"><marquee id="descri">Description</marquee></span><br>
        <span class="w3-text-white"><marquee><strong><i class="fa-solid fa-music"></i></strong> <span id="music">Eminem - Rap God</span></marquee></span>
    </div>

    <div class="w3-display-bottomleft w3-block">
        <div class="w3-row w3-large" style="background:#2196f30a;">
            <div class="w3-col s2">
                <a href="./" class="w3-button w3-text-blue w3-block"><i class="fa-solid fa-house"></i></a>
            </div>
            <div class="w3-col s2">
                <a href="#delivery" class="w3-button w3-text-blue w3-block"><i class="fa-solid fa-magnifying-glass"></i></a>
            </div>
            <div class="w3-col s3">
                <a href="upload" class="w3-button w3-text-blue w3-block"><i class="fa-solid fa-arrow-up-from-bracket"></i></a>
            </div>
            <div class="w3-col s2">
                <a href="javascript:void(0)" class="w3-button w3-text-blue w3-block"><i class="fa-solid fa-arrow-down"></i></a>
            </div>
            <div class="w3-col s3">
                <a href="javascript:void(0)" class="w3-button w3-text-blue w3-block"><i class="fa-solid fa-user"></i></a>
            </div>
        </div>
    </div>
</div>
<script>
    // Função para seguir um comércio
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

function viewsIndex(id, views) {
    $.ajax({
        url: 'views.php',
        type: 'POST',
        data: {
            id: id,
            views: views
        },
        success: function (response) {
            // Processar a resposta da requisição, se necessário
            //console.log(response);
            //$('#exibirBtnSeguir').html(response);
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
<style>
#video-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background-color: #f1f1f1; /* Cor de fundo do vídeo */
    animation-duration: 0.5s; /* Duração da animação */
    animation-timing-function: ease-in-out; /* Função de temporização da animação */
}

/* Define a animação de slide para cima */
@keyframes slide-up {
    0% {
        transform: translateY(100%);
    }
    100% {
        transform: translateY(0);
    }
}

/* Define a animação de slide para baixo */
@keyframes slide-down {
    0% {
        transform: translateY(0);
    }
    100% {
        transform: translateY(100%);
    }
}

/* Aplica a animação ao elemento de vídeo */
#video-container.up {
    animation-name: slide-up;
}

#video-container.down {
    animation-name: slide-down;
}

#video-player {
    width: 100%;
    height: 100%;
}
</style>

<script>
$(document).ready(function () {

    document.addEventListener('contextmenu', function (e) {
        e.preventDefault();
    });
    
    

    const videoPlayer = $('#video-player')[0];
    const videoSource = $('#video-source');
    const userName = $('#userName');
    const descri = $('#descri');
    const music = $('#music');
    const dataVideo = $('#dataVideo');
    const imagemUser = $('#imagem');
    const exibirBtnSeguir = $('#exibirBtnSeguir');
    const btnPerfilUp = $('#btnPerfilUp');


    
    const videos = [
        <?php 
            $pegaVideo = DB::getConn()->prepare("SELECT * FROM `lifevideo` ORDER BY RAND() LIMIT 60");
            $pegaVideo->execute();

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
            
            while($lifevideo = $pegaVideo->fetch(PDO::FETCH_OBJ)){
                $timestamp = strtotime($lifevideo->data);
                $agora = time();
                $diferenca = $agora - $timestamp;
                
                if ($diferenca < 60) {
                    $tempoFormatado = $diferenca . 's';
                } elseif ($diferenca < 3600) {
                    $tempoFormatado = floor($diferenca / 60) . 'm';
                } elseif ($diferenca < 86400) {
                    $tempoFormatado = floor($diferenca / 3600) . 'h';
                } elseif ($diferenca < 2592000) { // Menos de 30 dias
                    $tempoFormatado = floor($diferenca / 86400) . 'd';
                } elseif ($diferenca < 31536000) { // Menos de 365 dias
                    $tempoFormatado = floor($diferenca / 2592000) . 'mo';
                } else {
                    $tempoFormatado = floor($diferenca / 31536000) . 'y';
                }

                $pegaUsuarios = DB::getConn()->prepare("SELECT * FROM `usuarios` WHERE `id`=:idUser");
                $pegaUsuarios->execute(array(':idUser' => $lifevideo->usuario));
                $author = $pegaUsuarios->fetch(PDO::FETCH_OBJ);



                if($idDaSessao<>$author->id){
                    if (estaSeguindoComercio($idDaSessao, $author->id)) {
                        $btnSeguir = '<span class="w3-bar-item w3-block w3-right w3-button w3-text-red" onclick="desseguir('.$author->id.','.$idDaSessao.')"><i class="fa-solid fa-user-plus w3-xlarge"></i></span>';
                    } else {
                        $btnSeguir = '<span class="w3-bar-item w3-block w3-right w3-button w3-text-blue" onclick="seguir('.$author->id.', '.$idDaSessao.')"><i class="fa-solid fa-user-plus w3-xlarge"></i></span>';
                    }
                } else {
                    $btnSeguir = '';
                }

        ?>
        {
            src: "<?= $lifevideo->video?>",
            idVideo: "<?= $lifevideo->id?>",
            viewsVideo: "<?= $lifevideo->views?>",
            author: "@<?= $author->nome?>",
            authorId: "<?= $author->id?>",
            description: '<?= $lifevideo->descricao?>',
            music: "<?= $lifevideo->titulo?>",
            dataVideo: "<?= $tempoFormatado?>",

            idUsuario: "<?= $author->id?>",
            imagemPath: "<?= $author->imagem?>",
            btnSeguirA :'<?= $btnSeguir?>',
        },
        <?php }?>
        // Adicione mais vídeos conforme necessário
    ];

    let currentVideoIndex = 0;
    
    function playVideo(index) {
    

        const videoPath = videos[index].src;
        const idVideo = videos[index].idVideo;
        const viewsVideo = videos[index].viewsVideo;
        const author = videos[index].author;
        const description = videos[index].description;
        const title = videos[index].music;
        const data = videos[index].dataVideo;

        const idUsuario = videos[index].idUsuario;
        const imagemP = videos[index].imagemPath
        const idUser = videos[index].btnSeguirA
        videoSource.attr('src', 'uploads/' + videoPath);
        videoPlayer.load();
        videoPlayer.play();

        userName.text(author);
        descri.text(description);
        music.text(title);
        dataVideo.text(data);
        imagemUser.attr('src', 'uploads/' + imagemP);
        $('title').text('('+ author +') '+ title + ' | Life Videos');
        exibirBtnSeguir.html(idUser)
        viewsIndex(idVideo, viewsVideo);

        btnPerfilUp.attr('href', 'perfil?usuario=' + idUsuario)
    }

    playVideo(currentVideoIndex);

    let startY = 0;

    $('#video-container').on('touchstart', function (e) {
        startY = e.originalEvent.touches[0].clientY;
    });

    $('#video-container').on('touchend', function (e) {
        const endY = e.originalEvent.changedTouches[0].clientY;
        const deltaY = startY - endY;

        if (deltaY > 50) { // Deslize para cima
            // Aplica a animação de slide para cima
            $('#video-container').addClass('up');

            // Pausa o vídeo atual
            videoPlayer.pause();

            // Move para o próximo vídeo (circulando se necessário)
            currentVideoIndex = (currentVideoIndex + 1) % videos.length;

            setTimeout(function () {
                // Remove a animação e inicia o próximo vídeo após a animação de slide
                $('#video-container').removeClass('up');
                playVideo(currentVideoIndex);
            }, 1000); // Tempo de espera igual à duração da animação
        } else if (deltaY < -50) { // Deslize para baixo
            // Aplica a animação de slide para baixo
            $('#video-container').addClass('down');

            // Pausa o vídeo atual
            videoPlayer.pause();

            // Move para o vídeo anterior (circulando se necessário)
            currentVideoIndex = (currentVideoIndex - 1 + videos.length) % videos.length;

            setTimeout(function () {
                // Remove a animação e inicia o vídeo anterior após a animação de slide
                $('#video-container').removeClass('down');
                playVideo(currentVideoIndex);
            }, 1000); // Tempo de espera igual à duração da animação
        }
    });
    // Verifica o User-Agent para determinar o tipo de dispositivo
    var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

    // Obtém a largura da tela
    var screenWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

    if (isMobile) {
        console.log('Este é um dispositivo móvel');
    } else {
        window.location.href='computer';
    }
    
});
</script>

<?php include 'includes/footer.php'?>