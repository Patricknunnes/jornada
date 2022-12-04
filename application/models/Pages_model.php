<?php

class Pages_model extends CI_model {

    public function index() {
        return $this->db->order_by('pertence_a_jornada DESC, ordem')->get_where("pages", array('ativo' => 'S'))->result_array();
    }

    public function destroy($id) {
        $sql = "SELECT * FROM pages WHERE id = {$id}";
        $query = $this->db->query($sql);
        $row = $query->row();
        $atual = $row->ordem;

        $this->db->set("ativo", "N");
        $this->db->where("id", $id);
        $alterado = $this->db->update("pages");

        $sql = "UPDATE pages
                SET ordem = (ordem - 1) 
                WHERE pertence_a_jornada = 'N'
                    AND ativo = 'S'
                    AND  ordem > {$atual}";
        $query = $this->db->query($sql);

        return $alterado;
    }

    public function destroyPesquisa($id, $pag_id) {
        //Delete Baloes primeiro
        $this->db->where("id_page", $id);
        $this->db->where("id_pages", $pag_id);
        $this->db->delete("page_ux_user");

        $this->db->where("id", $id);
        $this->db->where("pag_id", $pag_id);
        return $this->db->delete("page");
    }

    public function getEstudoSession($id_user, $id_page, $nr_pesquisa) {
        $sql = "
                SELECT session_id 
                FROM survey_studies
                WHERE use_id = {$id_user}
                    AND id_page = {$id_page}
                    AND nr_pesquisa = {$nr_pesquisa};";

        $query = $this->db->query($sql);
        $result = $query->row_array();

        return $result;
    }

    public function getMaxOrdemRegiaoOutras() {
        $sql = "
                SELECT IFNULL(MAX(ordem), 0) ordem
                FROM pages
                WHERE pertence_a_jornada = 'N'
                    AND ativo = 'S'
                ";

        $query = $this->db->query($sql);
        $result = $query->row_array();

        return $result;
    }

    public function getOrdensConclusas() {
        return $this->db->get("pages_ordens_conclusas")->result_array();
    }
    public function getOrdensConclusasExibicao( $id, $reg_id ) {
        /*
        A partir da regiao atual são recuperadas as exigências de regiões conclusas.
        É verificado o percentual de conclusão das regiões precedentes exigidas.        
        */
        $sql = "
                SELECT 
                        ps_atu.id, 
                        CASE WHEN COUNT( poc.ordem ) = 0 THEN 'N' ELSE 'S' END necessita_regiao, 
                        IFNULL( ROUND ((COUNT( s.studies_id ) * 100) / COUNT( r.run_id )), 0) perc

                FROM pages ps_atu

                LEFT JOIN pages_ordens_conclusas poc

                        INNER JOIN pages ps
                                ON ps.pertence_a_jornada = poc.jornada
                                AND ps.ordem = poc.ordem_ant

                        LEFT JOIN page p
                                ON p.pag_id = ps.id

                        LEFT JOIN run r 
                                ON r.run_id = p.id

                        LEFT OUTER JOIN survey_studies s
                                ON s.use_id = {$id} 
                                        AND s.nr_pesquisa = 1
                                AND s.id_page = p.id 

                        ON poc.jornada = ps_atu.pertence_a_jornada
                        AND poc.ordem = ps_atu.ordem


                WHERE ps_atu.ativo = 'S'
                    AND (
                        ps_atu.id = {$reg_id}
                        OR
                        0 = {$reg_id}
                        )

                GROUP BY ps_atu.id;";
        
        
        $query = $this->db->query($sql);
        $result = $query->result();

        return $result;        
    }            
    
