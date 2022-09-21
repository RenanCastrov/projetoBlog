<?php
    //Esse código serve simplesmente para evitar SQL Injection e tratar os dados.
    function limparDados(string $dado) : string
    {
        $tags = '<p><strong><i><ul><ol><li><h1><h2><h3>';

        $retorno = htmlentities(strip_tags($dado, $tags));

        return $retorno;
    }
?>