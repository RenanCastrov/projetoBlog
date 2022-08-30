<?php
    /*Nesse arquivo, após a conexão estabelecida entre o MySQL e o PHP, nós estabelecemos
    comandos PHP para a inclusão de dados no banco MySQL, e através das seguintes funções
    conseguimos adaptar os dados coletados na página web em dados padrões para o MySQL.
    */
    function insere(string $entidade, array $dados) : bool
    {
        /*A função "insere" basicamente insere no banco de dados os dados coletados
        na página web, através de comandos PHP que se relacionam com o MySQL.
        */
        $retorno = false;
        foreach ($dados as $campo => $dado)
        {
            $coringa[$campo] = '?';
            $tipo[] = gettype($dado) [0];
            $$campo = $dado;
        }

        $instrucao = insert($entidade, $coringa);

        $conexao = conecta();

        $stmt = mysqli_prepare($conexao, $instrucao);

        eval('mysqli_stmt_bind_param($stmt, \'' . implode('',$tipo) . '\',$' 
        . implode(', $', array_keys($dados)) . ');');

        mysqli_stmt_execute($stmt);

        $retorno = (boolean) mysqli_stmt_affected_rows($stmt);

        $_SESSION['errors'] = mysqli_stmt_error_list($stmt);

        mysqli_stmt_close($stmt);

        desconecta($conexao);
        
        return $retorno;
    }
    function atualiza(string $entidade, array $dados, array $criterio = []) : bool
    {
        /*A função "atualiza" simplesmente funciona como um comando UPDATE no MySQL
        atualizando os dados no banco, através de uma solicitação na página web.
        */

        $retorno = false;

        foreach ($dados as $campo => $dado)
        {
            $coringa_dados[$campo] = '?';
            $tipo[] = gettype($dado) [0];
            $$campo = $dado;
        }
        foreach ($criterio as $expressao) 
        {
            $dado = $expressao[count($expressao) - 1];

            $tipo[] = gettype($dado) [0];
            $expressao[count($expressao) - 1] = '?';
            $coringa_criterio[] = $expressao;

            $nome_campo = (count($expressao) < 4) ? $expressao[0] : $expressao[1];

            if(isset($nome_campo))
            {
                $nome_campo = $nome_campo . '_' . rand();
            }

            $campos_criterio[] = $nome_campo;

            $$nome_campo = $dado;
        }
        $instrucao = update($entidade, $coringa_dados, $coringa_criterio);

        $conexao = conecta();

        $stmt = mysqli_prepare($conexao, $instrucao);

        if(isset($tipo))
        {
            $comando = 'mysqli_stmt_bind_param($stmt,';
            $comando .= "'" . implode('', $tipo). "'";
            $comando .= ', $' . implode(', $', array_keys($dados));
            $comando .= ', $' . implode(', $', $campos_criterio);
            $comando .= ');';

            eval($comando);
        }

        mysqli_stmt_execute($stmt);

        $retorno = (boolean) mysqli_stmt_affected_rows($stmt);

        $_SESSION['error'] = mysqli_stmt_error_list($stmt);

        mysqli_stmt_close($stmt);

        desconecta($conexao);

        return $retorno;
    }
    function deleta(string $entidade, array $criterio = []) : bool
    {
        /*A função "deleta" basicamente deleta do banco de dados os dados, através de
        uma solicitação na página web
        */

        $retorno = false;

        $coringa_criterio = [];

        foreach ($criterio as $expressao)
        {
            $dado = $expressao[count($expressao) -1];

            $tipo[] = gettype($dado) [0];
            $expressao[count($expressao) - 1] = '?';
            $coringa_criterio[] = $expressao;

            $nome_campo = (count($expressao) < 4) ? $expressao[0] : $expressao[1];

            $campos_criterio[] = $nome_campo;

            $$nome_campo = $dado;
        }
        $instrucao = delete($entidade, $coringa_criterio);

        $conexao = conecta();

        $stmt = mysqli_prepare($conexao, $instrucao);

        if(isset($tipo))
        {
            $comando = 'mysqli_stmt_bind_param($stmt,';
            $comando .= "'" . implode('', $tipo). "'";
            $comando .= ', $' . implode(', $', $campos_criterio);
            $comando .= ');';

            eval($comando);
        }

        mysqli_stmt_execute($stmt);

        $retorno = (boolean) mysqli_stmt_affected_rows($stmt);

        $_SESSION['errors'] = mysqli_stmt_error_list($stmt);

        mysqli_stmt_close($stmt);

        desconecta($conexao);

        return $retorno;
    }
    function buscar(string $entidade, array $campos = ["*"], array $criterio = [], 
    string $ordem = null) : array
    {
        /*A função "buscar", através de uma solicitação feita na página web,
        busca no banco de dados, dados solicitados na página web.
        */

        $retorno = false;
        $coringa_criterio = [];

        foreach ($criterio as $expressao)
        {
            $dado = $expressao[count($expressao) -1];

            $tipo[] = gettype($dado) [0];
            $expressao[count($expressao) - 1] = '?';
            $coringa_criterio[] = $expressao;

            $nome_campo = (count($expressao) < 4) ? $expressao[0] : $expressao[1];

            if(isset($$nome_campo))
            {
                $nome_campo = $nome_campo . '_' . rand();
            }

            $campos_criterio[] = $nome_campo;

            $$nome_campo = $dado;
        }
        $instrucao = select($entidade, $campos, $coringa_criterio, $ordem);

        $conexao = conecta();

        $stmt = mysqli_prepare($conexao, $instrucao);

        if(isset($tipo))
        {
            $comando = 'mysqli_stmt_bind_param($stmt,';
            $comando .= "'" . implode('', $tipo). "'";
            $comando .= ', $' . implode(', $', $campos_criterio);
            $comando .= ');';

            eval($comando);
        }

        mysqli_stmt_execute($stmt);

        if($result = mysqli_stmt_get_result($stmt))
        {
            $retorno = mysqli_fetch_all($result, MYSQLI_ASSOC);

            mysqli_free_result($result);
        }
        $_SESSION['errors'] = mysqli_stmt_error_list($stmt);

        mysqli_stmt_close($stmt);

        desconecta($conexao);

        $retorno = $retorno;

        return $retorno;
    }
?>