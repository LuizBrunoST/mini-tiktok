<?php
function formatarNumero($numero)
{
    if ($numero >= 1000000) {
        return number_format($numero / 1000000, 1) . 'M';
    } elseif ($numero >= 1000) {
        return number_format($numero / 1000, 1) . 'K';
    } else {
        return $numero;
    }
}
?>