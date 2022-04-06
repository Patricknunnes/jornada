<?php 

$session_id = $_REQUEST['sid'];
$user_id = $_REQUEST['usid']; 
$pg = $_REQUEST['pg']; 
$link = mysqli_connect('formr.ceopv2fs3ucf.us-east-1.rds.amazonaws.com', 'admin', 'FormR2021');

if (!$link) {
    die('Não conseguiu conectar: ' . mysqli_error());
}

// seleciona o banco devcodes
$db_selected = mysqli_select_db( $link,'BDFormR');

if (!$db_selected) {
    die ('Não pode selecionar o banco devcodes : ' . mysqli_error());
}


$sql = "INSERT INTO session_formr(usu_id,session_id,page,hashid) VALUES ({$user_id},{$session_id}, '{$pg}', '{$_REQUEST['hash']}')";

$result = mysqli_query($link,$sql);