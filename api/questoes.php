<?php 
header('Content-Type: application/json; charset=utf-8');
$link = mysqli_connect('localhost', 'formr', 'dev123');

if (!$link) {
    die('Não conseguiu conectar: ' . mysqli_error());
}

// seleciona o banco devcodes
$db_selected = mysqli_select_db( $link,'formr');

if (!$db_selected) {
    die ('Não pode selecionar o banco devcodes : ' . mysqli_error());
}


$sql = "SELECT * FROM  survey_items  where study_id = 1 ";
//  echo $sql;
$result = mysqli_query($link,$sql);
while($rows = mysqli_fetch_object($result)){
    
    $json[] = $rows;

}
echo json_encode($json);
