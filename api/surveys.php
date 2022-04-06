<?php 

$link = mysqli_connect('formr.ceopv2fs3ucf.us-east-1.rds.amazonaws.com', 'admin', 'FormR2021');

if (!$link) {
    die('Não conseguiu conectar: ' . mysqli_error());
}

// seleciona o banco devcodes
$db_selected = mysqli_select_db( $link,'formr');

if (!$db_selected) {
    die ('Não pode selecionar o banco devcodes : ' . mysqli_error());
}


$sql = "SELECT  ss.*, us.email FROM  survey_studies ss 
        INNER JOIN survey_users us ON ss.user_id = us.id ";
//  echo $sql;
$result = mysqli_query($link,$sql);
while($rows = mysqli_fetch_object($result)){
    
    $json[] = $rows;

}
echo json_encode($json);
