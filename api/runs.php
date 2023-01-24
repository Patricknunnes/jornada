<?php 

define('BASEPATH',"https://" . $_SERVER['HTTP_HOST']);

include_once '../application/config/database.php';

//$link = mysqli_connect('formr.ceopv2fs3ucf.us-east-1.rds.amazonaws.com', 'admin', 'FormR2021');
$link = mysqli_connect( $db['formR']['hostname'], $db['formR']['username'], $db['formR']['password']);

if (!$link) {
    die('Não conseguiu conectar: ' . mysqli_error());
}

// seleciona o banco devcodes
//$db_selected = mysqli_select_db( $link, 'formr'); 
$db_selected = mysqli_select_db( $link, $db['formR']['database'] );

if (!$db_selected) {
    die ('Não pode selecionar o banco devcodes : ' . mysqli_error());
}


$sql = "SELECT id,name FROM  survey_runs ss ";
//  echo $sql;
$result = mysqli_query($link,$sql);
while($rows = mysqli_fetch_object($result)){
    
    $json[] = $rows;

}
echo json_encode($json);
