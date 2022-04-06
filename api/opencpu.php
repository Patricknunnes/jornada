<?php 

require_once '/var/www/form.org/setup.php';
require_once '/var/www/form.org/application/Library/Config.php';
require_once '/var/www/form.org/application/Library/CURL.php';
require_once '/var/www/form.org/application/Library/OpenCPU.php';
require_once '/var/www/form.org/application/Library/Functions.php';
require_once '/var/www/form.org/application/Model/Site.php';
require_once '/var/www/form.org/application/Library/Request.php';
require_once '/var/www/form.org/application/Library/Session.php';
die('dddd');
$link = mysqli_connect('localhost', 'formr', 'dev123');
 
if (!$link) {
    die('Não conseguiu conectar: ' . mysqli_error());
}
$param = explode('/',$_SERVER['PATH_INFO']);



$studys_id = $param[2];
$session_id = $param[1];


// seleciona o banco devcodes
$db_selected = mysqli_select_db( $link,'formr');

if (!$db_selected) {
    die ('Não pode selecionar o banco devcodes : ' . mysqli_error());
}

$sql = "SELECT * FROM formr.survey_studies WHERE id = {$studys_id}";        

$result = mysqli_query($link,$sql);
while($rows = mysqli_fetch_object($result)){
    $tabela =  $rows->results_table;
    $name =  $rows->name;
}


$sql = "SELECT x.label FROM formr.survey_items x
        WHERE study_id = {$studys_id} and name = 'note_feedback'";        



//    echo $sql;

$result = mysqli_query($link,$sql);
while($rows = mysqli_fetch_object($result)){
    $string_templates[] =  $rows->label;
}


$sql = "SELECT column_name col
          FROM information_schema.columns 
         WHERE table_name='{$tabela}'
           AND column_name NOT LIKE 'note%'
           AND column_name NOT LIKE 'session_id'
           AND column_name NOT LIKE 'study_id'
           AND column_name NOT LIKE 'created'
           AND column_name NOT LIKE 'modified'
           AND column_name NOT LIKE 'ended'
           AND column_name NOT LIKE 'fbnumber'
";        

$result = mysqli_query($link,$sql);
$collist = null;
while($rows = mysqli_fetch_object($result)){
    $colunas[] =  $rows->col;
    $collist .= $rows->col.','; 
}



$consulta = "SELECT $collist 1 FROM {$tabela} WHERE session_id = {$session_id}";
$result = mysqli_query($link,$consulta);
$num_rows = $result->num_rows;
if($num_rows <= 0){
    $consulta = "SELECT $collist 1 FROM {$tabela} LIMIT 1 ";
    $result = mysqli_query($link,$consulta);
}
while($rows = mysqli_fetch_object($result)){
    $opct[] =  $rows;
}

$options = array();
$opct1 = $opct[0];
foreach($colunas as $coluna){
    $r = array(); 
    array_push($r,$opct1->$coluna);
    $options[$coluna] = $r;
}

