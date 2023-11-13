<?php
function dataFormatada($dataAtual){
    $mesesEmPortugues = [
        'Jan' => 'Jan',
        'Feb' => 'Fev',
        'Mar' => 'Mar',
        'Apr' => 'Abr',
        'May' => 'Mai',
        'Jun' => 'Jun',
        'Jul' => 'Jul',
        'Aug' => 'Ago',
        'Sep' => 'Set',
        'Oct' => 'Out',
        'Nov' => 'Nov',
        'Dec' => 'Dez'
    ];
    
    $diasDaSemanaEmPortugues = [
        'Sun' => 'Dom',
        'Mon' => 'Seg',
        'Tue' => 'Ter',
        'Wed' => 'Qua',
        'Thu' => 'Qui',
        'Fri' => 'Sex',
        'Sat' => 'Sáb'
    ];
    
    // Extrai o dia da semana e o mês da data atual
    $diaDaSemana = date('D', strtotime($dataAtual));
    $mes = date('M', strtotime($dataAtual));

    // Traduz o dia da semana e o mês
    $diaDaSemanaTraduzido = $diasDaSemanaEmPortugues[$diaDaSemana];
    $mesTraduzido = $mesesEmPortugues[$mes];

    // Formata a data final
    $dataFormatada = "$diaDaSemanaTraduzido " . date('d', strtotime($dataAtual)) . " $mesTraduzido " . date('Y H:i', strtotime($dataAtual));

    // Exibe a data formatada
    return $dataFormatada;
}


?>