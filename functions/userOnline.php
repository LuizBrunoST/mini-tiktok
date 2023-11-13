<?php
function onlineOffline($user_id){
    $agora = date('Y-m-d H:i:s');
    $limite = date('Y-m-d H:i:s', strtotime('+5 min'));
    $update = DB::getConn()->prepare("UPDATE `usuarios` SET `limite` = ? WHERE `id` = ?");
    $update->execute(array($limite, $user_id));
    return '<span title="Você está online" class="w3-tag w3-circle w3-green w3-border w3-border-white" style="width:20px;height:20px;">&nbsp;&nbsp;</span>';
    if($agora >= $user_limite){
        return '<span title="Você está offline" class="w3-tag w3-circle w3-red w3-border w3-border-white" style="width:20px;height:20px;">&nbsp;&nbsp;</span>';
    }
}

?>