$opencpu_vars = array('datasets' => 
                array($name => $options)
);
//echo '<h1> inicio teste</h1>';
//print_r($opencpu_vars);
//echo '<h1> fim teste</h1>';
/*
$string_templates = array('
Veja abaixo sua pontuação nas diferentes dimensões em ordem de importância. No topo do gráfico você pode ver a dimensão que é mais forte na sua personalidade!

```{r motiv.opt,fig.height=4,fig.width=6}
library(ggplot2); library(reshape2); library(formr)

dimensaopersona1 = formr_post_process_results(results=dimensaopersona1, item_list = NULL, fallback_max = 5)

dimensaopersona1$Abert = (dimensaopersona1$bfi_open)
dimensaopersona1$Neur = (dimensaopersona1$bfi_neu)
dimensaopersona1$Cons = (dimensaopersona1$bfi_con)
dimensaopersona1$Soci = (dimensaopersona1$bfi_agr)
dimensaopersona1$Extro = (dimensaopersona1$bfi_extra)

personal = melt(dimensaopersona1[,c("Abert", "Neur", "Cons", "Soci", "Extro")])

plot <- ggplot(personal,aes(x=reorder(variable, value),y=value, fill = variable))+ theme_classic() +
geom_bar(stat="identity",position=position_dodge())+
ylab(\'Força do traço\')+
labs(title="Traços de personalidade")+
scale_fill_brewer(palette = "YlOrBr")+ theme(legend.position="none")+
scale_y_continuous(limits=c(0,5),breaks=c(0,5),labels=c(\'mínimo\',\'máximo\')) +
scale_x_discrete("", breaks = c("Abert", "Neur", "Cons", "Soci", "Extro"), labels = c("Abertura à experiência", "Estabilidade emocional", "Organização", "Amabilidade", "Extroversão")) +
  coord_flip()
 
  plot + geom_hline(yintercept = 1:5, col = "white")


\`\`\`'); */
/*
$opencpu_vars = 
    array('datasets' => 
                array('dimensaopersona1' => 
                            array(
                                                        'bfi_agr_1' => array( 1), 
                                                        'bfi_agr_2R' => array( 1), 
                                                        'bfi_agr_3'  => array( 1),       
                                                        'bfi_agr_4R'=> array(2),
                                                        'bfi_agr_5'=> array(2),
                                                        'bfi_agr_6R'=> array(2),
                                                        'bfi_con_1R'=> array(2),
                                                        'bfi_con_2R'=> array(2),
                                                        'bfi_con_3'=> array(2),
                                                        'bfi_con_4'=> array(2),
                                                        'bfi_con_5'=> array(2),
                                                        'bfi_con_6R'=> array(2),
                                                        'bfi_extra_1R'=> array(2),
                                                        'bfi_extra_2'=> array(1),
                                                        'bfi_extra_3'=> array(1),
                                                        'bfi_extra_4'=> array(1),
                                                        'bfi_extra_5R'=> array(1),
                                                        'bfi_extra_6R'=> array(1),
                                                        'bfi_neu_1R'=> array(1),
                                                        'bfi_neu_2R'=> array(1),
                                                        'bfi_neu_3'=> array(1),
                                                        'bfi_neu_4'=> array(1),
                                                        'bfi_neu_5'=> array(1),
                                                        'bfi_neu_6R'=> array(1),
                                                        'bfi_open_1'=> array(1),
                                                        'bfi_open_2R'=> array(1),
                                                        'bfi_open_3'=> array(1),
                                                        'bfi_open_4R'=> array(1),
                                                        'bfi_open_5'=> array(1),
                                                        'bfi_open_6R'=> array(1),

                                        )
                                )  
                    )
; */
//print_r($opencpu_vars);
$markdown = implode(OpenCPU::STRING_DELIMITER, $string_templates);
$session = opencpu_knitdisplay($markdown,$opencpu_vars, true, 'dimensaopersona1');
//print_r($session);
if ($session AND ! $session->hasError()) {
    print_hidden_opencpu_debug_message($session, "OpenCPU debugger for dynamic values and showifs.");
    $parsed_strings = $session->getJSONObject();
    $strings = explode(OpenCPU::STRING_DELIMITER_PARSED, $parsed_strings);
    //print_r($strings[0]);
    
    $strings = array_map("remove_tag_wrapper", $strings);
    $r = opencpu_string_key_parsing($strings);
    echo $r['formr-ocpu-label-0'];
} else {
    echo 'erro';
    notify_user_error(opencpu_debug($session), "There was a problem dynamically knitting something to HTML using openCPU.");
    return fill_array(opencpu_string_key_parsing($string_templates));
}
// $settings['opencpu_instance'] = array(
//     'base_url' => 'http://opencpu.psych.bio.uni-goettingen.de',
//     'r_lib_path' => '/usr/local/lib/R/site-library'
// );


// $t = '
// library(knitr); library(formr) \n
// opts_chunk$set(warning=F,message=F,error=F,echo=F,fig.height=7,fig.width=10) \n
// opts_knit$set(base.url="__formr_opencpu_session_url__")  \n
// dimensaopersona1 = as.data.frame(jsonlite::fromJSON("{"bfi_agr_1":[1]), stringsAsFactors=F) \n
// attach(tail(dimensaopersona1, 1))';
// $snippets = array();
//         $snippets[] = $t;
//       //  $snippets[] = "library(formr) \n .formr\$last_action_time = as.POSIXct('2019-05-09 17:00:35 CEST') \n ! time_passed(minutes = 10)";
//       // $snippets[] =  $t;
//         $snippets[] = "rnorm(5)";

// //print_r($snippets);

// Config::initialize($settings);
// $ocpu = OpenCPU::getInstance('opencpu_instance');
// //$session = $ocpu->snippet($snippets[0]);
// $session = OpenCPU::getInstance()->post('/formr/R/formr_inline_render/json', $snippets);
//  print_r($session);

?>