    public function getPesquisasRepetidas($id_user, $id_pages) {
        $sql = "SELECT p.id, p.dias_para_refazer, ss.data_gravacao, 
                        DATEDIFF(NOW(), ss.data_gravacao) diferenca,
                        ss.percet percent_anterior, 
                        ss.session_id session_id_ant,
                        IFNULL(ss2.percet,0) percent_atual,
                        ss2.session_id,
                        ss2.studies_id,
                        (ss.nr_pesquisa + 1) nr_pesquisa

                FROM page p

                LEFT JOIN survey_studies ss
                        ON ss.id_page = p.id
                        AND ss.use_id = {$id_user}

                LEFT JOIN survey_studies ss2
                        ON ss2.id_page = ss.id_page
                        AND ss2.use_id = ss.use_id
                        AND ss2.nr_pesquisa = ss.nr_pesquisa + 1 

                WHERE p.pag_id = {$id_pages}

                ORDER BY p.id, ss.data_gravacao;";

        $query = $this->db->query($sql);
        $result = $query->result_array();

        return $result;
    }

    public function gets($id) {
        $sql = "SELECT * FROM pages where id = {$id}";
        $query = $this->db->query($sql);
        $result = $query->result();

        return $result;
    }

    public function getsPage($id) {
        $sql = "SELECT (SELECT count(1) FROM page p where p.pag_id = pg.id) totpag FROM pages pg where id = {$id}";
        $query = $this->db->query($sql);
        $result = $query->result();

        return $result;
    }

