<?php
    session_start();


    foreach($_POST as &$each){
        $each = str_replace('#', '-', $each);
    }
    
    $arquivo = fopen('../../app_help_desk_private/arquivo.hd','a');
    
    $texto = $_SESSION['id'] . '#' . implode('#', $_POST) . PHP_EOL;

    fwrite($arquivo, $texto);
    fclose($arquivo);

    header('Location: home.php');
?>