<?php
/*
O formulário de entrada está em q5.html
O nome desse arquivo é q5.php
*/
require('utils.php');
function list_plantao_from_plantonista($conn, $plantonista)
{
    $query =         " SELECT  ".
        "     DAY(info_data) AS num,".
        "     DATE_FORMAT(info_data,'%m-%Y') as DTA ".
        " from  ".
        "     tl_plantao as E ".
        " WHERE ".
        "     E.plantonista_id = '$plantonista' ".
        " ORDER by  ".
        "     E.info_data; ";
    show_as_table($conn, $query, "num", "DTA");
}
    
open_html("Q5");
list_plantao_from_plantonista($conn, $_POST['matricula']);
close_html();

?>