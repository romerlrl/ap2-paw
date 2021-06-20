<?php

function format_date($stringdate, $day = "1", $like = False)
{
    /*
    Como foi optado por salvar as datas como datas que eram,
    foi necessário uma função que fosse capaz de corrigir as
    datas da entrada (numero, mês-ano) com a data adequada do
    banco de dados (ano-mês-dia/numero). Como muitas querys
    tem granularidade mensal, nesses casos a função adiciona
    o "?", um caracter coringa na consulta.
    
    @stringdate String
    @day String
    @like booleano
    @return String data no formato yyyy-MM-dd
    */
    $year = substr($stringdate, 3, 4);
    $month = substr($stringdate, 0, 2);
    $day = substr("0$day",-2, 3);
    if ($like)
        {$day = "%";};
    return "$year-$month-$day";
}



function echo_row_of_table($val1, $val2)
{
    // Recebe dois valores e os dispõe como
    // células de uma mesma linha de uma tabela
    // html
    echo "<tr><th>$val1</th><th>$val2</th>";
}

function open_html($q = "Questao")
{echo "<html><title>$q</title><body>";}

function close_html()
{echo "</body></html>";}





function show_as_table($conn, $query, $column1, $column2, $show_query = False)
{
    /*
    Duas questões exigem que uma dada query seja exibida como
    tabela, por isso essa função está aqui. Ela é responsável
    da consulta ao bando de dados a exibição na tela.
    
    @conn conexão com o banco de dados
    @query String a query a ser enviada ao banco de dados
    @column1 String o título da primeira coluna
    @column2 String o título da segunda coluna
    @show_query Boolean false por default, condicional para
    exibir a query
    
    @return void
    */
    

    $res = $conn->query($query);
    if ($show_query)
        {echo $query;}
    echo '<table style="width:10%">';
    echo_row_of_table($column1, $column2);
    $row = $res->fetch_array(MYSQLI_ASSOC);
    while ($row)
    {
        echo_row_of_table($row[$column1], $row[$column2]);
        $row = $res->fetch_array(MYSQLI_ASSOC);
    }
    echo "</table>";
}


//Todas as funções usam o mesmo $conn então ele está no mesmo
//lugar.
$conn = new mysqli("localhost", "root2", "mypassword", "cederj");

?>