<?php
    /*Aqui, usamos o comando "require_once", para usarmos o código do arquivo sql.php
    onde estão armazenadas as funções SQL.

    Basicamente testamos as funções SQL armazenadas no sql.php, onde criamos, atualizamos ou deletamos um
    usuário.
    */
    require_once '../core/sql.php';
    
    //Aqui declaramos os dados para o teste dos comandos. Usando a entidade "usuario" do banco de dados.
    $id = 1;
    $nome = 'renan';
    $email = 'renancastrinho@gmail.com';
    $senha = '321uhu';
    $dados = ['nome' => $nome,
              'email' => $email,
              'senha' => $senha];
    $entidade = 'usuario';
    $criterio = [['id', '=', $id]];
    $campos = ['id', 'nome', 'email'];
    print_r($dados);
    echo '<br>';
    print_r($campos);
    echo '<br>';
    print_r($criterio);
    echo '<br>';

    // Teste geração INSERT
    $instrucao = insert($entidade, $dados);
    echo $instrucao.'<BR>';

    //Teste geração UPDATE
    $instrucao = update($entidade, $dados, $criterio);
    echo $instrucao.'<BR>';

    // Teste geração SELECT
    $instrucao = select($entidade, $campos, $criterio);
    echo $instrucao.'<BR>';

    // Teste geração DELETE
    $instrucao = delete($entidade, $criterio);
    echo $instrucao.'<BR>';
?>