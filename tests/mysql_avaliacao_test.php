<?php
    //Aqui usamos o comando "require_once" para usar o código dos arquivos a seguir:
    require_once '../includes/funcoes.php';
    require_once '../core/conexao_mysql.php';
    require_once '../core/sql.php';
    require_once '../core/mysql.php';

    //Aqui foi usado para fazer testes dos comandos de inserção, atualização, busca e exclusão de dados.
    buscar_test();
    delete_test(1);

    //Teste inserção banco de dados
    function insert_test($nota, $comentario, $post_id, $usuario_id) : void
    {
        $dados = ['nota'  => $nota,'comentario' => $comentario, 'post_id' => $post_id, 'usuario_id' => $usuario_id];
        insere('avaliacao',$dados);
    }
    //Teste select banco de dados
    function buscar_test() : void
    {
        $avaliacoes = buscar('avaliacao',['id', 'comentario', 'nota', 'usuario_id', 'post_id'], [], '');
        print_r($avaliacoes);
    }
    //Teste update banco de dados
    function update_test($id, $nota, $comentario, $post_id, $usuario_id) : void
    {
        $dados = ['nota'  => $nota,'comentario' => $comentario,'post_id' => $post_id,'usuario_id' => $usuario_id];
        $criterio = [['id', '=', $id]];
        atualiza('avaliacao',$dados,$criterio);
    }
    //Teste delete banco de dados
    function delete_test($id) : void
    {
        $criterio = [['id', '=', $id]];
        delete('avaliacao',$criterio);
    }
?>