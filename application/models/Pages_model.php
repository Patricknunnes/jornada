<?php

class Pages_model extends CI_model
{
    public function index()
    {
        return $this->db->get_where("pages", array('ativo' => 'S'))->result_array();
    }

    public function destroy($id)
    {
            $this->db->set("ativo", "N");
            $this->db->where("id", $id);
            return $this->db->update("pages");
    }

    public function destroyRegiao($id, $pag_id)
    {
            $this->db->where("id", $id);
            $this->db->where("pag_id", $pag_id);
            return $this->db->delete("page");
    }

    public function getEstudoSession($id_user, $id_page, $nr_pesquisa){
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
    
    public function getPesquisasRepetidas($id_user, $id_pages)
    {
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
    
    public function gets($id)
    {
        $sql = "SELECT * FROM pages where id = {$id}";
        $query = $this->db->query($sql);
        $result = $query->result();

        return $result; 
    }

    public function getsPage($id)
    {
        $sql = "SELECT (SELECT count(1) FROM page p where p.pag_id = pg.id) totpag FROM pages pg where id = {$id}";
        $query = $this->db->query($sql);
        $result = $query->result();

        return $result; 
    }

    public function getRegiao($id_user, $id_page){
            $sql = "SELECT * FROM gif_regiao WHERE id_user = {$id_user} AND id_page = '$id_page'";
    $query = $this->db->query($sql);
            $result = $query->result();
    return $result; 
    }

    public function getTotPesquisasJornada($use_id)
    {
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
    
    public function insertRegiaoGif($gif_regiao){
            $this->db->insert("gif_regiao", $gif_regiao);
    }
    
    public function limpaPesquisaUx($id_page){
        $sql = "UPDATE `page_ux_user` 
                
                SET cont_exibicao = 0
                
                WHERE id_page = " . $id_page;
        
        // zera a quantidade
        $this->db->query($sql);
    }
    
    public function limpaRegiaoUx($id_pages){

        $sql = "UPDATE `pages_ux_user` 
                
                SET cont_exibicao = 0
                
                WHERE id_pages = " . $id_pages;
        
        // zera a quantidade
        $this->db->query($sql);        
    }
    
    public function setPage($pages)
    {
            $this->db->insert("page", $pages);
    }

    public function show($id)
    {
        return $this->db->get_where("pages", array(
                                                    "id" => $id
                                                ))->row_array();
    }
    
    public function showPage($pag_id, $id){
        
        $sql = "SELECT p.id, p.pag_id, r.run_titulo, p.texto_balao, p.qtd_exibicao, p.momento_exibicao, p.dias_para_refazer  "
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
    
    public function showQuestions($id)
                //Retorna as Pesquisas da região informada
                // - Sem uso
                // - Sem Uso
                // - Sem Uso
                // - Se cada pesquisa já foi respondida    
    {
        $d = null;
        if(!empty($id['use_id'])){
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

    public function showQuestionsUserStudiesId($id)
    {
        //Recuperando o id na tabela survey_studies no banco formR

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

    public function store($pages)
    {
        $this->db->insert("pages", $pages);
    }

    public function update($id, $page)
    {
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

    public function updateRegiao($id_user, $id_page){
        $this->db->set("status", 0);
        $this->db->where("id_user", $id_user);
        $this->db->where("id_page", $id_page);
        return $this->db->update("gif_regiao");
    }

    public function verificaEstudoSession($id_user, $id_page, $session_id, $nr_pesquisa){
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
