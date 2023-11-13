<?php
include('../classes/DB.class.php');
// Verificar se os dados foram recebidos corretamente
if (isset($_POST['id']) && isset($_POST['views'])) {
    $id = $_POST['id'];
    $views = $_POST['views'];

    $somaViews = $views + 1;
    
        // Função para seguir um comércio
function somaViews($id, $views) {
    $conn = DB::getConn();

    $seguir = $conn->prepare("UPDATE `lifevideo` SET `views`=:views WHERE `id`=:id");
    $seguir->execute(array(':views' => $views,':id' => $id));
}

somaViews($id, $somaViews); // O usuário com ID 1 segue o comércio com ID 2
    // Implemente aqui a lógica para seguir o comércio no banco de dados
    
    // Exemplo de resposta de sucesso
    echo '<span class="w3-bar-item w3-block w3-right w3-button w3-text-red" onclick="desseguir(\''.$usuario.'\',\''.$seguidor.'\')"><i class="fa-solid fa-user-plus w3-xlarge"></i></span>';
} else {
    // Caso os dados não tenham sido recebidos corretamente
    echo "Erro: Dados inválidos.";
}
?>