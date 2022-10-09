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

    public function insertRegiaoGif($gif_regiao){
            $this->db->insert("gif_regiao", $gif_regiao);
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
                . "FROM page p LEFT JOIN run r ON r.run_id = p.id where p.pag_id = " . $pag_id 
                . " AND p.id = " . $id;
        $query = $this->db->query($sql);
        $result = $query->row_array();

        return $result; 
    }
    
    public function showQuestions($id)
    {
        $d = null;
        if(!empty($id['use_id'])){
                $d = ",(SELECT COUNT(1) FROM session_formr f 
                                WHERE r.run_original  = f.page  
                                AND f.usu_id = {$id['use_id']} limit 1 ) continuar, 
                        (SELECT qntd FROM run_report rr WHERE rr.run_id = r.run_id limit 1 ) unit_responder, 
                        (SELECT max(rru_qntd) FROM run_report_user rr WHERE rr.run_id = r.run_id AND use_id = {$id['use_id']}) unit_respondido,	
                        (select sum(percet)/count(1) from survey_studies s WHERE s.id_page = p.id AND use_id = {$id['use_id']} ) percent_new	
                                ";
        }

        $sql = "SELECT * {$d} FROM page p
                        LEFT JOIN run r ON r.run_id = p.id
                         where p.pag_id = {$id['pag_id']} 
                         ";

        $query = $this->db->query($sql);
        $result = $query->result();

        return $result; 
    }

    public function showQuestionsUserStudiesId($id)
    {
        //Recuperando o id na tabela survey_studies no banco fromR

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

}
