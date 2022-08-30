<?php
    /*Aqui atribuímos a funções PHP, comandos SQL que inserem, atualizam e deletam dados.
    
    */
    function insert(string $entidade, array $dados) : string
    {
        //A função "insert" adapta o comando SQL de inserção de dados para o PHP
        //Permitindo que dados sejam inseridos no banco de dados através da página web
        $instrucao = "INSERT INTO {$entidade}";

        $campos = implode(', ', array_keys($dados));
        $valores = implode(', ', array_values($dados));

        $instrucao .= " ({$campos})";
        $instrucao .= " VALUES ({$valores})";

        return $instrucao;
    }
    function update(string $entidade, array $dados, array $criterio = []) : string
    {
        /*A função "update" adapta o comando SQL de atualização de dados para o PHP
        permitindo que dados sejam atualizados no banco de dados através da página web
        */
        $instrucao = "UPDATE {$entidade}";

        foreach($dados as $campo => $dado)
        {
            $set[] = "{$campo} = {$dado}";
        }
        $instrucao .= ' SET ' . implode(', ', $set);

        if(!empty($criterio))
        {
            $instrucao .= ' WHERE ';

            foreach($criterio as $expressao)
            {
                $instrucao .= ' ' . implode(' ', $expressao);
            }
        }

        return $instrucao;
    }
    function delete(string $entidade, array $criterio = []) : string
    {
        /*A função "delete" adapta o comando SQL de exclusão de dados para o PHP
        permitindo que dados sejam deletados no banco de dados através da página web
        */
        $instrucao = "DELETE FROM {$entidade}";

        if(!empty($criterio))
        {
            $instrucao .= ' WHERE ';

            foreach($criterio as $expressao)
            {
                $instrucao .= ' ' .implode(' ', $expressao);
            }
        }
        return $instrucao;
    }
    function select(string $entidade, array $campos, array $criterio = [],
    string $ordem = null) : string
    {
        /*A função "select" adapta o comando SQL de selecão de dados do banco
        Permitindo que através de uma solicitação na página web, dados possam ser mostrados,
        e até mesmo ordenados.
        */
        $instrucao = "SELECT " . implode(', ' ,$campos);
        $instrucao .= " FROM {$entidade}";

        if(!empty($criterio))
        {
            $instrucao .= ' WHERE ';

            foreach($criterio as $expressao)
            {
                $instrucao .= ' ' . implode(' ', $expressao);
            }
        }
        if(!empty($ordem))
        {
            $instrucao .= " ORDER BY $ordem ";
        }

        return $instrucao;
    }
?>