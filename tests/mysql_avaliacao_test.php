<?php
    require_once '../includes/funcoes.php';
    require_once '../core/conexao_mysql.php';
    require_once '../core/sql.php';
    require_once '../core/mysql.php';

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
?>