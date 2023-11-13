<?php
include('../classes/DB.class.php');
// Verificar se os dados foram recebidos corretamente
if (isset($_POST['seguidor']) && isset($_POST['usuario'])) {
    $seguidor = $_POST['seguidor'];
    $usuario = $_POST['usuario'];

    // Função para desseguir um comércio no banco de dados
    function desseguirComercio($seguidor, $usuario) {
        $conn = DB::getConn();

        $sql = "DELETE FROM lifevideo_seguidores WHERE seguidor = '$seguidor' AND usuario = '$usuario'";
        $result = $conn->exec($sql);

        if ($result === false) {
            echo "Erro ao desseguir o comércio.";
            return;
        }

        echo "<span class=\"w3-bar-item w3-block w3-right w3-button w3-text-blue\" onclick=\"seguir('.$usuario.', '.$seguidor.')\"><i class=\"fa-solid fa-user-plus w3-xlarge\"></i></span>";

    }
    desseguirComercio($seguidor, $usuario);
} else {
    // Caso os dados não tenham sido recebidos corretamente
    echo "Erro: Dados inválidos";
}
?>