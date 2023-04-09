<?php

    //sempre antes de qualquer instrução de impressão
    session_start();

    $usuario_autenticado = false;
    $usuario_id = null;
    $usuario_perfil_id = null;

    $perfis = array(1 => 'Administrativo', 2 => 'Usuário');

    $usuarios_app = array(
        array('id' => 1, 'email' => 'adm@email.com', 'senha' => '123456', 'perfil_id' => 1),

        array('id' => 2, 'email' => 'user@email.com', 'senha' => '123456', 'perfil_id' => 2),
        
        array('id' => 3, 'email' => 'jose@email.com', 'senha' => '123456', 'perfil_id' => 3),
        array('id' => 4, 'email' => 'maria@email.com', 'senha' => '123456', 'perfil_id' => 3)
    );

    foreach($usuarios_app as $usuario){
        if($usuario['email'] == $_POST['email'] && $usuario['senha'] == $_POST['senha']){
            $usuario_autenticado = true;
            $usuario_id = $usuario['id'];
            $usuario_perfil_id = $usuario['perfil_id'];
            break;
        }
    }

    if($usuario_autenticado == true){
        $_SESSION['autenticado'] = 'SIM';
        $_SESSION['id'] = $usuario_id;
        $_SESSION['perfil_id'] = $usuario_perfil_id;
        header('Location: home.php');
    }else{
        $_SESSION['autenticado'] = 'NAO';
        header('Location: index.php?login=erro');
    }
?>