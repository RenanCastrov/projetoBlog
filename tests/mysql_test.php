<?php
    //Aqui usamos o comando "require_once" para utilizarmos os códigos dos arquivos a seguir:
    require_once '../includes/funcoes.php';
    require_once '../core/conexao_mysql.php';
    require_once '../core/sql.php';
    require_once '../core/mysql.php';

    //Aqui realizamos teste de inserção, busca e atualização de dados.
    insert_teste('Renan', 'renan@ifsp.edu.br', '310304');
    buscar_teste();
    update_teste(2, 'Renanzinho2', 'renancastro2@ifsp.edu.br');

    //Teste inserção banco de dados
    function insert_teste($nome, $email, $senha) : void
    {
        $dados = ['nome'  => $nome,'email' => $email,'senha' => $senha];
        insere('usuario',$dados);
    }
    //Teste select banco de dados
    function buscar_teste() : void
    {
        $usuarios = buscar('usuario',[ 'id','nome','email'], [], '');
        print_r($usuarios);
    }
    //Teste update banco de dados
    function update_teste($id, $nome, $email) : void
    {
        $dados = ['nome'  => $nome,'email' => $email];
        $criterio = [['id', '=', $id]];
        atualiza('usuario',$dados,$criterio);
    }
?>