<?php
//error_reporting(0);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
$datahoje = date("Y/m/d");
$horanow = date("H:i:s");
$wid="";
//-------------------------------------------------------------------------
header("Access-Control-Allow-Origin: https://comoestou.app.br");
//-------------------------------------------------------------------------
// SOLICITA CONEXÃO COM O BANCO DE DADOS
require ( '../common/connect.php' );
//***************************************

//CHECAR SE ESTÁ LOGADO
session_start();
$wid = $_SESSION["wid"];
$mysecretsession = $_SESSION["mysecretsession"];
if(!$wid) { echo "session"; exit(); }
//-------------------------------------------------------------------------

// ** CAPTURAR OS DADOS DO MÉTODO POST FILTRANDO COM SEGURANÇA **
//***************************************************************
    //METODOS DE ACAO: 1 - INSERT, 2 - UPDATE, 3 - DELETE
    //-------------------------------------------------
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_NUMBER_INT);
    $action = substr($action, 0, 1);
    //-------------------------------------------------

    //ALVO: 1 - SALAS, 2 - ALUNOS, 3 - EMOTIONS
    //-------------------------------------------------
    $target = filter_input(INPUT_POST, 'target', FILTER_SANITIZE_NUMBER_INT);
    $target = substr($target, 0, 1);
    //-------------------------------------------------

    //KEY_ID
    //-------------------------------------------------
    $key_id = filter_input(INPUT_POST, 'key_id', FILTER_SANITIZE_NUMBER_INT);
    $key_id = substr($key_id, 0, 11);
    //-------------------------------------------------

    //VALOR
    //-------------------------------------------------
    $value = filter_input(INPUT_POST, 'value', FILTER_SANITIZE_MAGIC_QUOTES);
    $value = substr($value, 0, 50);
    $value = preg_replace("/[^A-zÀ-ú0-9\s]/", "", $value);
    //-------------------------------------------------

    //SALA_ID
    //-------------------------------------------------
    $sala_id = filter_input(INPUT_POST, 'wsalaid', FILTER_SANITIZE_NUMBER_INT);
    $sala_id = substr($sala_id, 0, 11);
    //-------------------------------------------------
//***************************************************************

if(!$action or !$target) { echo "no data"; exit(); }

//METODOS DE ACAO: INSERT
if($action=="1") {

    //ALVO: 1 - SALAS
    if($target=="1" and $value) {
    $mysqli -> query("INSERT INTO salas (professor_id, nome) VALUES ('$wid', '$value')");
    echo "success"; exit();
    }


    //ALVO: 2 - ALUNOS
    if($target=="2" and $key_id and $value) {
        $mysqli -> query("INSERT INTO alunos (professor_id, sala_id, nome) VALUES ('$wid', '$key_id', '$value')");
        echo "success"; exit();
        }

    //ALVO: 3 - EMOTIONS
    if($target=="3" and $key_id and $value) {

        switch ($value) {
            case 'antecipacao':
                $mysqli -> query("INSERT INTO emocoes (aluno_id, sala_id, antecipacao, data, hora) VALUES ('$key_id', '$sala_id', '1', '$datahoje', '$horanow')");
                $mysqli -> query("UPDATE alunos SET votou_em = '$datahoje' where id='$key_id'");
                echo "success"; exit();
            break;
            case 'aversao':
                $mysqli -> query("INSERT INTO emocoes (aluno_id, sala_id, aversao, data, hora) VALUES ('$key_id', '$sala_id', '1', '$datahoje', '$horanow')");
                $mysqli -> query("UPDATE alunos SET votou_em = '$datahoje' where id='$key_id'");
                echo "success"; exit();
            break;
            case 'confianca':
                $mysqli -> query("INSERT INTO emocoes (aluno_id, sala_id, confianca, data, hora) VALUES ('$key_id', '$sala_id', '1', '$datahoje', '$horanow')");
                $mysqli -> query("UPDATE alunos SET votou_em = '$datahoje' where id='$key_id'");
                echo "success"; exit();
            break;
            case 'feliz':
                $mysqli -> query("INSERT INTO emocoes (aluno_id, sala_id, feliz, data, hora) VALUES ('$key_id', '$sala_id', '1', '$datahoje', '$horanow')");
                $mysqli -> query("UPDATE alunos SET votou_em = '$datahoje' where id='$key_id'");
                echo "success"; exit();
            break;
            case 'medo':
                $mysqli -> query("INSERT INTO emocoes (aluno_id, sala_id, medo, data, hora) VALUES ('$key_id', '$sala_id', '1', '$datahoje', '$horanow')");
                $mysqli -> query("UPDATE alunos SET votou_em = '$datahoje' where id='$key_id'");
                echo "success"; exit();
            break;
            case 'raiva':
                $mysqli -> query("INSERT INTO emocoes (aluno_id, sala_id, raiva, data, hora) VALUES ('$key_id', '$sala_id', '1', '$datahoje', '$horanow')");
                $mysqli -> query("UPDATE alunos SET votou_em = '$datahoje' where id='$key_id'");
                echo "success"; exit();
            break;
            case 'surpresa':
                $mysqli -> query("INSERT INTO emocoes (aluno_id, sala_id, surpresa, data, hora) VALUES ('$key_id', '$sala_id', '1', '$datahoje', '$horanow')");
                $mysqli -> query("UPDATE alunos SET votou_em = '$datahoje' where id='$key_id'");
                echo "success"; exit();
            break;
            case 'triste':
                $mysqli -> query("INSERT INTO emocoes (aluno_id, sala_id, triste, data, hora) VALUES ('$key_id', '$sala_id', '1', '$datahoje', '$horanow')");
                $mysqli -> query("UPDATE alunos SET votou_em = '$datahoje' where id='$key_id'");
                echo "success"; exit();
            break;
            case 'alunoausente':
                $mysqli -> query("INSERT INTO emocoes (aluno_id, sala_id, data, hora) VALUES ('$key_id', '$sala_id', '$datahoje', '$horanow')");
                $mysqli -> query("UPDATE alunos SET votou_em = '$datahoje' where id='$key_id'");
                echo "success"; exit();
            break;

        }   

    }
        

}

//METODOS DE ACAO: UPDATE
if($action=="2") {

    //ALVO: 1 - SALAS
    if($target=="1" and $key_id and $value) {
    $mysqli -> query("UPDATE salas SET nome = '$value' WHERE id = '$key_id'");
    echo "success"; exit();
    }

    //ALVO: 2 - ALUNOS
    if($target=="2" and $key_id and $value) {
        $mysqli -> query("UPDATE alunos SET nome = '$value' WHERE id = '$key_id'");
        echo "success"; exit();
        }

}

//METODOS DE ACAO: DELETE
if($action=="3") {

    //ALVO: 1 - SALAS
    if($target=="1" and $key_id) {
    $mysqli -> query("DELETE FROM salas WHERE id = '$key_id'");
    $mysqli -> query("DELETE FROM alunos WHERE sala_id = '$key_id'");
    $mysqli -> query("DELETE FROM emocoes WHERE sala_id = '$key_id'");
    echo "success"; exit();
    }


    //ALVO: 2 - ALUNOS
    if($target=="2" and $key_id) {
        $mysqli -> query("DELETE FROM alunos WHERE id = '$key_id'");
        $mysqli -> query("DELETE FROM emocoes WHERE aluno_id = '$key_id'");
        echo "success"; exit();
        }

}

?>