<?php
class login_bll{
    private $dao;
    private $db;
    static $_instance;

    private function __construct() {
        $this->dao = login_dao::getInstance();
        $this->db = db::getInstance();
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function exist_user_BLL($arrArgument){
        return $this->dao->select_exist_user($this->db,$arrArgument);
    }

    public function token_log_BLL($arrArgument){
        return $this->dao->token_log_update($this->db,$arrArgument);
    }

    public function insert_user_BLL($arrArgument){
        return $this->dao->insert_user_reg($this->db,$arrArgument);
    }

    public function active_user_BLL($arrArgument){
        return $this->dao->update_active_user($this->db,$arrArgument);
    }

    public function get_mail_BLL($arrArgument){
        return $this->dao->select_get_mail($this->db,$arrArgument);
      }

    public function update_passwd_BLL($arrArgument){
    return $this->dao->update_passwd($this->db,$arrArgument);
    }

    public function type_user_BLL($arrArgument){
        return $this->dao->select_type_user($this->db,$arrArgument);
    }
      
    public function user_info_BLL($arrArgument){
        return $this->dao->select_user_info($this->db,$arrArgument);
    }

    public function insert_user_social_BLL($arrArgument){
        return $this->dao->insert_user_social($this->db,$arrArgument);
    }
    
    public function obtain_paises_BLL($url) {
        return $this->dao->obtain_paises_DAO($url);
    }

    public function obtain_provincias_BLL() {
        return $this->dao->obtain_provincias_DAO();
    }

    public function obtain_poblaciones_BLL($arrArgument) {
        return $this->dao->obtain_poblaciones_DAO($arrArgument);
    }

    public function update_user_BLL($arrArgument) {
        return $this->dao->update_user_DAO($this->db,$arrArgument);
    }

    public function select_favs_BLL($arrArgument) {
        return $this->dao->select_favs_DAO($this->db,$arrArgument);
    }

    public function select_favs_project_bll($arrArgument) {
        return $this->dao->select_favs_project_DAO($this->db,$arrArgument);
    }

    public function insert_favs_project_BLL($arrArgument) {
        return $this->dao->insert_favs_project_DAO($this->db,$arrArgument);
    }

    public function favs_project_validate_BLL($arrArgument) {
        return $this->dao->favs_project_validate_DAO($this->db,$arrArgument);
    }
    

}
