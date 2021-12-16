<?php 

$mysqli = new mysqli("157.245.219.190", "formr", "dev123", "formr");
$result = $mysqli->query("SELECT * FROM survey_items WHERE study_id = 1");

while ($row = $result->fetch_assoc()){
    $ret[] = $row;
}



echo json_encode($ret);
