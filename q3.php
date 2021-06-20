<?php
require('utils.php');
function contabiliza_plantoes($conn, $mes_ano)
    {
        /*
        @conn conexão com o my_sqli
        @mes_ano string contendo data no formato MM/aaaa
        
        @return void
        */
        
        $mes_ano = format_date($mes_ano, "", true);
        $query = " SELECT  " .
    "     A.matricula as matricula, COUNT(E.pid) as total  " .
    "FROM  " .
    "     tl_plantonista as A  " .
    "     LEFT JOIN  " .
    "         ( " .
    "             SELECT tl_plantao.plantonista_id as pid " .
    "             FROM  " .
    "                  tl_plantao " .
    "             WHERE " .
    "                 tl_plantao.info_data LIKE '$mes_ano') as E " .
    "     ON (A.matricula = E.pid) " .
    "  " .
    " GROUP BY A.matricula " .
    " ORDER BY A.matricula; ";
    show_as_table($conn, $query, 'matricula', 'total');
    }
open_html("Q3");
contabiliza_plantoes($conn, "07/2021");
close_html();
?>