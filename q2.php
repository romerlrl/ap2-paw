<?php
require ('utils.php');

function import_files($conn, $filename1, $filename2)
  {
    /*
        Acessa dois arquivos de textos e o escreve no
        Banco de dados.
        
        
        Creio que o import_files deveria ser import_file
        e o terceiro parametro o nome da tabela adequada,
        mas o enunciado limitava que o import_files
        recebesse dois nomes de arquivos, por isso o nome
        da tabela está dentro da função reduzindo a flexi-
        bilidade do programa.
        
        @conn my_sqli_connection
        @filename1 nome do primeiro arquivo de texto contendo
        a lista de novos plantonistas
        @filename2 nome do segundo arquivo de texto que contém
        a agenda de plantonistas de um mês.
        
        @return void
    
    */
    $arr = array(
        $filename1 => 'tl_plantonista',
        $filename2 => 'tl_plantao'
    );
    foreach ($arr as $filename => $tablename)
      {
        $handle = file($filename);
        $query = "INSERT INTO $tablename VALUES";
        $header_row = true;
        foreach ($handle as $line_row => $row)
          {
            echo "$tablename : $row <br/>";
            if ($header_row)
              {
                $header = substr($row, 8, 16);
                $header_row = False;
              }


            else
              {
                if ($tablename == 'tl_plantonista')
                  {
                    $fdate = format_date($header);
                    $row = trim($row);
                    $query2 = "$query ( '$row', '$fdate'); ";

                  }
                else
                  {
                    $row_t = str_getcsv($row, ';');
                    $dia = format_date($header, $row_t[0]);
                    $plantonista = trim($row_t[1]);
                    $query2 = "$query ('$plantonista', '$dia');";
                  }
                
                //O programa não faz controle de exceção para
                //registros que eventualmente estejam duplicados.
                $conn->query($query2);
              }

          }
      }

  }

open_html("Q2");
import_files($conn, 'arquivo1.txt', 'arquivo2.txt');
close_html();
?>