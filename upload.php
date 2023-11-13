<?php include 'includes/header.php'?>
<?php
 if (isset($_POST['enviarVideo'])){
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];

    if(isset($_FILES['video'])){
        $extensao = strtolower(substr($_FILES['video']['name'], -4));
        $novo_nome = uniqid() . "_" . md5(time()) . $extensao;
        $diretorio = "uploads/";
        move_uploaded_file($_FILES['video']['tmp_name'], $diretorio.$novo_nome);
    }
    $inserir = DB::getConn()->prepare("INSERT INTO `lifevideo` SET `titulo`=:titulo, `descricao`=:descricao, `video`=:video, `usuario`=:usuario, `data`=NOW()");
    $inserir->execute(array(':titulo'=> $titulo, ':descricao' => $descricao, ':video' => $novo_nome, ':usuario' => $user_id));
 }

?>



<div class="w3-display-middle w3-mobile">
    <div class="w3-container">
        <form action="" method="post" enctype="multipart/form-data">
            <label class="w3-button w3-round w3-blue" for="video"><i class="fa-solid fa-video w3-xxlarge"></i></label>
            <input type="file" id="video" name="video" accept="video/*" required style="display:none;">

            <video id="videoPreview" width="320" height="240" controls ></video>
            <br>
            <label for="titulo">Titulo:</label>
            <input class="w3-input" type="text" placeholder="Titulo do seu video" required id="titulo" name="titulo">

            <label for="descricao">Descrição:</label>
            <input class="w3-input" type="text" placeholder="Descrição do seu video" required id="descricao" name="descricao">
            <input class="w3-button w3-blue" type="submit" name="enviarVideo" value="Enviar">
        </form>
    </div>
</div>


<script>
$(document).ready(function() {
    $('#video').on('change', function() {
        var file = this.files[0]; // Pega o primeiro arquivo selecionado

        if (file) {
            var videoPreview = $('#videoPreview')[0]; // Pega o elemento de vídeo como um elemento DOM
            var videoURL = URL.createObjectURL(file); // Cria uma URL temporária para o arquivo de vídeo

            videoPreview.volume = 0.5; // Define o volume para 50%
            videoPreview.src = videoURL; // Define o atributo src do vídeo com a URL temporária
            videoPreview.play(); // Inicia a reprodução do vídeo

            // Você pode adicionar outras funcionalidades aqui, como exibir informações sobre o vídeo, validar o tipo de arquivo, etc.
        }
    });
});
</script>
<?php include 'includes/footer.php'?>