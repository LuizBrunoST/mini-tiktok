<?php include 'includes/header.php'?>
<div id="video-container">
    <div id="video-wrapper">
        <video id="video-player" autoplay loop playsinline>
            <source id="video-source" src="" type="video/mp4">
        </video>
        <span id="prev-button" class="w3-display-left w3-button w3-blue"><i class="fa-solid fa-chevron-left w3-xxlarge"></i></span>
        <span id="next-button" class="w3-display-right w3-button w3-blue"><i class="fa-solid fa-chevron-right w3-xxlarge"></i></span>
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
const setVideoMaxHeight = () => {
    const windowHeight = $(window).height();
    $('#video-player').css('max-height', windowHeight + 'px');
};

// Chame a função para definir a altura máxima inicialmente
setVideoMaxHeight();

// Adicione um manipulador de evento para redimensionar a janela
$(window).on('resize', setVideoMaxHeight);
</script>





<script>
$(document).ready(function () {
    const videoPlayer = $('#video-player')[0];
    const videoSource = $('#video-source');

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
    ];

    let currentVideoIndex = 0;

    function playVideo(index) {
        const videoPath = videos[index].src;
        const idVideo = videos[index].idVideo;
        const viewsVideo = videos[index].viewsVideo;
        //const author = videos[index].author;
        //const description = videos[index].description;
        //const title = videos[index].music;
        //const data = videos[index].dataVideo;
//
        //const idUsuario = videos[index].idUsuario;
        //const imagemP = videos[index].imagemPath
        //const idUser = videos[index].btnSeguirA
        videoSource.attr('src', 'uploads/' + videoPath);
        videoPlayer.load();
        videoPlayer.play();

        //userName.text(author);
        //descri.text(description);
        //music.text(title);
        //dataVideo.text(data);
        //imagemUser.attr('src', '../uploads/usuarios/' + imagemP);
        //$('title').text('('+ author +') '+ title + ' | Life Videos');
        //exibirBtnSeguir.html(idUser)
        viewsIndex(idVideo, viewsVideo);

        //btnPerfilUp.attr('href', 'perfil?usuario=' + idUsuario)
    }

    playVideo(currentVideoIndex);

    $('#prev-button').on('click', function () {
        // Pausa o vídeo atual
        videoPlayer.pause();

        // Move para o vídeo anterior (circulando se necessário)
        currentVideoIndex = (currentVideoIndex - 1 + videos.length) % videos.length;

        // Inicia o vídeo anterior com efeito de slide para a esquerda
        $('#video-wrapper').addClass('slide-right');
        setTimeout(function () {
            $('#video-wrapper').removeClass('slide-right');
            playVideo(currentVideoIndex);
        }, 500); // Duração da animação em milissegundos (0,5 segundos)
    });

    $('#next-button').on('click', function () {
        // Pausa o vídeo atual
        videoPlayer.pause();

        // Move para o próximo vídeo (circulando se necessário)
        currentVideoIndex = (currentVideoIndex + 1) % videos.length;

        // Inicia o próximo vídeo com efeito de slide para a direita
        $('#video-wrapper').addClass('slide-left');
        setTimeout(function () {
            $('#video-wrapper').removeClass('slide-left');
            playVideo(currentVideoIndex);
        }, 500); // Duração da animação em milissegundos (0,5 segundos)
    });
});
</script>

<style>
#video-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background-color: black; /* Cor de fundo do vídeo */
    display: flex;
    justify-content: center;
    align-items: center;
}

#video-wrapper {
    max-width: 100%;
    max-height: 100%;
    overflow: hidden;
    white-space: nowrap;
}

#video-player {
    display: inline-block;
    vertical-align: middle;
    width: 100%;
    height: 100%;
    transition: transform 0.5s ease-in-out; /* Adiciona efeito de slide */
}

/* Aplica a animação de slide */
#video-wrapper.slide-left #video-player {
    transform: translateX(-100%);
}

#video-wrapper.slide-right #video-player {
    transform: translateX(100%);
}
</style>
<?php include 'includes/footer.php'?>