    public function getRegiao($id_user, $id_page) {
        $sql = "SELECT * FROM gif_regiao WHERE id_user = {$id_user} AND id_page = '$id_page'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function getRegioesJornada() {
        $sql = "SELECT * FROM pages WHERE pertence_a_jornada = 'S' ORDER BY ordem";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function getRegioesOutras() {
        $sql = "SELECT * FROM pages WHERE pertence_a_jornada = 'N' AND ativo = 'S' ORDER BY ordem";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function getTotPesquisasJornada($use_id) {
        $sql = "SELECT COUNT(p.run_titulo) total, SUM(ss.nr_pesquisa) tot_realizadas
                FROM `pages` ps
                
                INNER JOIN page p
                    ON ps.id = p.pag_id
                    
                LEFT JOIN survey_studies ss
                    ON ss.id_page = p.id
                        AND ss.percet = 100
                        AND ss.nr_pesquisa = 1
                        AND ss.use_id = {$use_id}
                        
                WHERE ps.pertence_a_jornada = 'S'
                    AND ps.ativo = 'S';";

        $query = $this->db->query($sql);
        $result = $query->row_array();

        return $result;
    }

    public function insertRegiaoGif($gif_regiao) {
        $this->db->insert("gif_regiao", $gif_regiao);
    }

    public function limpaPesquisaUx($id_page) {
        $sql = "UPDATE `page_ux_user` 
                
                SET cont_exibicao = 0
                
                WHERE id_page = " . $id_page;

        // zera a quantidade
        $this->db->query($sql);
    }

    public function limpaRegiaoUx($id_pages) {

        $sql = "UPDATE `pages_ux_user` 
                
                SET cont_exibicao = 0
                
                WHERE id_pages = " . $id_pages;

        // zera a quantidade
        $this->db->query($sql);
    }

    public function setPage($pages) {
        return $this->db->insert("page", $pages);
    }

    public function show($id) {
        return $this->db->get_where("pages", array(
                    "id" => $id
                ))->row_array();
    }

    public function showPage($pag_id, $id) {

        $sql = "SELECT p.id, p.pag_id, r.run_titulo, p.texto_balao, p.qtd_exibicao_bl, p.momento_exibicao_bl, p.dias_para_refazer  "
                . " FROM page p "
                . " LEFT JOIN run r ON r.run_id = p.id "
                . " WHERE p.pag_id = " . $pag_id
                . " AND p.id = " . $id;
        $query = $this->db->query($sql);
        $result = $query->row_array();

        return $result;
    }

    public function showPesquisas($id) {

        $sql = "SELECT p.*
                FROM page p

                WHERE p.pag_id = {$id['pag_id']} 
                         ";

        $query = $this->db->query($sql);
        $result = $query->result();

        return $result;
    }

    public function showQuestions($id) {
    //Retorna as Pesquisas da região informada
    // - Sem uso
    // - Sem Uso
    // - Sem Uso
    // - Se cada pesquisa já foi respondida    
        $d = null;
        if (!empty($id['use_id'])) {
            $d = ",
                    
                       (SELECT COUNT(1) 
                        FROM session_formr f 
                        WHERE r.run_original  = f.page  
                            AND f.usu_id = {$id['use_id']} limit 1 
                       ) continuar, 
                        
                       (SELECT qntd 
                        FROM run_report rr 
                        WHERE rr.run_id = r.run_id limit 1 
                       ) unit_responder, 
                       
                       (SELECT max(rru_qntd) 
                        FROM run_report_user rr 
                        WHERE rr.run_id = r.run_id 
                            AND use_id = {$id['use_id']}
                       ) unit_respondido,
                       
                       (SELECT SUM(percet)/COUNT(1) 
                        FROM survey_studies s 
                        WHERE s.id_page = p.id 
                            AND use_id = {$id['use_id']} 
                                AND s.nr_pesquisa = 1 
                       ) percent_new ";
        } //if(!empty($id['use_id'])){

        $sql = "SELECT p.*, r.*, s.studies_id {$d} 
                FROM page p
                LEFT JOIN run r 
                    ON r.run_id = p.id
                LEFT OUTER JOIN survey_studies s
                    ON s.use_id = {$id['use_id']} 
                        AND s.nr_pesquisa = 1
                        AND s.id_page = p.id 

                WHERE p.pag_id = {$id['pag_id']} 
                         ";

        $query = $this->db->query($sql);
        $result = $query->result();

        return $result;
    }

    public function showQuestionsPerc($user_id) {
         $sql = "
                SELECT 
                    p.pag_id,
                    ps.pertence_a_jornada,
                    COUNT( r.run_id) tot_run, 
                    COUNT( s.studies_id) tot_studies, 
                    IFNULL( ROUND ((COUNT( s.studies_id ) * 100) / COUNT( r.run_id )), 0) perc
                FROM page p
                INNER JOIN pages ps
                    ON p.pag_id = ps.id
                LEFT JOIN run r 
                    ON r.run_id = p.id
                LEFT OUTER JOIN survey_studies s
                    ON s.use_id = {$user_id} 
                        AND s.nr_pesquisa = 1
                        AND s.id_page = p.id 

                GROUP BY p.pag_id
                ORDER BY p.pag_id;";
         
        $query = $this->db->query($sql);
        $result = $query->result();

        return $result;                 
    }
    
    public function showQuestionsUserStudiesId($id) {
        //Recuperando o id na tabela survey_studies 

        $sql = "SELECT * FROM page p
                INNER JOIN survey_studies ss 
                    ON ss.id_page = p.id

                WHERE p.pag_id = {$id['pag_id']} 
                    AND ss.use_id = {$id['use_id']} ;            
                             ";

        $query = $this->db->query($sql);
        $result = $query->result();

        return $result;
    }

    public function store($pages) {
        $this->db->insert("pages", $pages);
        return $this->db->insert_id();
    }

    public function storeAguardaJornada( $regiaoId, $aguardaJornada) {
        $this->db->set("aguarda_jornada", $aguardaJornada);
        $this->db->where("id", $regiaoId);
        $alterado = $this->db->update("pages");        
    }
    
    public function storeOrdemConclusa( $ordemAtual, $ordemAnt, $aguardaConclusa, $jornada) {
        
        if ($aguardaConclusa == 'N') {
            $this->db->where("ordem", $ordemAtual);
            $this->db->where("jornada", $jornada);
            $this->db->where("ordem_ant", $ordemAnt);
            $alterado = $this->db->delete("pages_ordens_conclusas");    
            
        } else {
            $this->db->where("ordem", $ordemAtual);
            $this->db->where("jornada", $jornada);
            $this->db->where("ordem_ant", $ordemAnt);
            $alterado = $this->db->delete("pages_ordens_conclusas");    

            $pagesOrdensConclusas = array(
                                            "ordem" => $ordemAtual,
                                            "jornada" => $jornada,
                                            "ordem_ant" => $ordemAnt
                                        );
            $this->db->insert("pages_ordens_conclusas", $pagesOrdensConclusas);            
        }        
    }

    public function storeSempreVisivel( $regiaoId, $sempreVisivel) {
        $this->db->set("sempre_visivel", $sempreVisivel);
        $this->db->where("id", $regiaoId);
        $alterado = $this->db->update("pages");           
    }
            
    public function trocaOrdemRegioes($ordem1, $ordem2, $jornada) {
        $sql = "UPDATE pages
                 SET ordem=
                            CASE ordem
                                WHEN {$ordem1} THEN {$ordem2}
                                WHEN {$ordem2} THEN {$ordem1}
                                ELSE ordem
                            END
                 WHERE (ordem={$ordem1} 
                    OR ordem={$ordem2} )
                    AND pertence_a_jornada = '{$jornada}'";

        //Inverte a ordem
        $this->db->query($sql);
    }

    public function update($id, $page) {
        $this->db->where("id", $id);
        return $this->db->update("pages", $page);
    }

    public function updateContaUx($id_user) {

        $sql = "INSERT INTO pages_ux_user ( id_pages, id_user, cont_exibicao )

                SELECT p.id id_pages, " . $id_user . " id_user, 0 cont_exibicao

                FROM pages p

                LEFT JOIN pages_ux_user puu
                        ON p.id = puu.id_pages
                        AND id_user = " . $id_user . " 
 
                WHERE puu.id_pages IS NULL;";

        // Adiciona contador para todas as Regiões que o usuário não viu
        $this->db->query($sql);


        // Deve ser revisto quando puder cadastrar mais regiões
        // e configurar a apresentação ou não das regiões
        $sql = "UPDATE `pages_ux_user` 
                
                SET cont_exibicao = cont_exibicao + 1
                
                WHERE id_user = " . $id_user;
        // Incrementa a quantidade
        $this->db->query($sql);

        $sql = "SELECT id_pages, cont_exibicao FROM pages_ux_user WHERE id_user = " . $id_user;

        $query = $this->db->query($sql);
        $result = $query->result_array();

        return $result;
    }

    public function updateContaUxPesq($id_user, $id_pages) {

        $sql = "INSERT INTO page_ux_user ( id_page, id_pages, id_user, cont_exibicao)

                SELECT p.id id_page, p.pag_id id_pages," . $id_user . " id_user, 0 cont_exibicao

                FROM page p
                
                LEFT JOIN page_ux_user puu
                    ON puu.id_page = p.id                    
                        AND puu.id_user = " . $id_user . " 
 
                WHERE puu.id_pages IS NULL
                    AND p.pag_id = " . $id_pages . ";";

        // Adiciona contador para todas as Regiões que o usuário não viu
        $this->db->query($sql);

        // Deve ser revisto quando puder cadastrar mais regiões
        // e configurar a apresentação ou não das regiões
        $sql = "UPDATE page_ux_user
                
                SET cont_exibicao = cont_exibicao + 1
                
                WHERE id_user = " . $id_user . "
                    AND id_pages = " . $id_pages;
        // Incrementa a quantidade
        $this->db->query($sql);
        
        $sql = "SELECT id_page, cont_exibicao 
                FROM page_ux_user 
                WHERE id_user = " . $id_user . "
                    AND id_pages = " . $id_pages;

        $query = $this->db->query($sql);
        $result = $query->result_array();

        return $result;
    }

    public function updatePage($chaves, $page) {

        $this->db->where($chaves);

        $processo = $this->db->update("page", $page);
        return $processo;
    }

    public function updateRegiao($id_user, $id_page) {
        $this->db->set("status", 0);
        $this->db->where("id_user", $id_user);
        $this->db->where("id_page", $id_page);
        return $this->db->update("gif_regiao");
    }

    public function verificaEstudoSession($id_user, $id_page, $session_id, $nr_pesquisa) {
        $sql = "
                SELECT nr_pesquisa 
                FROM survey_studies
                WHERE use_id = {$id_user}
                    AND id_page = {$id_page}
                    AND ( session_id = {$session_id}
                        OR nr_pesquisa = {$nr_pesquisa});";
        $query = $this->db->query($sql);
        $result = $query->num_rows();

        return $result;
    }

}
