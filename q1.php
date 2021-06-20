<?php
function create_tables($conn)
    {
        /*
            Apesar de ser possível fazer todas as demandas 
            em uma única query, acredito que um array
            declarando cada query isoladamente fique bem
            mais organizado.
            @conn conexão com o banco de dados
            @return void
        */
        $nome_do_banco = 'cederj';
        $querys = Array(
                // Exclui o banco se ele existir.
                "DROP DATABASE IF EXISTS $nome_do_banco;",
                
                // Cria a base de dados
                "CREATE DATABASE $nome_do_banco;",
                
                //Cria a tabela de plantonista
                "CREATE TABLE $nome_do_banco.tl_plantonista".
                " ( ".
                "     matricula VARCHAR(20), ".
                "     ingresso DATE, ".
                "     primary key (matricula) ".
                " ); ",  
                
                // Cria a tabela de plantoes
                "    CREATE TABLE $nome_do_banco.tl_plantao ".
                " ( ".
                "     plantonista_id varchar(20), ".
                "     info_data DATE, ".
                "      primary key (plantonista_id, info_data), ".
                "       foreign key (plantonista_id) ".
                "           references  ".
                        "        $nome_do_banco.tl_plantonista(matricula)".
                " ); ",
                );
        foreach ($querys as $j => $query)        
            {$conn->query($query);}
    }




function cria_tabela_do_analista($conn)
    {
        /*
            Este é o modelo proposto pelo analista. Não foi utilizado
            para responder as demais questões da prova
            @conn conexão com o banco de dados
            @return void
        */
        $nome_do_banco = 'cederj';
        $querys = Array(
            // exclui o banco caso exista
            " drop database if EXISTS $nome_do_banco; ",
            
            // Cria o banco
            " CREATE DATABASE $nome_do_banco; ",
            
            //Cria a tabela mes_ano, algo que não deveria
            //ser criado pois todo julho de 2021 é o mesmo
            //julho de 2021.
            " CREATE TABLE $nome_do_banco.mes_ano( ".
            "     mes_ano varchar(20) PRIMARY KEY ".
            " ); ",
            
            // Cria a tabela de plantonista
            " CREATE TABLE $nome_do_banco.plantonista ".
            "     ( ".
            "         matricula VARCHAR(20) PRIMARY KEY, ".
            "         Mes_ano_FK VARCHAR(20), ".
            "         FOREIGN KEY Mes_ano_FK ".
              " REFERENCES $nome_do_banco.mes_ano(mes_ano) ".
            "     ); ",
            
            //Cria a tabela plantao
            " CREATE TABLE $nome_do_banco.plantao ".
            "     ( ".
            "         numero INT, ".
            "         Mes_ano_FK VARCHAR(20), ".
            "         Plantonista_matricula_FK VARCHAR(20), ".
            "         PRIMARY KEY (numero, Mes_ano_FK, ".           
                "                Plantonista_matricula_FK), ".
            "         FOREIGN KEY Mes_ano_FK REFERENCES ".
                "                $nome_do_banco.mes_ano(mes_ano), ".
            "         FOREIGN KEY Plantonista_matricula_FK ".
                "    REFERENCES $nome_do_banco.plantonista(matricula) ".
            "     ); "
            );
        foreach ($querys as $j => $query)        
            {$conn->query($query);}
    }
$conn = new mysqli("localhost", "root2", "mypassword");
create_tables($conn);
//cria_tabela_do_analista($conn);
?>