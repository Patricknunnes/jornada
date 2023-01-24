<?php 
echo "<pre>";  
$link = mysqli_connect('localhost', 'formr', 'dev123');

if (!$link) {
    die('Não conseguiu conectar: ' . mysqli_error());
}

// seleciona o banco devcodes
$db_selected = mysqli_select_db( $link,'formr');

if (!$db_selected) {
    die ('Não pode selecionar o banco devcodes : ' . mysqli_error());
}



$link1 = mysqli_connect('mysql.devcodes.com.br', 'devcodes29', 'dev123_erro');;

if (!$link1) {
    die('Não conseguiu conectar: ' . mysqli_error());
}

// seleciona o banco devcodes
$db_selected1 = mysqli_select_db( $link1,'devcodes29');

if (!$db_selected1) {
    die ('Não pode selecionar o banco devcodes : ' . mysqli_error());
}



$sqlSession = "SELECT distinct session_id, usu_id FROM session_formr";

$resultSession = mysqli_query($link1,$sqlSession);


while($rowsSession = mysqli_fetch_object($resultSession)){
    
    /*$sql = "SELECT * from survey_unit_sessions sus 
            inner join survey_units su ON su.id  =sus.unit_id  
            where sus.run_session_id  in (
                SELECT r1.id FROM survey_run_sessions r1 
                WHERE `session`  in (
                    SELECT `session` FROM survey_run_sessions r where r.id in (SELECT run_session_id FROM survey_unit_sessions sus1 
                    where id = {$rowsSession->session_id}  )
                )
            )
            and su.`type`  != 'Page'
            ";*/
            $sql = "SELECT * FROM survey_run_sessions r1 
            WHERE `session`  in (
                SELECT `session` FROM survey_run_sessions r where r.id in (SELECT sus2.run_session_id FROM survey_unit_sessions sus2 
                where id = {$rowsSession->session_id}  )
            )";        

            
          
 //    echo $sql;
     
   $result = mysqli_query($link,$sql);
    while($rows = mysqli_fetch_object($result)){
        
        $sql2 = "SELECT * FROM survey_unit_sessions sus1 
        inner join survey_units su1 ON su1.id  =sus1.unit_id  
        where sus1.run_session_id  = {$rows->id}
        and sus1.ended is not null
        and su1.`type`  != 'Page'"; 
       // echo $sql2."<br>";
        $result1 = mysqli_query($link,$sql2);
        $nume = $result1->num_rows;

        //echo $nume;

        if($nume>0){
            $insert= "INSERT INTO run_report_user(run_id, rru_qntd, use_id ) VALUES({$rows->run_id},{$nume},{$rowsSession->usu_id})";
            
            mysqli_query($link1,$insert);
            
        }

     }

}
echo "</pre>";




//echo json_encode($json);
