<?php
require('utils.php');
function audita_plantoes($conn, $mes_ano)
{
    /*
        @conn conexão com o my_sqli
        @mes_ano string contendo data no formato MM/aaaa
    */
    $mes_ano = format_date($mes_ano, "", true);
    $query = "" .
        " SELECT E1.plantonista_id AS pid, DAY(E1.info_data) as num " .
        //Ele retorna o primeiro dia da dupla, acho que deveria ser o
        //segundo, já que o crime só foi cometido quando o plantonista
        //chegou para trabalhar no dia seguinte. Apenas segui o exemplo.
        " from  " .
        "     tl_plantao as E1 " .
        "     INNER JOIN " .
        "     tl_plantao as E2 " .
        "     ON ((E1.plantonista_id = E2.plantonista_id) ".
        "         AND ((E1.info_data+1) = E2.info_data)) " .
        " WHERE " .
        "     E1.info_data LIKE '$mes_ano' ".
        "     AND E2.info_data LIKE '$mes_ano' " .
        " ORDER by  " .
        "     E1.plantonista_id; ";
    $res = $conn->query($query);
    $irregulares = Array();
    $row = $res->fetch_array(MYSQLI_ASSOC);
    while ($row)
    {
        $irregulares[$row['pid']] = $row['num'];
        $row = $res->fetch_array(MYSQLI_ASSOC);
    }
    print_r($irregulares);
}
open_html("Q4");
$resultado = audita_plantoes($conn,'07/2021');
close_html();
?>