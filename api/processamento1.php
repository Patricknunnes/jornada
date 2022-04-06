<?php 
/// --------- FORMR ------------------
$link = mysqli_connect('localhost', 'formr', 'dev123');

if (!$link) {
    die('Não conseguiu conectar: ' . mysqli_error());
}

// seleciona o banco devcodes
$db_selected = mysqli_select_db( $link,'formr');

if (!$db_selected) {
    die ('Não pode selecionar o banco devcodes : ' . mysqli_error());
}

/// --------- FIM FORMR ------------------

/// -------------- PESQUISA -------------
$link1 = mysqli_connect('mysql.devcodes.com.br', 'devcodes29', 'dev123');;

if (!$link1) {
    die('Não conseguiu conectar: ' . mysqli_error());
}

// seleciona o banco devcodes
$db_selected1 = mysqli_select_db( $link1,'devcodes29');

if (!$db_selected1) {
    die ('Não pode selecionar o banco devcodes : ' . mysqli_error());
}
    
/// -------------- FIM PESQUISA -------------

$sql = "SELECT   x.run_id, count(su.id) unit 
            FROM formr.survey_run_units x
            inner join survey_units su ON su.id  =x.unit_id
            where 
            1=1 
            -- x.run_id  = 6
            and su.`type`  != 'Page'
            group by x.run_id 
";

            
          
 //    echo $sql;
     
   $result = mysqli_query($link,$sql);
   echo $result->num_rows;
   echo "<br>";
   while($rows = mysqli_fetch_object($result)){
        
        $insert  = "INSERT INTO run_report(run_id, qntd) VALUES ({$rows->run_id}, {$rows->unit})";
         mysqli_query($link1,$insert);

     }


echo "</pre>";




//echo json_encode($json);
